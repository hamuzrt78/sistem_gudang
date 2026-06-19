<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\StockIn;
use App\Models\StockOut;
use App\Models\StockMutation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApprovalController extends Controller
{
    // =========================================================
    // SUPERADMIN LEVEL: Approve/Reject pending_superadmin items
    // =========================================================

    public function superadminIndex()
    {
        $pendingPengajuans = \App\Models\Pengajuan::with(['user', 'stockIns.item', 'stockOuts.item'])
                                ->where('status', 'pending_superadmin')
                                ->latest()
                                ->get();
        
        $historyPengajuans = \App\Models\Pengajuan::with(['user', 'stockIns.item', 'stockOuts.item'])
                                ->where('status', '!=', 'pending_superadmin')
                                ->latest()
                                ->paginate(10);
        
        return view('approvals.superadmin', compact('pendingPengajuans', 'historyPengajuans'));
    }

    public function superadminApprove(\App\Models\Pengajuan $pengajuan)
    {
        if ($pengajuan->status !== 'pending_superadmin') {
            return back()->with('error', 'Status tidak valid untuk tindakan ini.');
        }
        $pengajuan->update(['status' => 'pending_pimpinan']);
        return back()->with('success', 'Pengajuan diteruskan ke Pimpinan.');
    }

    public function superadminReject(\App\Models\Pengajuan $pengajuan)
    {
        if ($pengajuan->status !== 'pending_superadmin') {
            return back()->with('error', 'Status tidak valid untuk tindakan ini.');
        }
        $pengajuan->update(['status' => 'rejected']);
        return back()->with('success', 'Pengajuan telah ditolak.');
    }

    // =========================================================
    // PIMPINAN LEVEL: Final approve/reject pending_pimpinan
    // =========================================================

    public function pimpinanIndex()
    {
        $pendingPengajuans = \App\Models\Pengajuan::with(['user', 'stockIns.item', 'stockOuts.item'])
                                ->where('status', 'pending_pimpinan')
                                ->latest()
                                ->get();
        
        $historyPengajuans = \App\Models\Pengajuan::with(['user', 'stockIns.item', 'stockOuts.item'])
                                ->whereIn('status', ['approved', 'rejected'])
                                ->latest()
                                ->paginate(10);
        
        return view('approvals.pimpinan', compact('pendingPengajuans', 'historyPengajuans'));
    }

    public function pimpinanApprove(\App\Models\Pengajuan $pengajuan)
    {
        if ($pengajuan->status !== 'pending_pimpinan') {
            return back()->with('error', 'Status tidak valid untuk tindakan ini.');
        }

        try {
            DB::transaction(function () use ($pengajuan) {
                if ($pengajuan->tipe === 'in') {
                    foreach ($pengajuan->stockIns as $stockIn) {
                        $item = Item::lockForUpdate()->find($stockIn->item_id);
                        $stokSebelum = $item->stok;
                        $item->stok += $stockIn->jumlah;
                        $item->save();

                        StockMutation::create([
                            'item_id'      => $item->id,
                            'tipe_mutasi'  => 'in',
                            'jumlah'       => $stockIn->jumlah,
                            'stok_sebelum' => $stokSebelum,
                            'stok_sesudah' => $item->stok,
                            'referensi'    => $pengajuan->kode_pengajuan,
                            'created_by'   => auth()->id(),
                        ]);
                    }
                } else if ($pengajuan->tipe === 'out') {
                    foreach ($pengajuan->stockOuts as $stockOut) {
                        $item = Item::lockForUpdate()->find($stockOut->item_id);

                        if ($item->stok < $stockOut->jumlah) {
                            throw new \Exception("Stok {$item->nama_barang} tidak mencukupi.");
                        }

                        $stokSebelum = $item->stok;
                        $item->stok -= $stockOut->jumlah;
                        $item->save();

                        StockMutation::create([
                            'item_id'      => $item->id,
                            'tipe_mutasi'  => 'out',
                            'jumlah'       => $stockOut->jumlah,
                            'stok_sebelum' => $stokSebelum,
                            'stok_sesudah' => $item->stok,
                            'referensi'    => $pengajuan->kode_pengajuan,
                            'created_by'   => auth()->id(),
                        ]);
                    }
                }

                $pengajuan->update(['status' => 'approved']);
            });

            return back()->with('success', 'Pengajuan disetujui. Stok barang telah dimutasi.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function pimpinanReject(\App\Models\Pengajuan $pengajuan)
    {
        if ($pengajuan->status !== 'pending_pimpinan') {
            return back()->with('error', 'Status tidak valid untuk tindakan ini.');
        }
        $pengajuan->update(['status' => 'rejected']);
        return back()->with('success', 'Pengajuan telah ditolak.');
    }
}
