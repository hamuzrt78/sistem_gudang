@extends('layouts.app')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-semibold text-slate-900">Ubah Satuan</h1>
        <p class="text-sm text-slate-500">Perbarui satuan.</p>
    </div>
    <a href="{{ route('units.index') }}" class="rounded-md bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700">Kembali</a>
</div>

<div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
    <form action="{{ route('units.update', $unit) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700">Nama Satuan</label>
            <input type="text" name="nama_satuan" value="{{ old('nama_satuan', $unit->nama_satuan) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none" required>
            @error('nama_satuan')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700">Simbol</label>
            <input type="text" name="simbol" value="{{ old('simbol', $unit->simbol) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none" required>
            @error('simbol')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
        </div>
        <div class="flex justify-end">
            <button type="submit" class="rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white">Perbarui</button>
        </div>
    </form>
</div>
@endsection
