<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'CMS') - Karang Taruna PREGAS</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>
    
    <style>
        .menu-item-active {
            background: #E0F2F1;
            /* border-left removed as requested */
        }
        .menu-item:hover {
            background: #F0F9FF;
            transform: translateX(4px);
        }
        .menu-item {
            transition: all 0.2s ease;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Sidebar -->
    <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 bg-white border-r border-gray-200 shadow-lg" aria-label="Sidebar">
        <div class="h-full flex flex-col">
            <div class="flex-1 px-4 py-6 overflow-y-auto">
                <!-- Logo & Branding -->
                <div class="mb-8 text-center">
                    <a href="{{ route('cms.dashboard') }}" class="block">
                        <div class="w-16 h-16 mx-auto mb-3 bg-gradient-to-br from-teal-500 to-teal-600 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h1 class="text-xl font-bold text-gray-900">Karang Taruna</h1>
                        <p class="text-xs text-gray-600">PREGAS CMS</p>
                    </a>
                </div>

                <!-- View Website Button -->
                <a href="{{ url('/') }}" target="_blank" class="flex items-center justify-center w-full p-3 mb-6 text-sm font-semibold text-white bg-gradient-to-r from-teal-500 to-teal-600 rounded-lg hover:from-teal-600 hover:to-teal-700 transition shadow-md">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                    </svg>
                    Lihat Website
                    <svg class="w-4 h-4 ml-auto" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z"></path>
                    </svg>
                </a>
                
                <!-- Navigation -->
                <nav class="space-y-2">
                    <!-- Dashboard - All roles can see -->
                    <a href="{{ route('cms.dashboard') }}" class="flex items-center p-3 text-gray-700 rounded-lg menu-item @if(request()->routeIs('cms.dashboard')) menu-item-active @endif">
                        <svg class="w-5 h-5 mr-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        <span class="font-medium">Dashboard</span>
                    </a>

                    <!-- Master Data Section - Only Ketua -->
                    @if(auth()->user()->isKetua())
                    <div class="pt-4 pb-2">
                        <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Master Data</p>
                    </div>
                    
                    <a href="{{ route('cms.users.index') }}" class="flex items-center p-3 text-gray-700 rounded-lg menu-item @if(request()->routeIs('cms.users.*')) menu-item-active @endif">
                        <svg class="w-5 h-5 mr-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                        </svg>
                        <span class="font-medium">Master Anggota</span>
                    </a>
                    
                    <a href="{{ route('cms.categories.index') }}" class="flex items-center p-3 text-gray-700 rounded-lg menu-item @if(request()->routeIs('cms.categories.*')) menu-item-active @endif">
                        <svg class="w-5 h-5 mr-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path>
                        </svg>
                        <span class="font-medium">Master Kategori</span>
                    </a>
                    @endif

                    <!-- Content Section - Ketua & Admin Data -->
                    @if(auth()->user()->isKetua() || auth()->user()->isAdmin())
                    <div class="pt-4 pb-2">
                        <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Konten</p>
                    </div>
                    
                    <a href="{{ route('cms.news.index') }}" class="flex items-center p-3 text-gray-700 rounded-lg menu-item @if(request()->routeIs('cms.news.*')) menu-item-active @endif">
                        <svg class="w-5 h-5 mr-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd"></path>
                            <path d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V7z"></path>
                        </svg>
                        <span class="font-medium">Master Konten</span>
                    </a>
                    @endif

                    <!-- Activities Section - Ketua & Anggota -->
                    @if(auth()->user()->isKetua() || auth()->user()->isAnggota())
                    <div class="pt-4 pb-2">
                        <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Kegiatan</p>
                    </div>
                    
                    <a href="{{ route('cms.activity-plans.index') }}" class="flex items-center p-3 text-gray-700 rounded-lg menu-item @if(request()->routeIs('cms.activity-plans.*')) menu-item-active @endif">
                        <svg class="w-5 h-5 mr-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="font-medium">Rencana Kegiatan</span>
                    </a>
                    
                    <a href="{{ route('cms.activity-realizations.index') }}" class="flex items-center p-3 text-gray-700 rounded-lg menu-item @if(request()->routeIs('cms.activity-realizations.*')) menu-item-active @endif">
                        <svg class="w-5 h-5 mr-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="font-medium">Realisasi Kegiatan</span>
                    </a>
                    @endif
                    
                    <!-- Documentation - Ketua, Admin Data, & Anggota -->
                    @if(auth()->user()->isKetua() || auth()->user()->isAdmin() || auth()->user()->isAnggota())
                    <a href="{{ route('cms.documentation.index') }}" class="flex items-center p-3 text-gray-700 rounded-lg menu-item @if(request()->routeIs('cms.documentation.*')) menu-item-active @endif">
                        <svg class="w-5 h-5 mr-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="font-medium">Dokumentasi</span>
                    </a>
                    @endif
                </nav>
            </div>
            
            <!-- User Info & Logout (at bottom) -->
            <div class="p-4 border-t border-gray-200">
                <div class="flex items-center p-3 mb-2 bg-gray-50 rounded-lg">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-gradient-to-br from-teal-500 to-teal-600 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1 ml-3">
                        <p class="text-sm font-semibold text-gray-900 truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-600">{{ auth()->user()->role->name ?? 'User' }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center justify-center w-full p-2 text-sm font-medium text-white bg-red-500 rounded-lg hover:bg-red-600 transition">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"></path>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="p-4 sm:ml-64">
        <div class="p-4 rounded-lg">
            @yield('content')
        </div>
    </div>

    <!-- Global SweetAlert2 Notifications -->
    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                toast: true,
                position: 'top-end'
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                showConfirmButton: true,
                confirmButtonColor: '#dc2626'
            });
        @endif

        @if(session('warning'))
            Swal.fire({
                icon: 'warning',
                title: 'Perhatian!',
                text: '{{ session('warning') }}',
                showConfirmButton: true,
                confirmButtonColor: '#f59e0b'
            });
        @endif

        @if(session('info'))
            Swal.fire({
                icon: 'info',
                title: 'Informasi',
                text: '{{ session('info') }}',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        @endif

        @if($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan!',
                html: '<ul style="text-align: left;">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
                showConfirmButton: true,
                confirmButtonColor: '#dc2626'
            });
        @endif
    </script>
</body>
</html>
