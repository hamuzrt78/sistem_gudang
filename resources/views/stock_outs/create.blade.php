@extends('layouts.app')

@section('header', 'Pengajuan Barang Keluar')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 max-w-2xl overflow-hidden">
    <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-teal-50 to-white">
        <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
            <span class="w-2.5 h-6 bg-teal-500 rounded-full inline-block"></span>
            Form Pengajuan Barang Keluar
        </h2>
    </div>

    <form action="{{ route('stock-outs.store') }}" method="POST" class="p-6" id="stockOutForm" onsubmit="confirmSubmit(event)">
        @csrf

        <div class="space-y-5">
            <div class="mb-4">
                <div class="flex items-center justify-between mb-2">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider">Daftar Barang <span class="text-red-500">*</span></label>
                    <button type="button" onclick="addItemRow()" class="text-xs bg-teal-50 text-teal-700 hover:bg-teal-100 px-3 py-1.5 rounded-lg font-semibold flex items-center gap-1 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Barang
                    </button>
                </div>
                
                <div id="items-container" class="space-y-3">
                    <div class="item-row flex items-start gap-3 p-3 bg-gray-50/50 border border-gray-100 rounded-xl relative">
                        <div class="flex-1">
                            <label class="block text-xs text-gray-500 mb-1">Pilih Barang</label>
                            <select name="items[0][item_id]" required class="block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 sm:text-sm transition-colors duration-150">
                                <option value="">-- Pilih Barang --</option>
                                @foreach($items as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_barang }} (Stok tersedia: {{ $item->stok }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-32">
                            <label class="block text-xs text-gray-500 mb-1">Jumlah</label>
                            <input type="number" name="items[0][jumlah]" min="1" required placeholder="Qty" class="block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 sm:text-sm transition-colors duration-150">
                        </div>
                        <div class="pt-6">
                            <button type="button" onclick="removeItemRow(this)" class="text-red-500 hover:text-red-700 p-1.5 rounded-md hover:bg-red-50 transition-colors" title="Hapus baris">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Tanggal Keluar <span class="text-red-500">*</span></label>
                    <input type="date" name="tanggal_keluar" required value="{{ old('tanggal_keluar', date('Y-m-d')) }}" class="block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 sm:text-sm transition-colors duration-150">
                    @error('tanggal_keluar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
            
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Tujuan Pengiriman</label>
                <input type="text" name="tujuan" placeholder="Nama penerima / tujuan divisi (opsional)" value="{{ old('tujuan') }}" class="block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 sm:text-sm transition-colors duration-150">
            </div>
            
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Keterangan Tambahan</label>
                <textarea name="keterangan" rows="3" placeholder="Tuliskan keterangan mengenai pengeluaran barang ini..." class="block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 sm:text-sm transition-colors duration-150">{{ old('keterangan') }}</textarea>
            </div>
        </div>
        
        <div class="mt-6 pt-5 border-t border-gray-100 flex items-center justify-end">
            <a href="{{ route('stock-outs.index') }}" class="bg-white hover:bg-gray-50 text-gray-700 font-semibold px-5 py-2.5 border border-gray-200 rounded-lg shadow-sm hover:shadow transition-all duration-150 text-sm">
                Batal
            </a>
            <button type="submit" class="bg-gradient-to-r from-teal-500 to-emerald-600 hover:from-teal-600 hover:to-emerald-700 text-white font-semibold px-6 py-2.5 rounded-lg shadow-sm hover:shadow transition-all duration-200 transform hover:-translate-y-0.5 text-sm ml-3 flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7M5 12h14"></path></svg>
                Kirim Pengajuan
            </button>
        </div>
    </form>
</div>
</div>

@push('scripts')
<script>
    let itemIndex = 1;
    const itemOptions = `@foreach($items as $item)<option value="{{ $item->id }}">{{ str_replace("'", "\'", $item->nama_barang) }} (Stok tersedia: {{ $item->stok }})</option>@endforeach`;

    function addItemRow() {
        const container = document.getElementById('items-container');
        const row = document.createElement('div');
        row.className = 'item-row flex items-start gap-3 p-3 bg-gray-50/50 border border-gray-100 rounded-xl relative';
        row.innerHTML = `
            <div class="flex-1">
                <label class="block text-xs text-gray-500 mb-1">Pilih Barang</label>
                <select name="items[${itemIndex}][item_id]" required class="block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 sm:text-sm transition-colors duration-150">
                    <option value="">-- Pilih Barang --</option>
                    ${itemOptions}
                </select>
            </div>
            <div class="w-32">
                <label class="block text-xs text-gray-500 mb-1">Jumlah</label>
                <input type="number" name="items[${itemIndex}][jumlah]" min="1" required placeholder="Qty" class="block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 sm:text-sm transition-colors duration-150">
            </div>
            <div class="pt-6">
                <button type="button" onclick="removeItemRow(this)" class="text-red-500 hover:text-red-700 p-1.5 rounded-md hover:bg-red-50 transition-colors" title="Hapus baris">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
            </div>
        `;
        container.appendChild(row);
        itemIndex++;
    }

    function removeItemRow(button) {
        const row = button.closest('.item-row');
        const container = document.getElementById('items-container');
        if (container.querySelectorAll('.item-row').length > 1) {
            row.remove();
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Tidak bisa dihapus',
                text: 'Minimal harus ada 1 barang dalam pengajuan.'
            });
        }
    }
    
    function confirmSubmit(event) {
        event.preventDefault();
        const form = event.target;
        
        Swal.fire({
            title: 'Kirim Pengajuan?',
            text: 'Pastikan data barang dan jumlah sudah benar.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#0d9488',
            cancelButtonColor: '#e11d48',
            confirmButtonText: 'Ya, Kirim',
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
