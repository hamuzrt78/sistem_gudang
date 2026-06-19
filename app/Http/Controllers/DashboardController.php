<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\StockIn;
use App\Models\StockOut;
use App\Models\StockMutation;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = Item::count();
        $totalKategori = Category::count();
        $totalStokMasuk = StockIn::sum('jumlah');
        $totalStokKeluar = StockOut::sum('jumlah');
        $barangHampirHabis = Item::whereColumn('stok', '<=', 'stok_minimum')->get();
        $aktivitasTerbaru = StockMutation::with('item', 'user')->latest()->take(5)->get();

        // Grafik 7 hari terakhir mutasi in/out
        $dates = collect();
        $inData = [];
        $outData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $dates->push($date);
            $inData[] = StockIn::whereDate('tanggal_masuk', $date)->sum('jumlah');
            $outData[] = StockOut::whereDate('tanggal_keluar', $date)->sum('jumlah');
        }

        // Pending approvals for pimpinan
        $pendingPengajuansPimpinan = \App\Models\Pengajuan::with('user', 'stockIns.item', 'stockOuts.item')->where('status', 'pending_pimpinan')->latest()->get();

        return view('dashboard', compact(
            'totalBarang',
            'totalKategori',
            'totalStokMasuk',
            'totalStokKeluar',
            'barangHampirHabis',
            'aktivitasTerbaru',
            'dates',
            'inData',
            'outData',
            'pendingPengajuansPimpinan'
        ));
    }
}
