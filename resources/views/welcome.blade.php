<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Perpustakaan Digital') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100 text-gray-900 min-h-screen flex flex-col justify-between">
        <!-- Header / Navbar Pojok Kanan Atas -->
        <header class="w-full max-w-7xl mx-auto px-6 py-6 flex justify-between items-center">
            <div class="flex items-center gap-2 font-bold text-gray-700 text-lg">
                <x-application-logo class="w-8 h-8 fill-current text-gray-800" />
                <span>Perpus Digital</span>
            </div>

            @if (Route::has('login'))
                <nav class="flex items-center gap-4">
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <a
                                href="{{ route('admin.dashboard') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none font-medium text-sm"
                            >
                                Dashboard Admin
                            </a>
                        @else
                            <a
                                href="{{ route('dashboard') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none font-medium text-sm"
                            >
                                Dashboard
                            </a>
                        @endif
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none font-medium text-sm"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none font-medium text-sm"
                            >
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <!-- Konten Tengah Halaman Awal -->
        <main class="flex-1 flex flex-col justify-center items-center px-6 text-center">
            <div class="mb-4">
                <x-application-logo class="w-20 h-20 fill-current text-gray-700" />
            </div>

            <h1 class="text-3xl font-bold text-gray-800 mb-2">Selamat Datang di Perpustakaan Digital</h1>
            <p class="text-gray-600 mb-8 max-w-md">Silakan masuk ke akun Anda atau daftar sebagai siswa baru untuk mulai meminjam buku.</p>

            @if (Route::has('login'))
                <div class="flex items-center justify-center gap-4">
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="px-6 py-2.5 bg-gray-800 text-white rounded-md hover:bg-gray-700 text-sm font-semibold shadow">
                                Buka Dashboard Admin &rarr;
                            </a>
                        @else
                            <a href="{{ route('dashboard') }}" class="px-6 py-2.5 bg-gray-800 text-white rounded-md hover:bg-gray-700 text-sm font-semibold shadow">
                                Buka Dashboard Siswa &rarr;
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-2.5 bg-gray-800 text-white rounded-md hover:bg-gray-700 text-sm font-semibold shadow">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-6 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 text-sm font-semibold shadow-sm">
                                Register
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </main>

        <!-- Footer -->
        <footer class="py-6 text-center text-xs text-gray-500">
            &copy; {{ date('Y') }} Perpustakaan Digital. All rights reserved.
        </footer>
    </body>
</html>
