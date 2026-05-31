<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\StockIn;
use App\Models\StockMutation;
use App\Models\StockOut;
use App\Http\Requests\StockMovementRequest;

class StockController extends Controller
{
    public function index()
    {
        return view('stock.index', [
            'movements' => StockMutation::with('item')->latest()->get(),
        ]);
    }

    public function create()
    {
        return view('stock.create', [
            'items' => Item::orderBy('nama_barang')->get(),
        ]);
    }

    public function store(StockMovementRequest $request)
    {
        $data = $request->validated();

        $item = Item::findOrFail($data['item_id']);

        if ($data['type'] === 'out' && $item->stok < $data['quantity']) {
            return back()->withInput()->with('error', 'Stok tidak mencukupi untuk pengeluaran.');
        }

        $stokSebelum = $item->stok;
        $item->stok += $data['type'] === 'in' ? $data['quantity'] : -$data['quantity'];
        $item->save();

        if ($data['type'] === 'in') {
            StockIn::create([
                'item_id' => $item->id,
                'jumlah' => $data['quantity'],
                'tanggal_masuk' => now()->toDateString(),
                'supplier' => $data['supplier'] ?? 'Pemasok umum',
                'keterangan' => $data['keterangan'] ?? null,
                'user_id' => $request->user()->id,
            ]);
        } else {
            StockOut::create([
                'item_id' => $item->id,
                'jumlah' => $data['quantity'],
                'tanggal_keluar' => now()->toDateString(),
                'tujuan' => $data['tujuan'] ?? 'Pengeluaran gudang',
                'keterangan' => $data['keterangan'] ?? null,
                'user_id' => $request->user()->id,
            ]);
        }

        StockMutation::create([
            'item_id' => $item->id,
            'tipe_mutasi' => $data['type'],
            'jumlah' => $data['quantity'],
            'stok_sebelum' => $stokSebelum,
            'stok_sesudah' => $item->stok,
            'referensi' => $data['type'] === 'in' ? ($data['supplier'] ?? 'Pemasok umum') : ($data['tujuan'] ?? 'Pengeluaran'),
            'created_by' => $request->user()->id,
        ]);

        return redirect()->route('stock.movements.index')->with('success', 'Pergerakan stok berhasil disimpan.');
    }
}
