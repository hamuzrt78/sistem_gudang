<div id="sidebar" class="bg-teal-800 text-white w-64 space-y-2 py-7 px-2 absolute inset-y-0 left-0 transform -translate-x-full lg:relative lg:translate-x-0 transition duration-200 ease-in-out z-20 flex flex-col shadow-xl">
    <!-- Logo / Brand -->
    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 mb-8">
        <div class="bg-white/15 p-2 rounded-xl">
            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
        </div>
        <div>
            <span class="text-base font-bold text-white leading-tight block">Gudang PC Gaming</span>
            <span class="text-teal-200 text-xs font-medium">Sistem Inventaris</span>
        </div>
    </a>

    <nav class="flex-1 space-y-0.5 overflow-y-auto px-2">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 rounded-xl px-3 py-2.5 transition-all duration-150 group {{ request()->routeIs('dashboard') ? 'bg-white/20 text-white font-semibold shadow-sm border border-white/20' : 'text-teal-100 hover:bg-white/10 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-teal-300 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            <span class="text-sm">Dashboard</span>
        </a>

        @if(auth()->user()->role === 'superadmin')
        <!-- Data Master -->
        <div class="pt-5 pb-1.5 px-1">
            <p class="text-xs font-bold text-teal-300 uppercase tracking-widest">Data Master</p>
        </div>
        <a href="{{ route('items.index') }}" class="flex items-center space-x-3 rounded-xl px-3 py-2.5 transition-all duration-150 group {{ request()->routeIs('items.*') ? 'bg-white/20 text-white font-semibold shadow-sm border border-white/20' : 'text-teal-100 hover:bg-white/10 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('items.*') ? 'text-white' : 'text-teal-300 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
            <span class="text-sm">Manajemen Barang</span>
        </a>
        <a href="{{ route('categories.index') }}" class="flex items-center space-x-3 rounded-xl px-3 py-2.5 transition-all duration-150 group {{ request()->routeIs('categories.*') ? 'bg-white/20 text-white font-semibold shadow-sm border border-white/20' : 'text-teal-100 hover:bg-white/10 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('categories.*') ? 'text-white' : 'text-teal-300 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
            <span class="text-sm">Kategori</span>
        </a>
        <a href="{{ route('units.index') }}" class="flex items-center space-x-3 rounded-xl px-3 py-2.5 transition-all duration-150 group {{ request()->routeIs('units.*') ? 'bg-white/20 text-white font-semibold shadow-sm border border-white/20' : 'text-teal-100 hover:bg-white/10 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('units.*') ? 'text-white' : 'text-teal-300 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
            <span class="text-sm">Satuan</span>
        </a>
        @endif

        @if(auth()->user()->role === 'superadmin' || auth()->user()->role === 'staff')
        <!-- Transaksi -->
        <div class="pt-5 pb-1.5 px-1">
            <p class="text-xs font-bold text-teal-300 uppercase tracking-widest">Transaksi</p>
        </div>
        <a href="{{ route('stock-ins.index') }}" class="flex items-center space-x-3 rounded-xl px-3 py-2.5 transition-all duration-150 group {{ request()->routeIs('stock-ins.*') ? 'bg-white/20 text-white font-semibold shadow-sm border border-white/20' : 'text-teal-100 hover:bg-white/10 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('stock-ins.*') ? 'text-white' : 'text-teal-300 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
            <span class="text-sm">Barang Masuk</span>
        </a>
        <a href="{{ route('stock-outs.index') }}" class="flex items-center space-x-3 rounded-xl px-3 py-2.5 transition-all duration-150 group {{ request()->routeIs('stock-outs.*') ? 'bg-white/20 text-white font-semibold shadow-sm border border-white/20' : 'text-teal-100 hover:bg-white/10 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('stock-outs.*') ? 'text-white' : 'text-teal-300 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
            <span class="text-sm">Barang Keluar</span>
        </a>
        @endif

        <!-- Laporan -->
        <div class="pt-5 pb-1.5 px-1">
            <p class="text-xs font-bold text-teal-300 uppercase tracking-widest">Laporan</p>
        </div>
        <a href="{{ route('laporan.stok') }}" class="flex items-center space-x-3 rounded-xl px-3 py-2.5 transition-all duration-150 group {{ request()->routeIs('laporan.stok') ? 'bg-white/20 text-white font-semibold shadow-sm border border-white/20' : 'text-teal-100 hover:bg-white/10 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('laporan.stok') ? 'text-white' : 'text-teal-300 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            <span class="text-sm">Laporan Stok</span>
        </a>
        <a href="{{ route('laporan.masuk') }}" class="flex items-center space-x-3 rounded-xl px-3 py-2.5 transition-all duration-150 group {{ request()->routeIs('laporan.masuk') ? 'bg-white/20 text-white font-semibold shadow-sm border border-white/20' : 'text-teal-100 hover:bg-white/10 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('laporan.masuk') ? 'text-white' : 'text-teal-300 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
            <span class="text-sm">Laporan Masuk</span>
        </a>
        <a href="{{ route('laporan.keluar') }}" class="flex items-center space-x-3 rounded-xl px-3 py-2.5 transition-all duration-150 group {{ request()->routeIs('laporan.keluar') ? 'bg-white/20 text-white font-semibold shadow-sm border border-white/20' : 'text-teal-100 hover:bg-white/10 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('laporan.keluar') ? 'text-white' : 'text-teal-300 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3"></path></svg>
            <span class="text-sm">Laporan Keluar</span>
        </a>
        <a href="{{ route('mutations.index') }}" class="flex items-center space-x-3 rounded-xl px-3 py-2.5 transition-all duration-150 group {{ request()->routeIs('mutations.*') ? 'bg-white/20 text-white font-semibold shadow-sm border border-white/20' : 'text-teal-100 hover:bg-white/10 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('mutations.*') ? 'text-white' : 'text-teal-300 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="text-sm">Riwayat Mutasi</span>
        </a>

        @if(auth()->user()->role === 'superadmin')
        <!-- Persetujuan -->
        <div class="pt-5 pb-1.5 px-1">
            <p class="text-xs font-bold text-teal-300 uppercase tracking-widest">Persetujuan</p>
        </div>
        <a href="{{ route('approvals.superadmin.index') }}" class="flex items-center space-x-3 rounded-xl px-3 py-2.5 transition-all duration-150 group {{ request()->routeIs('approvals.superadmin.*') ? 'bg-white/20 text-white font-semibold shadow-sm border border-white/20' : 'text-teal-100 hover:bg-white/10 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('approvals.superadmin.*') ? 'text-white' : 'text-teal-300 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="flex-1 text-sm">Approval Transaksi</span>
            @php $pendingCount = \App\Models\StockIn::where('status','pending_superadmin')->count() + \App\Models\StockOut::where('status','pending_superadmin')->count(); @endphp
            @if($pendingCount > 0)
                <span class="bg-amber-400 text-gray-900 text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">{{ $pendingCount }}</span>
            @endif
        </a>
        <!-- Sistem -->
        <div class="pt-5 pb-1.5 px-1">
            <p class="text-xs font-bold text-teal-300 uppercase tracking-widest">Sistem</p>
        </div>
        <a href="{{ route('users.index') }}" class="flex items-center space-x-3 rounded-xl px-3 py-2.5 transition-all duration-150 group {{ request()->routeIs('users.*') ? 'bg-white/20 text-white font-semibold shadow-sm border border-white/20' : 'text-teal-100 hover:bg-white/10 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('users.*') ? 'text-white' : 'text-teal-300 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            <span class="text-sm">Manajemen User</span>
        </a>
        @endif

        @if(auth()->user()->role === 'pimpinan')
        <!-- Approval Level 2 (Pimpinan) -->
        <div class="pt-5 pb-1.5 px-1">
            <p class="text-xs font-bold text-teal-300 uppercase tracking-widest">Persetujuan Final</p>
        </div>
        <a href="{{ route('approvals.pimpinan.index') }}" class="flex items-center space-x-3 rounded-xl px-3 py-2.5 transition-all duration-150 group {{ request()->routeIs('approvals.pimpinan.*') ? 'bg-white/20 text-white font-semibold shadow-sm border border-white/20' : 'text-teal-100 hover:bg-white/10 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('approvals.pimpinan.*') ? 'text-white' : 'text-teal-300 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
            <span class="flex-1 text-sm">Approval Final</span>
            @php $pendingFinalCount = \App\Models\StockIn::where('status','pending_pimpinan')->count() + \App\Models\StockOut::where('status','pending_pimpinan')->count(); @endphp
            @if($pendingFinalCount > 0)
                <span class="bg-amber-400 text-gray-900 text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">{{ $pendingFinalCount }}</span>
            @endif
        </a>
        @endif

    </nav>

    <!-- Footer user info -->
    <div class="mt-auto px-4 pt-4 border-t border-teal-700">
        <div class="flex items-center space-x-3">
            <div class="bg-white/20 rounded-full w-8 h-8 flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-xs font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-teal-300 truncate">{{ ucfirst(Auth::user()->role) }}</p>
            </div>
        </div>
    </div>
</div>
