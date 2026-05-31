@extends('layouts.app')

@section('content')
<div class="mb-6 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
    <div>
        <h1 class="text-2xl font-semibold text-slate-900">Ubah Kategori</h1>
        <p class="text-sm text-slate-500">Perbarui data kategori item.</p>
    </div>
    <a href="{{ route('categories.index') }}" class="rounded-md bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-200">Kembali</a>
</div>

<div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
    <form action="{{ route('categories.update', $category) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700">Nama Kategori</label>
            <input type="text" name="nama_kategori" value="{{ old('nama_kategori', $category->nama_kategori) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-slate-400" required>
            @error('nama_kategori')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700">Deskripsi</label>
            <textarea name="deskripsi" rows="4" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-slate-400">{{ old('deskripsi', $category->deskripsi) }}</textarea>
            @error('deskripsi')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
        </div>
        <div class="flex justify-end">
            <button type="submit" class="rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-700">Perbarui Kategori</button>
        </div>
    </form>
</div>
@endsection
