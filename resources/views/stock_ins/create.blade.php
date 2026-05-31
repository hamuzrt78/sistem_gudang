@extends('layouts.app')

@section('header', 'Pengajuan Barang Masuk')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 max-w-2xl overflow-hidden">
    <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-teal-50 to-white">
        <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
            <span class="w-2.5 h-6 bg-teal-500 rounded-full inline-block"></span>
            Form Pengajuan Barang Masuk
        </h2>
    </div>

    <form action="{{ route('stock-ins.store') }}" method="POST" class="p-6">
        @csrf
        
        <div class="mb-6 p-4 bg-amber-50/80 border border-amber-200 rounded-xl text-sm text-amber-800 flex items-start gap-2.5 shadow-sm">
            <svg class="w-5 h-5 text-amber-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            <div>
                <strong class="font-bold">Perhatian:</strong> Pengajuan penambahan stok ini memerlukan persetujuan berjenjang dari <strong>Superadmin</strong> (Persetujuan Level 1) dan <strong>Pimpinan</strong> (Persetujuan Final) sebelum stok barang diperbarui secara riil.
            </div>
        </div>

        <div class="space-y-5">
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Pilih Barang <span class="text-red-500">*</span></label>
                <select name="item_id" required class="block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 sm:text-sm transition-colors duration-150">
                    <option value="">-- Pilih Barang --</option>
                    @foreach($items as $item)
                    <option value="{{ $item->id }}" {{ old('item_id') == $item->id ? 'selected' : '' }}>{{ $item->nama_barang }} (Stok saat ini: {{ $item->stok }})</option>
                    @endforeach
                </select>
                @error('item_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Jumlah Masuk <span class="text-red-500">*</span></label>
                    <input type="number" name="jumlah" min="1" required placeholder="Contoh: 10" value="{{ old('jumlah') }}" class="block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 sm:text-sm transition-colors duration-150">
                    @error('jumlah') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Tanggal Masuk <span class="text-red-500">*</span></label>
                    <input type="date" name="tanggal_masuk" required value="{{ old('tanggal_masuk', date('Y-m-d')) }}" class="block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 sm:text-sm transition-colors duration-150">
                    @error('tanggal_masuk') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
            
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Supplier / Pemasok</label>
                <input type="text" name="supplier" placeholder="Nama supplier (opsional)" value="{{ old('supplier') }}" class="block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 sm:text-sm transition-colors duration-150">
            </div>
            
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Keterangan Tambahan</label>
                <textarea name="keterangan" rows="3" placeholder="Tuliskan keterangan mengenai pengadaan barang masuk ini..." class="block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 sm:text-sm transition-colors duration-150">{{ old('keterangan') }}</textarea>
            </div>
        </div>
        
        <div class="mt-6 pt-5 border-t border-gray-100 flex items-center justify-end">
            <a href="{{ route('stock-ins.index') }}" class="bg-white hover:bg-gray-50 text-gray-700 font-semibold px-5 py-2.5 border border-gray-200 rounded-lg shadow-sm hover:shadow transition-all duration-150 text-sm">
                Batal
            </a>
            <button type="submit" class="bg-gradient-to-r from-teal-500 to-emerald-600 hover:from-teal-600 hover:to-emerald-700 text-white font-semibold px-6 py-2.5 rounded-lg shadow-sm hover:shadow transition-all duration-200 transform hover:-translate-y-0.5 text-sm ml-3 flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7M5 12h14"></path></svg>
                Kirim Pengajuan
            </button>
        </div>
    </form>
</div>
@endsection
