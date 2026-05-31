@extends('layouts.app')

@section('header', 'Riwayat Mutasi Stok')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-teal-50 to-white">
        <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
            <span class="w-2.5 h-6 bg-teal-500 rounded-full inline-block"></span>
            Semua Aktivitas Mutasi
        </h2>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-100">
            <thead class="bg-gray-50/80">
                <tr>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Waktu</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Referensi</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Barang</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tipe</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Jumlah</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Harga Satuan</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Harga</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Stok Akhir</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Oleh</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($mutations as $m)
                <tr class="hover:bg-teal-50/20 even:bg-gray-50/30 transition-colors duration-150">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">{{ $m->created_at->format('Y-m-d H:i:s') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">{{ $m->referensi ?? '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-medium">{{ $m->item->nama_barang ?? '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        @if($m->tipe_mutasi == 'Masuk')
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-100">IN</span>
                        @elseif($m->tipe_mutasi == 'Keluar')
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-rose-50 text-rose-700 border border-rose-100">OUT</span>
                        @else
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-50 text-gray-700 border border-gray-200">{{ strtoupper($m->tipe_mutasi) }}</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold {{ $m->tipe_mutasi == 'Masuk' ? 'text-emerald-600' : 'text-rose-600' }}">
                        {{ $m->tipe_mutasi == 'Masuk' ? '+' : '-' }}{{ $m->jumlah }} {{ $m->item->unit->kode_unit ?? '-' }} 
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Rp {{ number_format($m->item->harga ?? 0, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-teal-700 font-bold">Rp {{ number_format(($m->item->harga ?? 0) * $m->jumlah, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-950 font-bold">{{ $m->stok_sesudah }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">{{ $m->user->name ?? '-' }}</td>
                </tr>
                @empty
                <tr><td colspan="9" class="px-6 py-12 text-center text-gray-400">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="font-medium text-gray-500">Tidak ada data mutasi.</p>
                </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4 border-t border-gray-100 bg-gray-50/50">
        {{ $mutations->links() }}
    </div>
</div>
@endsection
