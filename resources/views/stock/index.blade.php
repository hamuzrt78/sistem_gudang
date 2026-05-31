@extends('layouts.app')

@section('content')
<div class="mb-6 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
    <div>
        <h1 class="text-2xl font-semibold text-slate-900">Pergerakan Stok</h1>
        <p class="text-sm text-slate-500">Riwayat barang masuk dan keluar.</p>
    </div>
    <a href="{{ route('stock.movements.create') }}" class="rounded-md bg-slate-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-slate-700">Tambah Pergerakan</a>
</div>

<div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
    <table class="min-w-full divide-y divide-slate-200 text-sm">
        <thead class="bg-slate-50 text-left text-slate-600">
            <tr>
                <th class="px-6 py-4 font-medium">Tanggal</th>
                <th class="px-6 py-4 font-medium">Barang</th>
                <th class="px-6 py-4 font-medium">Tipe</th>
                <th class="px-6 py-4 font-medium">Jumlah</th>
                <th class="px-6 py-4 font-medium">Catatan</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200 bg-white">
            @forelse($movements as $movement)
                <tr>
                    <td class="px-6 py-4 text-slate-500">{{ $movement->created_at->format('d M Y H:i') }}</td>
                    <td class="px-6 py-4 text-slate-900">{{ $movement->item->nama_barang ?? 'Barang terhapus' }}</td>
                    <td class="px-6 py-4 text-slate-900">{{ $movement->tipe_mutasi === 'in' ? 'Masuk' : 'Keluar' }}</td>
                    <td class="px-6 py-4 text-slate-900">{{ $movement->jumlah }}</td>
                    <td class="px-6 py-4 text-slate-500">{{ $movement->referensi ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-slate-500">Belum ada pergerakan stok.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
