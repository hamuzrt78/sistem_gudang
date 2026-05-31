@extends('layouts.app')

@section('header', 'Laporan Stok Barang')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-gradient-to-r from-teal-50 to-white">
        <div>
            <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                <span class="w-2.5 h-6 bg-teal-500 rounded-full inline-block"></span>
                Laporan Stok Saat Ini
            </h2>
            <p class="text-xs text-gray-500 font-medium">Monitoring tingkat ketersediaan stok barang secara real-time</p>
        </div>
        <div class="flex items-center gap-2.5">
            <a href="{{ route('laporan.export.excel', ['type' => 'stok']) }}" class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-4 py-2 rounded-lg shadow-sm hover:shadow transition-all duration-200 transform hover:-translate-y-0.5 text-xs inline-flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Export Excel
            </a>
            <a href="{{ route('laporan.export.pdf', ['type' => 'stok']) }}" class="bg-rose-600 hover:bg-rose-700 text-white font-semibold px-4 py-2 rounded-lg shadow-sm hover:shadow transition-all duration-200 transform hover:-translate-y-0.5 text-xs inline-flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                Export PDF
            </a>
        </div>
    </div>

    <!-- Filter -->
    <div class="p-4 border-b border-gray-100 bg-gray-50/50 flex items-center">
        <form method="GET" action="{{ route('laporan.stok') }}" class="flex flex-wrap items-center gap-3 w-full">
            <div class="relative w-full sm:w-64">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama barang..." class="pl-10 border-gray-200 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 rounded-lg shadow-sm text-sm w-full transition-colors duration-150">
            </div>
            
            <select name="kategori" class="border-gray-200 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 rounded-lg shadow-sm text-sm transition-colors duration-150">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('kategori') == $cat->id ? 'selected' : '' }}>{{ $cat->nama_kategori }}</option>
                @endforeach
            </select>
            
            <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white font-semibold px-4 py-2 rounded-lg text-sm shadow-sm transition-colors duration-150">
                Filter
            </button>
            
            @if(request('search') || request('kategori'))
                <a href="{{ route('laporan.stok') }}" class="text-gray-500 hover:text-gray-700 font-semibold text-sm transition-colors duration-150 ml-2">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-100">
            <thead class="bg-gray-50/80">
                <tr>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Kode</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama Barang</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Kategori</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Satuan</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Stok</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Harga Satuan</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nilai Stok</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Min. Stok</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($items as $item)
                <tr class="hover:bg-teal-50/20 even:bg-gray-50/30 transition-colors duration-150">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">{{ $item->kode_barang }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $item->nama_barang }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">{{ $item->category->nama_kategori ?? '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">{{ $item->unit->nama_satuan ?? '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold {{ $item->stok <= $item->stok_minimum ? 'text-rose-600' : 'text-emerald-600' }}">
                        {{ $item->stok }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-medium font-mono">Rp {{ number_format($item->harga ?? 0, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-teal-700 font-bold font-mono">Rp {{ number_format(($item->harga ?? 0) * $item->stok, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-semibold">{{ $item->stok_minimum }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($item->stok <= $item->stok_minimum)
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-50 text-red-700 border border-red-200">Kritis</span>
                        @else
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">Aman</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="9" class="px-6 py-12 text-center text-gray-400">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="font-medium text-gray-500">Tidak ada data stok barang.</p>
                </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
