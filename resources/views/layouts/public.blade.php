<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Karang Taruna') }} - @yield('title', 'Beranda')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body class="font-sans antialiased bg-white">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ url('/') }}" class="flex items-center">
                                <img src="{{ asset('images/homepage/logo-pregas.jpeg') }}" alt="Karang Taruna PREGAS" class="h-12 w-auto">
                            </a>
                        </div>
                        <div class="hidden sm:ml-8 sm:flex sm:space-x-8">
                            <a href="{{ url('/') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->is('/') ? 'border-primary text-black' : 'border-transparent text-black hover:text-primary hover:border-primary' }} text-sm font-medium">
                                Beranda
                            </a>
                            <a href="{{ url('/about') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->is('about*') ? 'border-primary text-black' : 'border-transparent text-black hover:text-primary hover:border-primary' }} text-sm font-medium">
                                Tentang
                            </a>
                            <a href="{{ url('/activities') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->is('activities*') ? 'border-primary text-black' : 'border-transparent text-black hover:text-primary hover:border-primary' }} text-sm font-medium">
                                Kegiatan
                            </a>
                            <a href="{{ url('/news') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->is('news*') ? 'border-primary text-black' : 'border-transparent text-black hover:text-primary hover:border-primary' }} text-sm font-medium">
                                Berita
                            </a>
                            <a href="{{ url('/documentation') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->is('documentation*') ? 'border-primary text-black' : 'border-transparent text-black hover:text-primary hover:border-primary' }} text-sm font-medium">
                                Dokumentasi
                            </a>
                        </div>
                    </div>
                    <div class="flex items-center">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm text-black hover:text-primary mr-4">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-black hover:text-primary mr-4">Login</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-black text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <div class="mb-4">
                            <img src="{{ asset('images/homepage/logo-pregas.jpeg') }}" alt="Karang Taruna PREGAS" class="h-16 w-auto mb-3">
                        </div>
                        <p class="text-white text-sm">
                            Berdiri sejak 26 Agustus 1987, Karang Taruna PREGAS (Persatuan Remaja Gandul Selatan) adalah wadah kreativitas pemuda yang bergerak dalam kegiatan sosial dan pelestarian lingkungan untuk memberikan dampak positif bagi Wilayah Kelurahan Gandul.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Link Cepat</h3>
                        <ul class="space-y-2 text-sm">
                            <li><a href="{{ url('/') }}" class="text-white hover:text-primary">Beranda</a></li>
                            <li><a href="{{ url('/about') }}" class="text-white hover:text-primary">Tentang</a></li>
                            <li><a href="{{ url('/activities') }}" class="text-white hover:text-primary">Kegiatan</a></li>
                            <li><a href="{{ url('/news') }}" class="text-white hover:text-primary">Berita</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                        <p class="text-white text-sm">
                            Email: karangtarunapregas87@gmail.com<br>
                            Email: katarpregas@gmail.com<br>
                            Telp: 021 1234-5678
                        </p>
                    </div>
                </div>
                <div class="border-t border-white border-opacity-20 mt-8 pt-8 text-center text-sm text-white">
                    <p>&copy; {{ date('Y') }} Karang Taruna. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
