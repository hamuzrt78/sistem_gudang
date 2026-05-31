<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\StockIn;
use App\Models\StockOut;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function stok(Request $request)
    {
        $query = Item::with(['category', 'unit']);
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('category_id', $request->kategori);
        }
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_barang', 'like', '%' . $request->search . '%');
        }
        $items = $query->get();
        $categories = \App\Models\Category::all();

        return view('reports.stok', compact('items', 'categories'));
    }

    public function masuk(Request $request)
    {
        $query = StockIn::with(['item', 'user']);
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('tanggal_masuk', [$request->start_date, $request->end_date]);
        }
        $stockIns = $query->latest()->get();
        return view('reports.masuk', compact('stockIns'));
    }

    public function keluar(Request $request)
    {
        $query = StockOut::with(['item', 'user']);
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('tanggal_keluar', [$request->start_date, $request->end_date]);
        }
        $stockOuts = $query->latest()->get();
        return view('reports.keluar', compact('stockOuts'));
    }

    public function exportPdf(Request $request)
    {
        $type = $request->type; 
        
        if ($type == 'stok') {
            $items = Item::with(['category', 'unit'])->get();
            $pdf = Pdf::loadView('reports.pdf.stok', compact('items'));
            return $pdf->download('laporan-stok.pdf');
        } else if ($type == 'masuk') {
            $stockIns = StockIn::with(['item', 'user'])->latest()->get();
            $pdf = Pdf::loadView('reports.pdf.masuk', compact('stockIns'));
            return $pdf->download('laporan-barang-masuk.pdf');
        } else if ($type == 'keluar') {
            $stockOuts = StockOut::with(['item', 'user'])->latest()->get();
            $pdf = Pdf::loadView('reports.pdf.keluar', compact('stockOuts'));
            return $pdf->download('laporan-barang-keluar.pdf');
        }

        abort(404);
    }
    
    public function exportExcel(Request $request)
    {
        $type = $request->type;
        $filename = "laporan-{$type}-" . date('Ymd') . ".csv";
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use($type) {
            $file = fopen('php://output', 'w');
            
            if ($type == 'stok') {
                fputcsv($file, ['Kode Barang', 'Nama Barang', 'Kategori', 'Satuan', 'Stok', 'Harga Satuan', 'Nilai Stok', 'Stok Minimum', 'Lokasi Rak']);
                $items = Item::with(['category', 'unit'])->get();
                foreach ($items as $item) {
                    fputcsv($file, [$item->kode_barang, $item->nama_barang, $item->category->nama_kategori ?? '-', $item->unit->nama_satuan ?? '-', $item->stok, $item->harga, ($item->harga * $item->stok), $item->stok_minimum, $item->lokasi_rak]);
                }
            } else if ($type == 'masuk') {
                fputcsv($file, ['Tanggal', 'Kode Barang', 'Nama Barang', 'Jumlah', 'Harga Satuan', 'Total Harga', 'Supplier', 'Keterangan', 'Pencatat']);
                $ins = StockIn::with(['item', 'user'])->get();
                foreach ($ins as $in) {
                    $harga = $in->item->harga ?? 0;
                    fputcsv($file, [$in->tanggal_masuk, $in->item->kode_barang ?? '-', $in->item->nama_barang ?? '-', $in->jumlah, $harga, ($harga * $in->jumlah), $in->supplier, $in->keterangan, $in->user->name ?? '-']);
                }
            } else if ($type == 'keluar') {
                fputcsv($file, ['Tanggal', 'Kode Barang', 'Nama Barang', 'Jumlah', 'Harga Satuan', 'Total Harga', 'Tujuan', 'Keterangan', 'Pencatat']);
                $outs = StockOut::with(['item', 'user'])->get();
                foreach ($outs as $out) {
                    $harga = $out->item->harga ?? 0;
                    fputcsv($file, [$out->tanggal_keluar, $out->item->kode_barang ?? '-', $out->item->nama_barang ?? '-', $out->jumlah, $harga, ($harga * $out->jumlah), $out->tujuan, $out->keterangan, $out->user->name ?? '-']);
                }
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
