@extends('layouts.app')

@section('header', 'Manajemen Barang')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gradient-to-r from-teal-50 to-white">
        <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
            <span class="w-2.5 h-6 bg-teal-500 rounded-full inline-block"></span>
            Daftar Barang
        </h2>
        <a href="{{ route('items.create') }}" class="bg-gradient-to-r from-teal-500 to-emerald-600 hover:from-teal-600 hover:to-emerald-700 text-white font-semibold px-5 py-2.5 rounded-lg shadow-sm hover:shadow transition-all duration-200 transform hover:-translate-y-0.5 text-sm inline-flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Barang
        </a>
    </div>
    
    <div class="p-4 border-b border-gray-100 flex gap-4 bg-gray-50/50">
        <form method="GET" action="{{ route('items.index') }}" class="flex flex-wrap gap-3 w-full items-center">
            <div class="relative w-full sm:w-1/3">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari barang..." class="pl-10 border-gray-200 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 rounded-lg shadow-sm sm:text-sm w-full transition-colors duration-150">
            </div>
            
            <select name="kategori" class="border-gray-200 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 rounded-lg shadow-sm sm:text-sm transition-colors duration-150">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('kategori') == $cat->id ? 'selected' : '' }}>{{ $cat->nama_kategori }}</option>
                @endforeach
            </select>
            
            <button type="submit" class="bg-gray-800 text-white font-medium px-5 py-2 rounded-lg text-sm hover:bg-gray-900 transition-colors duration-150 shadow-sm">
                Filter
            </button>
            
            @if(request('search') || request('kategori'))
                <a href="{{ route('items.index') }}" class="text-gray-500 hover:text-gray-700 font-medium text-sm transition-colors duration-150">
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
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Kategori & Satuan</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Harga</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Stok</th>
                    <th class="px-6 py-3.5 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($items as $item)
                <tr class="hover:bg-teal-50/20 even:bg-gray-50/30 transition-colors duration-150">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $item->kode_barang }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-medium">{{ $item->nama_barang }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-teal-55 text-teal-800 border border-teal-100">
                            {{ $item->category->nama_kategori ?? '-' }}
                        </span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200 ml-1">
                            {{ $item->unit->nama_satuan ?? '-' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-teal-700 font-semibold">
                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <span class="{{ $item->stok <= $item->stok_minimum ? 'bg-red-50 text-red-700 border border-red-100 font-bold' : 'bg-emerald-50 text-emerald-700 border border-emerald-100 font-semibold' }} px-3 py-1 rounded-full text-xs">
                            {{ $item->stok }}
                        </span>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('items.edit', $item->id) }}" class="text-teal-600 hover:text-teal-900 font-semibold transition-colors duration-150 mr-3 inline-flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            Edit
                        </a>
                        <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 font-semibold transition-colors duration-150 inline-flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4 border-t border-gray-100 bg-gray-50/50">
        {{ $items->links() }}
    </div>
</div>
@endsection
