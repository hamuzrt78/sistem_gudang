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
        $pendingIns  = StockIn::with('item', 'user')->where('status', 'pending_superadmin')->latest()->get();
        $pendingOuts = StockOut::with('item', 'user')->where('status', 'pending_superadmin')->latest()->get();
        
        $historyIns  = StockIn::with('item', 'user')->where('status', '!=', 'pending_superadmin')->latest()->paginate(5, ['*'], 'page_in');
        $historyOuts = StockOut::with('item', 'user')->where('status', '!=', 'pending_superadmin')->latest()->paginate(5, ['*'], 'page_out');
        
        return view('approvals.superadmin', compact('pendingIns', 'pendingOuts', 'historyIns', 'historyOuts'));
    }

    public function superadminApproveIn(StockIn $stockIn)
    {
        if ($stockIn->status !== 'pending_superadmin') {
            return back()->with('error', 'Status tidak valid untuk tindakan ini.');
        }
        $stockIn->update(['status' => 'pending_pimpinan']);
        return back()->with('success', 'Pengajuan Barang Masuk diteruskan ke Pimpinan.');
    }

    public function superadminApproveOut(StockOut $stockOut)
    {
        if ($stockOut->status !== 'pending_superadmin') {
            return back()->with('error', 'Status tidak valid untuk tindakan ini.');
        }
        $stockOut->update(['status' => 'pending_pimpinan']);
        return back()->with('success', 'Pengajuan Barang Keluar diteruskan ke Pimpinan.');
    }

    public function superadminRejectIn(StockIn $stockIn)
    {
        if ($stockIn->status !== 'pending_superadmin') {
            return back()->with('error', 'Status tidak valid untuk tindakan ini.');
        }
        $stockIn->update(['status' => 'rejected']);
        return back()->with('success', 'Pengajuan Barang Masuk telah ditolak.');
    }

    public function superadminRejectOut(StockOut $stockOut)
    {
        if ($stockOut->status !== 'pending_superadmin') {
            return back()->with('error', 'Status tidak valid untuk tindakan ini.');
        }
        $stockOut->update(['status' => 'rejected']);
        return back()->with('success', 'Pengajuan Barang Keluar telah ditolak.');
    }

    // =========================================================
    // PIMPINAN LEVEL: Final approve/reject pending_pimpinan
    // =========================================================

    public function pimpinanIndex()
    {
        $pendingIns  = StockIn::with('item', 'user')->where('status', 'pending_pimpinan')->latest()->get();
        $pendingOuts = StockOut::with('item', 'user')->where('status', 'pending_pimpinan')->latest()->get();
        
        $historyIns  = StockIn::with('item', 'user')->whereIn('status', ['approved', 'rejected'])->latest()->paginate(5, ['*'], 'page_in');
        $historyOuts = StockOut::with('item', 'user')->whereIn('status', ['approved', 'rejected'])->latest()->paginate(5, ['*'], 'page_out');
        
        return view('approvals.pimpinan', compact('pendingIns', 'pendingOuts', 'historyIns', 'historyOuts'));
    }

    public function pimpinanApproveIn(StockIn $stockIn)
    {
        if ($stockIn->status !== 'pending_pimpinan') {
            return back()->with('error', 'Status tidak valid untuk tindakan ini.');
        }

        try {
            DB::transaction(function () use ($stockIn) {
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
                    'referensi'    => 'IN-' . str_pad($stockIn->id, 5, '0', STR_PAD_LEFT),
                    'created_by'   => auth()->id(),
                ]);

                $stockIn->update(['status' => 'approved']);
            });

            return back()->with('success', 'Barang Masuk disetujui. Stok barang telah bertambah.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function pimpinanApproveOut(StockOut $stockOut)
    {
        if ($stockOut->status !== 'pending_pimpinan') {
            return back()->with('error', 'Status tidak valid untuk tindakan ini.');
        }

        try {
            DB::transaction(function () use ($stockOut) {
                $item = Item::lockForUpdate()->find($stockOut->item_id);

                if ($item->stok < $stockOut->jumlah) {
                    throw new \Exception('Stok tidak mencukupi untuk transaksi ini.');
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
                    'referensi'    => 'OUT-' . str_pad($stockOut->id, 5, '0', STR_PAD_LEFT),
                    'created_by'   => auth()->id(),
                ]);

                $stockOut->update(['status' => 'approved']);
            });

            return back()->with('success', 'Barang Keluar disetujui. Stok barang telah berkurang.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function pimpinanRejectIn(StockIn $stockIn)
    {
        if ($stockIn->status !== 'pending_pimpinan') {
            return back()->with('error', 'Status tidak valid untuk tindakan ini.');
        }
        $stockIn->update(['status' => 'rejected']);
        return back()->with('success', 'Pengajuan Barang Masuk telah ditolak.');
    }

    public function pimpinanRejectOut(StockOut $stockOut)
    {
        if ($stockOut->status !== 'pending_pimpinan') {
            return back()->with('error', 'Status tidak valid untuk tindakan ini.');
        }
        $stockOut->update(['status' => 'rejected']);
        return back()->with('success', 'Pengajuan Barang Keluar telah ditolak.');
    }
}
