@extends('layouts.app')

@section('header', 'Riwayat Barang Masuk')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gradient-to-r from-teal-50 to-white">
        <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
            <span class="w-2.5 h-6 bg-teal-500 rounded-full inline-block"></span>
            Riwayat Barang Masuk
        </h2>
        @if(auth()->user()->role === 'staff')
        <a href="{{ route('stock-ins.create') }}" class="bg-gradient-to-r from-teal-500 to-emerald-600 hover:from-teal-600 hover:to-emerald-700 text-white font-semibold px-5 py-2.5 rounded-lg shadow-sm hover:shadow transition-all duration-200 transform hover:-translate-y-0.5 text-sm inline-flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Pengajuan
        </a>
        @endif
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-100">
            <thead class="bg-gray-50/80">
                <tr>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Barang</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Jumlah</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Harga Satuan</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Harga</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Supplier</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Diajukan Oleh</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    @if(auth()->user()->role === 'staff')
                    <th class="px-6 py-3.5 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($ins as $in)
                <tr class="hover:bg-teal-50/20 even:bg-gray-50/30 transition-colors duration-150">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">{{ $in->tanggal_masuk }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $in->item->nama_barang ?? '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-emerald-600 font-bold">+{{ $in->jumlah }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Rp {{ number_format($in->item->harga ?? 0, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-teal-700 font-bold">Rp {{ number_format(($in->item->harga ?? 0) * $in->jumlah, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">{{ $in->supplier ?? '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">{{ $in->user->name ?? '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        @if($in->status === 'pending_superadmin')
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-amber-50 text-amber-700 border border-amber-200">⏳ Menunggu Superadmin</span>
                        @elseif($in->status === 'pending_pimpinan')
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-sky-50 text-sky-700 border border-sky-200">⏳ Menunggu Pimpinan</span>
                        @elseif($in->status === 'approved')
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">✅ Disetujui</span>
                        @else
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-50 text-red-700 border border-red-200">❌ Ditolak</span>
                        @endif
                    </td>
                    @if(auth()->user()->role === 'staff')
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        @if(in_array($in->status, ['pending_superadmin', 'rejected']))
                        <form action="{{ route('stock-ins.destroy', $in->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus pengajuan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 font-semibold transition-colors duration-150 inline-flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                Hapus
                            </button>
                        </form>
                        @else
                            <span class="text-gray-400 text-xs font-semibold">-</span>
                        @endif
                    </td>
                    @endif
                </tr>
                @empty
                <tr><td colspan="{{ auth()->user()->role === 'staff' ? 9 : 8 }}" class="px-6 py-12 text-center text-gray-400">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                    <p class="font-medium text-gray-500">Belum ada data barang masuk.</p>
                </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4 border-t border-gray-100 bg-gray-50/50">
        {{ $ins->links() }}
    </div>
</div>

@endsection
