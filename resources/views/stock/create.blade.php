@extends('layouts.app')

@section('content')
<div class="mb-6 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
    <div>
        <h1 class="text-2xl font-semibold text-slate-900">Tambah Pergerakan Stok</h1>
        <p class="text-sm text-slate-500">Catat barang masuk atau keluar.</p>
    </div>
    <a href="{{ route('stock.movements.index') }}" class="rounded-md bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-200">Kembali</a>
</div>

<div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
    <form action="{{ route('stock.movements.store') }}" method="POST" class="space-y-6">
        @csrf
        <div class="grid gap-6 lg:grid-cols-2">
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Barang</label>
                <select name="item_id" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-slate-400" required>
                    <option value="">Pilih barang</option>
                    @foreach($items as $item)
                        <option value="{{ $item->id }}" {{ old('item_id') == $item->id ? 'selected' : '' }}>{{ $item->nama_barang }} ({{ $item->kode_barang }})</option>
                    @endforeach
                </select>
                @error('item_id')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Tipe</label>
                <select name="type" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-slate-400" required>
                    <option value="">Pilih tipe</option>
                    <option value="in" {{ old('type') === 'in' ? 'selected' : '' }}>Masuk</option>
                    <option value="out" {{ old('type') === 'out' ? 'selected' : '' }}>Keluar</option>
                </select>
                @error('type')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Jumlah</label>
                <input type="number" name="quantity" value="{{ old('quantity', 1) }}" min="1" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-slate-400" required>
                @error('quantity')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Supplier / Tujuan</label>
                <input type="text" name="supplier" value="{{ old('supplier') }}" placeholder="Supplier jika masuk atau tujuan jika keluar" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-slate-400">
                @error('supplier')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="mb-2 block text-sm font-medium text-slate-700">Keterangan</label>
                <input type="text" name="keterangan" value="{{ old('keterangan') }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-slate-400">
                @error('keterangan')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
            </div>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-700">Simpan Pergerakan</button>
        </div>
    </form>
</div>
@endsection
