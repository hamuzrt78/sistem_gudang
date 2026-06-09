<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockOutRequest;
use App\Models\Item;
use App\Models\StockOut;
use App\Models\StockMutation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockOutController extends Controller
{
    public function index()
    {
        $outs = StockOut::with('item', 'user')->latest()->paginate(10);
        $items = Item::where('stok', '>', 0)->orderBy('nama_barang')->get();
        return view('stock_outs.index', compact('outs', 'items'));
    }

    public function create()
    {
        $items = Item::where('stok', '>', 0)->orderBy('nama_barang')->get();
        return view('stock_outs.create', compact('items'));
    }

    public function store(StockOutRequest $request)
    {
        // Only staff can create new stock out requests
        if (auth()->user()->role !== 'staff') {
            return back()->with('error', 'Hanya Staff Gudang yang dapat mengajukan permintaan barang keluar.');
        }

        $data = $request->validated();

        try {
            DB::transaction(function () use ($data, $request) {
                foreach ($data['items'] as $itemData) {
                    $item = Item::lockForUpdate()->findOrFail($itemData['item_id']);

                    if ($item->stok < $itemData['jumlah']) {
                        throw new \Exception("Stok {$item->nama_barang} tidak mencukupi untuk permintaan ini.");
                    }

                    StockOut::create([
                        'item_id'       => $item->id,
                        'jumlah'        => $itemData['jumlah'],
                        'tanggal_keluar' => $data['tanggal_keluar'],
                        'tujuan'        => $data['tujuan'] ?? null,
                        'keterangan'    => $data['keterangan'] ?? null,
                        'user_id'       => $request->user()->id,
                        'status'        => 'pending_superadmin',
                    ]);
                }
            });

            return redirect()->route('stock-outs.index')->with('success', 'Permintaan Barang Keluar berhasil diajukan. Menunggu persetujuan Superadmin.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy(StockOut $stockOut)
    {
        // Only allow deletion if still pending (not yet approved)
        if ($stockOut->status === 'approved') {
            return back()->with('error', 'Transaksi yang sudah disetujui tidak bisa dihapus langsung.');
        }

        try {
            $stockOut->delete();
            return redirect()->route('stock-outs.index')->with('success', 'Pengajuan berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
