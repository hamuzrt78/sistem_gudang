@extends('layouts.app')

@section('header', 'Laporan Barang Masuk')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-gradient-to-r from-teal-50 to-white">
        <div>
            <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                <span class="w-2.5 h-6 bg-teal-500 rounded-full inline-block"></span>
                Laporan Barang Masuk
            </h2>
            <p class="text-xs text-gray-500 font-medium">Rekapitulasi data log barang masuk yang disetujui</p>
        </div>
        <div class="flex items-center gap-2.5">
            <a href="{{ route('laporan.export.excel', ['type' => 'masuk']) }}" class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-4 py-2 rounded-lg shadow-sm hover:shadow transition-all duration-200 transform hover:-translate-y-0.5 text-xs inline-flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Export Excel
            </a>
            <a href="{{ route('laporan.export.pdf', ['type' => 'masuk']) }}" class="bg-rose-600 hover:bg-rose-700 text-white font-semibold px-4 py-2 rounded-lg shadow-sm hover:shadow transition-all duration-200 transform hover:-translate-y-0.5 text-xs inline-flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                Export PDF
            </a>
        </div>
    </div>

    <!-- Filter -->
    <div class="p-4 border-b border-gray-100 bg-gray-50/50 flex items-center">
        <form action="{{ route('laporan.masuk') }}" method="GET" class="flex flex-wrap items-center gap-3 w-full">
            <span class="text-gray-600 text-sm font-semibold">Filter Tanggal:</span>
            <input type="date" name="start_date" value="{{ request('start_date') }}" class="border-gray-200 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 rounded-lg shadow-sm text-sm transition-colors duration-150">
            <span class="text-gray-400 font-semibold">—</span>
            <input type="date" name="end_date" value="{{ request('end_date') }}" class="border-gray-200 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 rounded-lg shadow-sm text-sm transition-colors duration-150">
            
            <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white font-semibold px-4 py-2 rounded-lg text-sm shadow-sm transition-colors duration-150">
                Filter
            </button>
            
            @if(request('start_date') || request('end_date'))
                <a href="{{ route('laporan.masuk') }}" class="text-gray-500 hover:text-gray-700 font-semibold text-sm transition-colors duration-150 ml-2">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-100">
            <thead class="bg-gray-50/80">
                <tr>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Barang</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Jumlah Masuk</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Harga Satuan</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Harga</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Supplier</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Keterangan</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Pencatat</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($stockIns as $in)
                <tr class="hover:bg-teal-50/20 even:bg-gray-50/30 transition-colors duration-150">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">{{ $in->tanggal_masuk }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $in->item->nama_barang ?? '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-emerald-600">+{{ $in->jumlah }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Rp {{ number_format($in->item->harga ?? 0, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-teal-700 font-bold">Rp {{ number_format(($in->item->harga ?? 0) * $in->jumlah, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">{{ $in->supplier ?: '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 max-w-xs truncate font-medium">{{ $in->keterangan ?: '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-medium">{{ $in->user->name ?? '-' }}</td>
                </tr>
                @empty
                <tr><td colspan="8" class="px-6 py-12 text-center text-gray-400">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="font-medium text-gray-500">Tidak ada data barang masuk.</p>
                </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
