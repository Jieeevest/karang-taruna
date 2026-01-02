@extends('layouts.public')

@section('title', 'Beranda')

@section('content')

{{-- Hero Section --}}
<div class="relative text-white overflow-hidden" style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('{{ asset('images/homepage/hero-main.png') }}'); background-size: cover; background-position: center;">
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 sm:py-32">
        <div class="text-center">
            <h1 class="text-5xl sm:text-6xl md:text-7xl font-bold mb-6 leading-tight">
                MEMBANGUN GENERASI<br>MUDA BERKUALITAS
            </h1>
            <p class="text-xl sm:text-2xl mb-4 text-blue-100 max-w-3xl mx-auto">
                Wadah Pengembangan dan Pemberdayaan Pemuda Indonesia
            </p>
            <p class="text-base sm:text-lg mb-10 text-blue-50 max-w-2xl mx-auto">
                Mari bersama-sama membangun karakter, mengembangkan potensi, dan berkontribusi untuk Indonesia yang lebih baik
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ url('/about') }}" class="bg-white text-blue-600 px-8 py-4 rounded-lg font-semibold hover:bg-blue-50 transition transform hover:scale-105 shadow-lg">
                    Tentang Kami
                </a>
                <a href="{{ url('/activities') }}" class="bg-teal-500 text-white px-8 py-4 rounded-lg font-semibold hover:bg-teal-600 transition transform hover:scale-105 shadow-lg">
                    Lihat Kegiatan
                </a>
            </div>
        </div>
    </div>
</div>

{{-- Quick Info Cards --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-12 relative z-10">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl shadow-xl p-8 hover:shadow-2xl transition">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center h-16 w-16 rounded-lg bg-blue-100 text-blue-600">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-5">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Keanggotaan</h3>
                    <p class="text-gray-600">Bergabunglah dengan komunitas pemuda yang aktif dan inspiratif untuk mengembangkan potensi diri</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-xl p-8 hover:shadow-2xl transition">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center h-16 w-16 rounded-lg bg-teal-100 text-teal-600">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-5">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Program Kegiatan</h3>
                    <p class="text-gray-600">Ikuti berbagai kegiatan sosial, pelatihan, dan program pemberdayaan masyarakat</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-xl p-8 hover:shadow-2xl transition">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center h-16 w-16 rounded-lg bg-purple-100 text-purple-600">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-5">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Pelatihan & Pengembangan</h3>
                    <p class="text-gray-600">Tingkatkan skill dengan berbagai workshop, seminar, dan training dari ahli</p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Stats Showcase --}}
<div class="bg-gradient-to-br from-slate-800 to-slate-900 text-white mt-20 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold mb-4">Fakta Karang Taruna</h2>
            <p class="text-slate-300 text-lg">Pencapaian dan statistik organisasi kami</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div class="group hover:scale-110 transition-transform duration-300">
                <div class="text-5xl font-bold text-teal-400 mb-2">{{ $stats['total_members'] }}+</div>
                <div class="text-slate-300 uppercase tracking-wide text-sm">Anggota Aktif</div>
            </div>
            <div class="group hover:scale-110 transition-transform duration-300">
                <div class="text-5xl font-bold text-blue-400 mb-2">{{ $stats['total_activities'] }}+</div>
                <div class="text-slate-300 uppercase tracking-wide text-sm">Kegiatan</div>
            </div>
            <div class="group hover:scale-110 transition-transform duration-300">
                <div class="text-5xl font-bold text-purple-400 mb-2">{{ $stats['total_documentation'] }}+</div>
                <div class="text-slate-300 uppercase tracking-wide text-sm">Dokumentasi</div>
            </div>
            <div class="group hover:scale-110 transition-transform duration-300">
                <div class="text-5xl font-bold text-orange-400 mb-2">10+</div>
                <div class="text-slate-300 uppercase tracking-wide text-sm">Tahun Berkarya</div>
            </div>
        </div>
    </div>
</div>

{{-- Programs Showcase --}}
<div class="bg-gradient-to-br from-teal-50 to-blue-50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Program Unggulan</h2>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                Berbagai program yang dirancang untuk mengembangkan potensi pemuda dan memberikan kontribusi positif bagi masyarakat
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {{-- Program 1 --}}
            <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="h-64 relative overflow-hidden">
                    <img src="{{ asset('images/homepage/program-social.png') }}" alt="Sosial & Pengabdian" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-blue-900/70 to-transparent"></div>
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Sosial & Pengabdian</h3>
                    <p class="text-gray-600 mb-6">Program bakti sosial, gotong royong, dan kegiatan pengabdian masyarakat untuk membangun kepedulian sosial pemuda</p>
                    <a href="{{ url('/activities') }}" class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-800">
                        Selengkapnya
                        <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Program 2 --}}
            <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="h-64 relative overflow-hidden">
                    <img src="{{ asset('images/homepage/program-entrepreneur.png') }}" alt="Kewirausahaan" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-teal-900/70 to-transparent"></div>
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Kewirausahaan</h3>
                    <p class="text-gray-600 mb-6">Pelatihan dan pendampingan wirausaha muda untuk mengembangkan jiwa entrepreneur dan kemandirian ekonomi</p>
                    <a href="{{ url('/activities') }}" class="inline-flex items-center text-teal-600 font-semibold hover:text-teal-800">
                        Selengkapnya
                        <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Program 3 --}}
            <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="h-64 relative overflow-hidden">
                    <img src="{{ asset('images/homepage/program-creative.png') }}" alt="Kreativitas & Seni" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-purple-900/70 to-transparent"></div>
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Kreativitas & Seni</h3>
                    <p class="text-gray-600 mb-6">Wadah pengembangan bakat dan kreativitas melalui seni, budaya, dan berbagai bentuk ekspresi kreatif</p>
                    <a href="{{ url('/activities') }}" class="inline-flex items-center text-purple-600 font-semibold hover:text-purple-800">
                        Selengkapnya
                        <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Latest News Section --}}
<div class="bg-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Berita & Informasi Terbaru</h2>
            <p class="text-gray-600 text-lg">Ikuti update terkini seputar kegiatan dan informasi Karang Taruna</p>
        </div>

        @if($latestNews->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($latestNews as $news)
                    <article class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                        @if($news->featured_image)
                            <div class="h-56 overflow-hidden">
                                <img src="{{ asset('storage/' . $news->featured_image) }}" alt="{{ $news->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            </div>
                        @else
                            <div class="h-56 bg-gradient-to-br from-blue-400 to-teal-500 flex items-center justify-center">
                                <svg class="h-20 w-20 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                </svg>
                            </div>
                        @endif
                        <div class="p-6">
                            @if($news->category)
                                <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full mb-3">
                                    {{ $news->category->name }}
                                </span>
                            @endif
                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition">
                                <a href="{{ url('/news/' . $news->slug) }}">{{ $news->title }}</a>
                            </h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ Str::limit($news->excerpt, 120) }}</p>
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div class="flex items-center text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $news->published_at->format('d M Y') }}
                                </div>
                                <a href="{{ url('/news/' . $news->slug) }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">
                                    Baca →
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="text-center py-16 bg-gray-50 rounded-2xl">
                <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
                <p class="text-gray-500 text-lg">Belum ada berita yang dipublikasikan</p>
            </div>
        @endif

        <div class="text-center mt-12">
            <a href="{{ url('/news') }}" class="inline-flex items-center bg-gradient-to-r from-blue-600 to-teal-600 text-white px-8 py-4 rounded-lg font-semibold hover:from-blue-700 hover:to-teal-700 transition shadow-lg transform hover:scale-105">
                Lihat Semua Berita
                <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>
    </div>
</div>

{{-- Call to Action --}}
<div class="relative bg-gradient-to-r from-blue-600 via-teal-600 to-purple-600 text-white py-20 overflow-hidden">
    <div class="absolute inset-0 bg-black opacity-20"></div>
    <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.05\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')"></div>
    
    <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl sm:text-5xl font-bold mb-6">Bergabunglah Bersama Kami</h2>
        <p class="text-xl sm:text-2xl text-blue-100 mb-10 max-w-3xl mx-auto">
            Mari bersama-sama membangun generasi muda yang berkarakter, kreatif, dan berdampak positif untuk Indonesia
        </p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ url('/about') }}" class="bg-white text-blue-600 px-10 py-4 rounded-lg font-bold hover:bg-blue-50 transition transform hover:scale-105 shadow-xl text-lg">
                Pelajari Lebih Lanjut
            </a>
            <a href="{{ url('/activities') }}" class="bg-transparent border-2 border-white text-white px-10 py-4 rounded-lg font-bold hover:bg-white hover:text-blue-600 transition transform hover:scale-105 shadow-xl text-lg">
                Lihat Kegiatan Kami
            </a>
        </div>
    </div>
</div>

@endsection
