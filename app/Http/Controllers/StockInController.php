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
        $ins = StockIn::with('item', 'user')->latest()->paginate(10);
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
                foreach ($data['items'] as $itemData) {
                    StockIn::create([
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

    public function destroy(StockIn $stockIn)
    {
        // Only allow deletion if still pending (not yet approved)
        if ($stockIn->status === 'approved') {
            return back()->with('error', 'Transaksi yang sudah disetujui tidak bisa dihapus langsung.');
        }

        try {
            DB::transaction(function () use ($stockIn) {
                // If somehow approved, reverse stock (safety check)
                if ($stockIn->status === 'approved') {
                    $item = $stockIn->item;
                    if ($item->stok < $stockIn->jumlah) {
                        throw new \Exception('Stok saat ini kurang dari jumlah yang akan dibatalkan.');
                    }
                    $stokSebelum = $item->stok;
                    $item->stok -= $stockIn->jumlah;
                    $item->save();

                    StockMutation::create([
                        'item_id'     => $item->id,
                        'tipe_mutasi' => 'rollback-in',
                        'jumlah'      => $stockIn->jumlah,
                        'stok_sebelum' => $stokSebelum,
                        'stok_sesudah' => $item->stok,
                        'referensi'   => 'Batal IN-' . str_pad($stockIn->id, 5, '0', STR_PAD_LEFT),
                        'created_by'  => auth()->id(),
                    ]);
                }
                $stockIn->delete();
            });

            return redirect()->route('stock-ins.index')->with('success', 'Pengajuan berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
