@extends('layouts.app')

@section('header', 'Tambah Barang')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 max-w-2xl overflow-hidden">
    <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-teal-50 to-white">
        <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
            <span class="w-2.5 h-6 bg-teal-500 rounded-full inline-block"></span>
            Form Tambah Barang Baru
        </h2>
    </div>
    
    <form action="{{ route('items.store') }}" method="POST" class="p-6">
        @csrf
        <div class="space-y-5">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Nama Barang</label>
                    <input type="text" name="nama_barang" required class="block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 sm:text-sm transition-colors duration-150" placeholder="Masukkan nama barang">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Harga (Rp)</label>
                    <input type="number" name="harga" value="0" min="0" required class="block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 sm:text-sm transition-colors duration-150">
                </div>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Kategori</label>
                    <select name="category_id" required class="block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 sm:text-sm transition-colors duration-150">
                        @foreach($categories as $cat) 
                            <option value="{{ $cat->id }}">{{ $cat->nama_kategori }}</option> 
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Satuan</label>
                    <select name="unit_id" required class="block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 sm:text-sm transition-colors duration-150">
                        @foreach($units as $unit) 
                            <option value="{{ $unit->id }}">{{ $unit->nama_satuan }}</option> 
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Stok Awal</label>
                    <input type="number" name="stok" value="0" min="0" required class="block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 sm:text-sm transition-colors duration-150">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Stok Minimum</label>
                    <input type="number" name="stok_minimum" value="0" min="0" required class="block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 sm:text-sm transition-colors duration-150">
                </div>
            </div>
            
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Lokasi Rak</label>
                <input type="text" name="lokasi_rak" class="block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 sm:text-sm transition-colors duration-150" placeholder="Contoh: Rak A-12">
            </div>
            
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Deskripsi</label>
                <textarea name="deskripsi" rows="3" class="block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 sm:text-sm transition-colors duration-150" placeholder="Tambahkan deskripsi singkat mengenai barang..."></textarea>
            </div>
        </div>
        
        <div class="mt-6 pt-5 border-t border-gray-100 flex items-center justify-end">
            <a href="{{ route('items.index') }}" class="bg-white hover:bg-gray-50 text-gray-700 font-semibold px-5 py-2.5 border border-gray-200 rounded-lg shadow-sm hover:shadow transition-all duration-150 text-sm">
                Batal
            </a>
            <button type="submit" class="bg-gradient-to-r from-teal-500 to-emerald-600 hover:from-teal-600 hover:to-emerald-700 text-white font-semibold px-6 py-2.5 rounded-lg shadow-sm hover:shadow transition-all duration-200 transform hover:-translate-y-0.5 text-sm ml-3 flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                Simpan Barang
            </button>
        </div>
    </form>
</div>
@endsection
