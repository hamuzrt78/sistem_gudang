@extends('layouts.app')

@section('header', 'Ubah Barang')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 max-w-2xl overflow-hidden">
    <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-teal-50 to-white flex justify-between items-center">
        <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
            <span class="w-2.5 h-6 bg-teal-500 rounded-full inline-block"></span>
            Ubah Informasi Barang
        </h2>
        <a href="{{ route('items.index') }}" class="bg-white hover:bg-gray-50 text-gray-700 font-semibold px-4 py-2 border border-gray-200 rounded-lg shadow-sm hover:shadow transition-all duration-150 text-xs">
            Kembali
        </a>
    </div>

    <form action="{{ route('items.update', $item) }}" method="POST" class="p-6">
        @csrf
        @method('PUT')
        <div class="space-y-5">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Kode Barang</label>
                    <input type="text" name="kode_barang" value="{{ old('kode_barang', $item->kode_barang) }}" class="block w-full rounded-lg border-gray-200 bg-gray-50 shadow-sm focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 sm:text-sm transition-colors duration-150" required>
                    @error('kode_barang')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Nama Barang</label>
                    <input type="text" name="nama_barang" value="{{ old('nama_barang', $item->nama_barang) }}" class="block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 sm:text-sm transition-colors duration-150" required>
                    @error('nama_barang')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Harga (Rp)</label>
                    <input type="number" name="harga" value="{{ old('harga', $item->harga) }}" min="0" class="block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 sm:text-sm transition-colors duration-150" required>
                    @error('harga')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Kategori</label>
                    <select name="category_id" class="block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 sm:text-sm transition-colors duration-150" required>
                        <option value="">Pilih kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>{{ $category->nama_kategori }}</option>
                        @endforeach
                    </select>
                    @error('category_id')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Satuan</label>
                    <select name="unit_id" class="block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 sm:text-sm transition-colors duration-150" required>
                        <option value="">Pilih satuan</option>
                        @foreach($units as $unit)
                            <option value="{{ $unit->id }}" {{ old('unit_id', $item->unit_id) == $unit->id ? 'selected' : '' }}>{{ $unit->nama_satuan }} ({{ $unit->simbol }})</option>
                        @endforeach
                    </select>
                    @error('unit_id')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Stok</label>
                    <input type="number" name="stok" value="{{ old('stok', $item->stok) }}" min="0" class="block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 sm:text-sm transition-colors duration-150" required>
                    @error('stok')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Stok Minimum</label>
                    <input type="number" name="stok_minimum" value="{{ old('stok_minimum', $item->stok_minimum) }}" min="0" class="block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 sm:text-sm transition-colors duration-150">
                    @error('stok_minimum')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Lokasi Rak</label>
                    <input type="text" name="lokasi_rak" value="{{ old('lokasi_rak', $item->lokasi_rak) }}" class="block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 sm:text-sm transition-colors duration-150">
                    @error('lokasi_rak')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Deskripsi</label>
                <textarea name="deskripsi" rows="3" class="block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 sm:text-sm transition-colors duration-150">{{ old('deskripsi', $item->deskripsi) }}</textarea>
                @error('deskripsi')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="mt-6 pt-5 border-t border-gray-100 flex items-center justify-end">
            <a href="{{ route('items.index') }}" class="bg-white hover:bg-gray-50 text-gray-700 font-semibold px-5 py-2.5 border border-gray-200 rounded-lg shadow-sm hover:shadow transition-all duration-150 text-sm">
                Batal
            </a>
            <button type="submit" class="bg-gradient-to-r from-teal-500 to-emerald-600 hover:from-teal-600 hover:to-emerald-700 text-white font-semibold px-6 py-2.5 rounded-lg shadow-sm hover:shadow transition-all duration-200 transform hover:-translate-y-0.5 text-sm ml-3 flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                Perbarui Barang
            </button>
        </div>
    </form>
</div>
@endsection
