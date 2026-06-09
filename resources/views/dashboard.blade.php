@extends('layouts.app')

@section('header', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <x-card-stat title="Total Barang" :value="$totalBarang" color="blue" icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>' />
    <x-card-stat title="Total Kategori" :value="$totalKategori" color="purple" icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>' />
    <x-card-stat title="Stok Masuk" :value="$totalStokMasuk" color="green" icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>' />
    <x-card-stat title="Stok Keluar" :value="$totalStokKeluar" color="red" icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>' />
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Chart -->
    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Aktivitas Stok (7 Hari Terakhir)</h3>
        <div id="stockChart" class="h-72 w-full"></div>
    </div>

    @if(auth()->user()->role === 'pimpinan')
    <!-- Menunggu Approval -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 overflow-hidden">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Menunggu Approval</h3>
            <span class="bg-amber-100 text-amber-600 text-xs font-bold px-2 py-1 rounded-full">{{ $pendingInsPimpinan->count() + $pendingOutsPimpinan->count() }} Item</span>
        </div>
        <div class="space-y-4 max-h-72 overflow-y-auto pr-2">
            @forelse($pendingInsPimpinan as $in)
                <div class="p-3 bg-amber-50 rounded-lg border border-amber-100 flex justify-between items-center">
                    <div>
                        <p class="font-medium text-gray-800 text-sm">Barang Masuk: {{ $in->item->nama_barang }}</p>
                        <p class="text-xs text-gray-500">Jumlah: +{{ $in->jumlah }} (Oleh: {{ $in->user->name ?? '-' }})</p>
                    </div>
                    <a href="{{ route('approvals.pimpinan') }}" class="text-xs bg-amber-600 hover:bg-amber-700 text-white px-2.5 py-1.5 rounded-lg shadow-sm transition-colors font-medium">Lihat</a>
                </div>
            @empty
            @endforelse
            @forelse($pendingOutsPimpinan as $out)
                <div class="p-3 bg-amber-50 rounded-lg border border-amber-100 flex justify-between items-center">
                    <div>
                        <p class="font-medium text-gray-800 text-sm">Barang Keluar: {{ $out->item->nama_barang }}</p>
                        <p class="text-xs text-gray-500">Jumlah: -{{ $out->jumlah }} (Oleh: {{ $out->user->name ?? '-' }})</p>
                    </div>
                    <a href="{{ route('approvals.pimpinan') }}" class="text-xs bg-amber-600 hover:bg-amber-700 text-white px-2.5 py-1.5 rounded-lg shadow-sm transition-colors font-medium">Lihat</a>
                </div>
            @empty
            @endforelse
            @if($pendingInsPimpinan->isEmpty() && $pendingOutsPimpinan->isEmpty())
                <div class="text-center py-8 text-gray-500">
                    <svg class="w-12 h-12 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p>Tidak ada transaksi yang menunggu persetujuan.</p>
                </div>
            @endif
        </div>
    </div>
    @else
    <!-- Peringatan Stok -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 overflow-hidden">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Peringatan Stok</h3>
            <span class="bg-red-100 text-red-600 text-xs font-bold px-2 py-1 rounded-full">{{ $barangHampirHabis->count() }} Item</span>
        </div>
        <div class="space-y-4 max-h-72 overflow-y-auto pr-2">
            @forelse($barangHampirHabis as $item)
                <div class="p-3 bg-red-50 rounded-lg border border-red-100">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-medium text-gray-800 text-sm">{{ $item->nama_barang }}</p>
                            <p class="text-xs text-gray-500">{{ $item->kode_barang }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-bold text-red-600">{{ $item->stok }}</p>
                            <p class="text-xs text-red-400">Min: {{ $item->stok_minimum }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-8 text-gray-500">
                    <svg class="w-12 h-12 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p>Semua stok barang aman.</p>
                </div>
            @endforelse
        </div>
    </div>
    @endif
</div>

<!-- Aktivitas Terbaru -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Mutasi Terakhir</h3>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Barang</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Oleh</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($aktivitasTerbaru as $mutasi)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $mutasi->created_at->format('d/m/Y H:i') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $mutasi->item->nama_barang }}</div>
                        <div class="text-xs text-gray-500">{{ $mutasi->item->kode_barang }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($mutasi->tipe_mutasi == 'in')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Masuk</span>
                        @elseif($mutasi->tipe_mutasi == 'out')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Keluar</span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Batal</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium {{ $mutasi->tipe_mutasi == 'in' ? 'text-green-600' : 'text-red-600' }}">
                        {{ $mutasi->tipe_mutasi == 'in' ? '+' : '-' }}{{ $mutasi->jumlah }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $mutasi->user->name ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada aktivitas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
<script>
    var options = {
        series: [{
            name: 'Barang Masuk',
            data: @json($inData)
        }, {
            name: 'Barang Keluar',
            data: @json($outData)
        }],
        chart: {
            type: 'bar',
            height: 280,
            toolbar: { show: false }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
        },
        dataLabels: { enabled: false },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: @json($dates),
        },
        yaxis: { title: { text: 'Jumlah Barang' } },
        fill: { opacity: 1 },
        colors: ['#10B981', '#EF4444'],
        tooltip: {
            y: { formatter: function (val) { return val + " item" } }
        }
    };

    var chart = new ApexCharts(document.querySelector("#stockChart"), options);
    chart.render();
</script>
@endpush
@endsection
