<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockInRequest;
use App\Models\Item;
use App\Models\StockIn;
use App\Models\StockMutation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockInController extends Controller
{
    public function index()
    {
        $ins = \App\Models\Pengajuan::with('stockIns.item', 'user')->where('tipe', 'in')->latest()->paginate(10);
        $items = Item::orderBy('nama_barang')->get();
        return view('stock_ins.index', compact('ins', 'items'));
    }

    public function create()
    {
        $items = Item::orderBy('nama_barang')->get();
        return view('stock_ins.create', compact('items'));
    }

    public function store(StockInRequest $request)
    {
        // Only staff can create new stock in requests
        if (auth()->user()->role !== 'staff') {
            return back()->with('error', 'Hanya Staff Gudang yang dapat mengajukan permintaan barang masuk.');
        }

        $data = $request->validated();

        try {
            DB::transaction(function () use ($data, $request) {
                $prefix = 'KB-' . date('d-m-');
                $lastPengajuan = \App\Models\Pengajuan::where('kode_pengajuan', 'like', $prefix . '%')->latest('id')->first();
                $sequence = 1;
                if ($lastPengajuan) {
                    $lastSeq = (int) substr($lastPengajuan->kode_pengajuan, -3);
                    $sequence = $lastSeq + 1;
                }
                $kodePengajuan = $prefix . str_pad($sequence, 3, '0', STR_PAD_LEFT);

                $pengajuan = \App\Models\Pengajuan::create([
                    'kode_pengajuan' => $kodePengajuan,
                    'tipe' => 'in',
                    'user_id' => $request->user()->id,
                    'status' => 'pending_superadmin',
                    'tanggal' => $data['tanggal_masuk'],
                    'supplier_tujuan' => $data['supplier'] ?? null,
                    'keterangan_umum' => $data['keterangan'] ?? null,
                ]);

                foreach ($data['items'] as $itemData) {
                    StockIn::create([
                        'pengajuan_id'  => $pengajuan->id,
                        'item_id'       => $itemData['item_id'],
                        'jumlah'        => $itemData['jumlah'],
                        'tanggal_masuk' => $data['tanggal_masuk'],
                        'supplier'      => $data['supplier'] ?? null,
                        'keterangan'    => $data['keterangan'] ?? null,
                        'user_id'       => $request->user()->id,
                        'status'        => 'pending_superadmin',
                    ]);
                }
            });

            return redirect()->route('stock-ins.index')->with('success', 'Permintaan Barang Masuk berhasil diajukan. Menunggu persetujuan Superadmin.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy(\App\Models\Pengajuan $stockIn) // parameter name $stockIn kept for routing
    {
        // Only allow deletion if still pending (not yet approved)
        if ($stockIn->status === 'approved') {
            return back()->with('error', 'Pengajuan yang sudah disetujui tidak bisa dihapus langsung.');
        }

        try {
            DB::transaction(function () use ($stockIn) {
                // If somehow approved, reverse stock (safety check)
                if ($stockIn->status === 'approved') {
                    foreach ($stockIn->stockIns as $in) {
                        $item = $in->item;
                        if ($item->stok < $in->jumlah) {
                            throw new \Exception("Stok {$item->nama_barang} saat ini kurang dari jumlah yang akan dibatalkan.");
                        }
                        $stokSebelum = $item->stok;
                        $item->stok -= $in->jumlah;
                        $item->save();

                        StockMutation::create([
                            'item_id'     => $item->id,
                            'tipe_mutasi' => 'rollback-in',
                            'jumlah'      => $in->jumlah,
                            'stok_sebelum' => $stokSebelum,
                            'stok_sesudah' => $item->stok,
                            'referensi'   => 'Batal ' . $stockIn->kode_pengajuan,
                            'created_by'  => auth()->id(),
                        ]);
                    }
                }
                // deletes stock_ins too via cascade
                $stockIn->delete();
            });

            return redirect()->route('stock-ins.index')->with('success', 'Pengajuan berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
