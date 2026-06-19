@extends('layouts.app')

@section('header', 'Approval Transaksi - Level Pimpinan')

@section('content')
<div class="space-y-8">

    <!-- ============ ANTRIAN PENGAJUAN ============ -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-teal-50 to-white flex flex-wrap gap-4 items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="bg-teal-100 p-2.5 rounded-lg text-teal-700">
                    <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                </div>
                <div>
                    <h2 class="text-base font-bold text-gray-800">Antrean Pengajuan</h2>
                    <p class="text-xs text-gray-500 font-medium">Pengajuan yang telah disetujui Superadmin dan menunggu finalisasi Anda</p>
                </div>
            </div>
            <span class="bg-amber-50 text-amber-700 border border-amber-200 text-xs font-bold px-3 py-1 rounded-full shadow-sm">{{ $pendingPengajuans->count() }} Pengajuan</span>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100">
                <thead class="bg-gray-50/80">
                    <tr>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Kode</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tipe</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Daftar Barang</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tujuan/Supplier</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Diajukan Oleh</th>
                        <th class="px-6 py-3.5 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($pendingPengajuans as $pengajuan)
                    <tr class="hover:bg-teal-50/20 even:bg-gray-50/30 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-teal-700">{{ $pengajuan->kode_pengajuan }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">{{ $pengajuan->tanggal }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold">
                            @if($pengajuan->tipe === 'in')
                                <span class="text-emerald-600">Barang Masuk</span>
                            @else
                                <span class="text-rose-600">Barang Keluar</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">
                            <ul class="list-disc list-inside space-y-1">
                                @if($pengajuan->tipe === 'in')
                                    @foreach($pengajuan->stockIns as $in)
                                        <li>{{ $in->item->nama_barang ?? '-' }} <span class="font-bold text-emerald-600">(+{{ $in->jumlah }})</span></li>
                                    @endforeach
                                @else
                                    @foreach($pengajuan->stockOuts as $out)
                                        <li>{{ $out->item->nama_barang ?? '-' }} <span class="font-bold text-rose-600">(-{{ $out->jumlah }})</span></li>
                                    @endforeach
                                @endif
                            </ul>
                            @if($pengajuan->keterangan_umum)
                                <p class="mt-2 text-xs text-gray-500 italic">Ket: {{ $pengajuan->keterangan_umum }}</p>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">{{ $pengajuan->supplier_tujuan ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-medium">{{ $pengajuan->user->name ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="flex items-center justify-center gap-2">
                                <form action="{{ route('approvals.pimpinan.approve', $pengajuan->id) }}" method="POST" onsubmit="confirmAction(event, 'Setujui pengajuan ini? Stok barang akan termutasi secara otomatis.')">
                                    @csrf
                                    <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white text-xs font-semibold px-3.5 py-2 rounded-lg transition-colors duration-150 shadow-sm inline-flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Setujui
                                    </button>
                                </form>
                                <form action="{{ route('approvals.pimpinan.reject', $pengajuan->id) }}" method="POST" onsubmit="confirmAction(event, 'Tolak pengajuan ini secara final?')">
                                    @csrf
                                    <button type="submit" class="bg-rose-600 hover:bg-rose-700 text-white text-xs font-semibold px-3.5 py-2 rounded-lg transition-colors duration-150 shadow-sm inline-flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        Tolak
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                            <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <p class="font-medium text-gray-500">Tidak ada pengajuan yang menunggu persetujuan Anda.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- ============ RIWAYAT PENGAJUAN ============ -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mt-8">
        <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white flex flex-wrap gap-4 items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="bg-gray-100 p-2.5 rounded-lg text-gray-700">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h2 class="text-base font-bold text-gray-800">Riwayat Pengajuan</h2>
                    <p class="text-xs text-gray-500 font-medium">Daftar pengajuan yang telah selesai diproses (Disetujui/Ditolak)</p>
                </div>
            </div>
            <span class="bg-gray-100 text-gray-700 border border-gray-200 text-xs font-bold px-3 py-1 rounded-full shadow-sm">{{ $historyPengajuans->total() }} Riwayat</span>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100">
                <thead class="bg-gray-50/80">
                    <tr>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Kode</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tipe</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Daftar Barang</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tujuan/Supplier</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Diajukan Oleh</th>
                        <th class="px-6 py-3.5 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($historyPengajuans as $pengajuan)
                    <tr class="hover:bg-gray-50/50 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-700">{{ $pengajuan->kode_pengajuan }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">{{ $pengajuan->tanggal }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold">
                            @if($pengajuan->tipe === 'in')
                                <span class="text-emerald-600">Barang Masuk</span>
                            @else
                                <span class="text-rose-600">Barang Keluar</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">
                            <ul class="list-disc list-inside space-y-1">
                                @if($pengajuan->tipe === 'in')
                                    @foreach($pengajuan->stockIns as $in)
                                        <li>{{ $in->item->nama_barang ?? '-' }} <span class="font-bold text-emerald-600">(+{{ $in->jumlah }})</span></li>
                                    @endforeach
                                @else
                                    @foreach($pengajuan->stockOuts as $out)
                                        <li>{{ $out->item->nama_barang ?? '-' }} <span class="font-bold text-rose-600">(-{{ $out->jumlah }})</span></li>
                                    @endforeach
                                @endif
                            </ul>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">{{ $pengajuan->supplier_tujuan ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-medium">{{ $pengajuan->user->name ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @if($pengajuan->status === 'approved')
                                <span class="bg-emerald-100 text-emerald-700 text-xs px-2.5 py-1 rounded-md font-semibold">Approved</span>
                            @elseif($pengajuan->status === 'rejected')
                                <span class="bg-rose-100 text-rose-700 text-xs px-2.5 py-1 rounded-md font-semibold">Rejected</span>
                            @else
                                <span class="bg-gray-100 text-gray-700 text-xs px-2.5 py-1 rounded-md font-semibold">{{ $pengajuan->status }}</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                            <p class="font-medium text-gray-500">Belum ada riwayat persetujuan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($historyPengajuans->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
            {{ $historyPengajuans->links() }}
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
function confirmAction(event, message) {
    event.preventDefault();
    const form = event.target;
    
    Swal.fire({
        title: 'Konfirmasi Approval Final',
        text: message,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#0d9488',
        cancelButtonColor: '#e11d48',
        confirmButtonText: 'Ya, Lanjutkan',
        cancelButtonText: 'Batal',
        customClass: {
            popup: 'rounded-2xl',
            confirmButton: 'rounded-xl px-5 py-2.5 text-sm font-semibold shadow-sm',
            cancelButton: 'rounded-xl px-5 py-2.5 text-sm font-semibold shadow-sm'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}
</script>
@endpush
@endsection
