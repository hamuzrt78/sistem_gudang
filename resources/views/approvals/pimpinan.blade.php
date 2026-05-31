@extends('layouts.app')

@section('header', 'Approval Final - Pimpinan')

@section('content')
<div class="space-y-8">

    <!-- ============ BARANG MASUK ============ -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-teal-50 to-white flex flex-wrap gap-4 items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="bg-teal-100 p-2.5 rounded-lg text-teal-700">
                    <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                </div>
                <div>
                    <h2 class="text-base font-bold text-gray-800">Barang Masuk – Menunggu Persetujuan Final</h2>
                    <p class="text-xs text-gray-500 font-medium">Telah disetujui oleh Superadmin, memerlukan verifikasi akhir Anda</p>
                </div>
            </div>
            <span class="bg-amber-50 text-amber-700 border border-amber-200 text-xs font-bold px-3 py-1 rounded-full shadow-sm">{{ $pendingIns->count() }} Pengajuan</span>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100">
                <thead class="bg-gray-50/80">
                    <tr>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Barang</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Stok Saat Ini</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Jumlah Masuk</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Harga Satuan</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Harga</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Supplier</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Diajukan Oleh</th>
                        <th class="px-6 py-3.5 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($pendingIns as $in)
                    <tr class="hover:bg-teal-50/20 even:bg-gray-50/30 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">{{ $in->tanggal_masuk }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $in->item->nama_barang ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-semibold">{{ $in->item->stok ?? 0 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <span class="text-emerald-600 font-bold">+{{ $in->jumlah }}</span>
                            <span class="text-xs text-gray-400 font-medium ml-1">→ {{ ($in->item->stok ?? 0) + $in->jumlah }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Rp {{ number_format($in->item->harga ?? 0, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-teal-700 font-bold">Rp {{ number_format(($in->item->harga ?? 0) * $in->jumlah, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">{{ $in->supplier ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-medium">{{ $in->user->name ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="flex items-center justify-center gap-2">
                                <form action="{{ route('approvals.pimpinan.in.approve', $in->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Setujui permintaan ini? Stok akan BERTAMBAH sebanyak {{ $in->jumlah }}.')" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold px-3.5 py-2 rounded-lg transition-colors duration-150 shadow-sm inline-flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Setujui
                                    </button>
                                </form>
                                <form action="{{ route('approvals.pimpinan.in.reject', $in->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Tolak permintaan ini? Stok tidak akan berubah.')" class="bg-rose-600 hover:bg-rose-700 text-white text-xs font-semibold px-3.5 py-2 rounded-lg transition-colors duration-150 shadow-sm inline-flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        Tolak
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="px-6 py-12 text-center text-gray-400">
                            <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <p class="font-medium text-gray-500">Tidak ada pengajuan barang masuk yang menunggu persetujuan final.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- ============ BARANG KELUAR ============ -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-teal-50 to-white flex flex-wrap gap-4 items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="bg-teal-100 p-2.5 rounded-lg text-teal-700">
                    <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </div>
                <div>
                    <h2 class="text-base font-bold text-gray-800">Barang Keluar – Menunggu Persetujuan Final</h2>
                    <p class="text-xs text-gray-500 font-medium">Telah disetujui oleh Superadmin, memerlukan verifikasi akhir Anda</p>
                </div>
            </div>
            <span class="bg-amber-50 text-amber-700 border border-amber-200 text-xs font-bold px-3 py-1 rounded-full shadow-sm">{{ $pendingOuts->count() }} Pengajuan</span>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100">
                <thead class="bg-gray-50/80">
                    <tr>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Barang</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Stok Saat Ini</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Jumlah Keluar</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Harga Satuan</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Harga</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tujuan</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Diajukan Oleh</th>
                        <th class="px-6 py-3.5 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($pendingOuts as $out)
                    <tr class="hover:bg-teal-50/20 even:bg-gray-50/30 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">{{ $out->tanggal_keluar }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $out->item->nama_barang ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-semibold">{{ $out->item->stok ?? 0 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <span class="text-rose-600 font-bold">-{{ $out->jumlah }}</span>
                            <span class="text-xs text-gray-400 font-medium ml-1">→ {{ max(0, ($out->item->stok ?? 0) - $out->jumlah) }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Rp {{ number_format($out->item->harga ?? 0, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-teal-700 font-bold">Rp {{ number_format(($out->item->harga ?? 0) * $out->jumlah, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">{{ $out->tujuan ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-medium">{{ $out->user->name ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="flex items-center justify-center gap-2">
                                <form action="{{ route('approvals.pimpinan.out.approve', $out->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Setujui permintaan ini? Stok akan BERKURANG sebanyak {{ $out->jumlah }}.')" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold px-3.5 py-2 rounded-lg transition-colors duration-150 shadow-sm inline-flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Setujui
                                    </button>
                                </form>
                                <form action="{{ route('approvals.pimpinan.out.reject', $out->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Tolak permintaan ini? Stok tidak akan berubah.')" class="bg-rose-600 hover:bg-rose-700 text-white text-xs font-semibold px-3.5 py-2 rounded-lg transition-colors duration-150 shadow-sm inline-flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        Tolak
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="px-6 py-12 text-center text-gray-400">
                            <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <p class="font-medium text-gray-500">Tidak ada pengajuan barang keluar yang menunggu persetujuan final.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
