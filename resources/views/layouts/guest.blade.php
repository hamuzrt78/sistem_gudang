<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Login — {{ config('app.name', 'Gudang PC Gaming') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Inter', sans-serif; }

            /* Animated teal gradient background for right panel */
            .teal-panel {
                background: linear-gradient(135deg, #0d9488 0%, #0f766e 30%, #115e59 65%, #0e7490 100%);
                position: relative;
                overflow: hidden;
            }

            /* Floating geometric decorations */
            .teal-panel::before {
                content: '';
                position: absolute;
                top: -100px;
                right: -80px;
                width: 350px;
                height: 350px;
                border-radius: 50%;
                background: rgba(255,255,255,0.06);
            }
            .teal-panel::after {
                content: '';
                position: absolute;
                bottom: -80px;
                left: -60px;
                width: 280px;
                height: 280px;
                border-radius: 50%;
                background: rgba(255,255,255,0.05);
            }

            .float-circle-1 {
                position: absolute;
                top: 40%;
                right: -40px;
                width: 160px;
                height: 160px;
                border-radius: 50%;
                background: rgba(255,255,255,0.04);
            }
            .float-circle-2 {
                position: absolute;
                top: 15%;
                left: 10%;
                width: 80px;
                height: 80px;
                border-radius: 50%;
                background: rgba(255,255,255,0.07);
            }

            /* Stats card floating animation */
            @keyframes float-up {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-8px); }
            }
            .stat-card { animation: float-up 4s ease-in-out infinite; }
            .stat-card:nth-child(2) { animation-delay: 0.8s; }
            .stat-card:nth-child(3) { animation-delay: 1.6s; }

            /* Input focus ring */
            .input-teal:focus {
                outline: none;
                border-color: #0d9488;
                box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.15);
            }

            /* Submit button shimmer */
            .btn-teal {
                background: linear-gradient(135deg, #0d9488, #0891b2);
                transition: all 0.25s ease;
            }
            .btn-teal:hover {
                background: linear-gradient(135deg, #0f766e, #0e7490);
                box-shadow: 0 8px 25px rgba(13, 148, 136, 0.35);
                transform: translateY(-1px);
            }
        </style>
    </head>
    <body class="antialiased bg-gray-50 min-h-screen">

        <div class="min-h-screen flex">

            <!-- ===== LEFT PANEL — Login Form ===== -->
            <div class="flex flex-col justify-between w-full lg:w-[45%] bg-white px-8 sm:px-14 py-10">

                <!-- Top Brand -->
                <div class="flex items-center space-x-2.5">
                    <div class="bg-teal-600 p-2 rounded-xl">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <span class="text-gray-900 font-bold text-lg">Gudang PC Gaming</span>
                </div>

                <!-- Form Area -->
                <div class="flex-1 flex flex-col justify-center max-w-sm mx-auto w-full py-12">

                    <div class="mb-8">
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">Selamat Datang!</h1>
                        <p class="text-gray-500 text-sm">Masukkan email dan password Anda untuk mengakses sistem inventaris.</p>
                    </div>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="mb-4 p-3 bg-teal-50 border border-teal-200 text-teal-700 text-sm rounded-lg">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="space-y-5">
                        @csrf

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Email</label>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="username@gudang.com"
                                class="input-teal w-full px-4 py-3 border border-gray-200 rounded-xl text-sm text-gray-900 bg-gray-50 placeholder-gray-400 transition-colors"
                            >
                            @error('email')
                                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Password</label>
                            <div class="relative">
                                <input
                                    id="password"
                                    type="password"
                                    name="password"
                                    required
                                    autocomplete="current-password"
                                    placeholder="••••••••"
                                    class="input-teal w-full px-4 py-3 border border-gray-200 rounded-xl text-sm text-gray-900 bg-gray-50 placeholder-gray-400 pr-12 transition-colors"
                                >
                                <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 flex items-center px-4 text-gray-400 hover:text-gray-600">
                                    <svg id="eye-icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Remember & Forgot -->
                        <div class="flex items-center justify-between">
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input
                                    id="remember_me"
                                    type="checkbox"
                                    name="remember"
                                    class="w-4 h-4 rounded border-gray-300 text-teal-600 focus:ring-teal-500"
                                >
                                <span class="text-sm text-gray-600">Ingat saya</span>
                            </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm font-semibold text-teal-600 hover:text-teal-700 transition-colors">
                                </a>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn-teal w-full py-3.5 px-6 text-white font-semibold text-sm rounded-xl shadow-md flex items-center justify-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            <span>Masuk ke Sistem</span>
                        </button>
                    </form>
                </div>

                <!-- Footer -->
                <div class="text-center text-xs text-gray-400">
                    &copy; {{ date('Y') }} Gudang PC Gaming &mdash; Sistem Inventaris Komponen Gaming
                </div>
            </div>

            <!-- ===== RIGHT PANEL — Info & Illustration ===== -->
            <div class="hidden lg:flex lg:w-[55%] teal-panel flex-col justify-between p-14 relative">

                <!-- Decorative circles -->
                <div class="float-circle-1"></div>
                <div class="float-circle-2"></div>

                <!-- Top content -->
                <div class="relative z-10">
                    <div class="inline-flex items-center bg-white/15 backdrop-blur-sm border border-white/20 text-white text-xs font-semibold px-3.5 py-1.5 rounded-full mb-8">
                        <span class="w-2 h-2 bg-emerald-300 rounded-full mr-2 animate-pulse"></span>
                        Sistem Aktif & Terintegrasi
                    </div>

                    <h2 class="text-4xl font-extrabold text-white leading-tight mb-4">
                        Sistem Kelola Stok Komponen<br>Gaming.
                    </h2>
                    <p class="text-teal-100 text-base leading-relaxed max-w-md">
                        Sistem inventaris terpadu untuk memantau dan mengelola stok GPU, CPU, RAM, SSD, dan komponen gaming lainnya.
                    </p>
                </div>

                <!-- Stats Cards -->
                <div class="relative z-10 grid grid-cols-3 gap-4 my-10">
                    <!-- Card 1 -->
                    <div class="stat-card bg-white/15 backdrop-blur-sm border border-white/20 rounded-2xl p-5 text-white">
                        <div class="bg-white/20 w-10 h-10 rounded-xl flex items-center justify-center mb-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                        </div>
                        <p class="text-2xl font-bold">Stok</p>
                        <p class="text-teal-200 text-xs font-medium mt-1">Real-time</p>
                    </div>

                    <!-- Card 2 -->
                    <div class="stat-card bg-white/15 backdrop-blur-sm border border-white/20 rounded-2xl p-5 text-white">
                        <div class="bg-white/20 w-10 h-10 rounded-xl flex items-center justify-center mb-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <p class="text-2xl font-bold">Approval</p>
                        <p class="text-teal-200 text-xs font-medium mt-1">2 Level</p>
                    </div>

                    <!-- Card 3 -->
                    <div class="stat-card bg-white/15 backdrop-blur-sm border border-white/20 rounded-2xl p-5 text-white">
                        <div class="bg-white/20 w-10 h-10 rounded-xl flex items-center justify-center mb-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <p class="text-2xl font-bold">Laporan</p>
                        <p class="text-teal-200 text-xs font-medium mt-1">Excel & PDF</p>
                    </div>
                </div>

                <!-- Feature list / bottom section -->
                <div class="relative z-10">
                    <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-6">
                        <h3 class="text-white font-bold text-sm mb-4 uppercase tracking-wider">Sistem Gudang Gaming</h3>
                        <div class="grid grid-cols-2 gap-3">
                            <div class="flex items-center space-x-2.5">
                                <div class="bg-emerald-400/20 p-1.5 rounded-lg">
                                    <svg class="w-3.5 h-3.5 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                <span class="text-teal-100 text-xs font-medium">Manajemen Stok GPU / CPU</span>
                            </div>
                            <div class="flex items-center space-x-2.5">
                                <div class="bg-emerald-400/20 p-1.5 rounded-lg">
                                    <svg class="w-3.5 h-3.5 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                <span class="text-teal-100 text-xs font-medium">Mutasi Stok Otomatis</span>
                            </div>
                            <div class="flex items-center space-x-2.5">
                                <div class="bg-emerald-400/20 p-1.5 rounded-lg">
                                    <svg class="w-3.5 h-3.5 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                <span class="text-teal-100 text-xs font-medium">Notifikasi Stok Kritis</span>
                            </div>
                            <div class="flex items-center space-x-2.5">
                                <div class="bg-emerald-400/20 p-1.5 rounded-lg">
                                    <svg class="w-3.5 h-3.5 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                <span class="text-teal-100 text-xs font-medium">Ekspor Laporan PDF</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <script>
            function togglePassword() {
                const pwd = document.getElementById('password');
                pwd.type = pwd.type === 'password' ? 'text' : 'password';
            }
        </script>
    </body>
</html>
