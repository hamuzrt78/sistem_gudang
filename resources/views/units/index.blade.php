@extends('layouts.app')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-semibold text-slate-900">Satuan</h1>
        <p class="text-sm text-slate-500">Kelola satuan unit barang.</p>
    </div>
    <a href="{{ route('units.create') }}" class="rounded-md bg-slate-900 px-4 py-2 text-sm font-medium text-white">Tambah Satuan</a>
</div>

<div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
    <table class="min-w-full divide-y divide-slate-200 text-sm">
        <thead class="bg-slate-50 text-left text-slate-600">
            <tr>
                <th class="px-6 py-4 font-medium">Nama</th>
                <th class="px-6 py-4 font-medium">Simbol</th>
                <th class="px-6 py-4 font-medium">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200 bg-white">
            @forelse($units as $unit)
                <tr>
                    <td class="px-6 py-4 text-slate-900">{{ $unit->nama_satuan }}</td>
                    <td class="px-6 py-4 text-slate-500">{{ $unit->simbol }}</td>
                    <td class="px-6 py-4 text-slate-600">
                        <div class="flex gap-2">
                            <a href="{{ route('units.edit', $unit) }}" class="rounded-md border border-slate-200 px-3 py-1 text-sm">Ubah</a>
                            <form action="{{ route('units.destroy', $unit) }}" method="POST" onsubmit="return confirm('Hapus satuan ini?');">
                                @csrf
                                @method('DELETE')
                                <button class="rounded-md border border-rose-200 bg-rose-50 px-3 py-1 text-sm text-rose-700">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-6 py-8 text-center text-slate-500">Belum ada satuan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
