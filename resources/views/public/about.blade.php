@extends('layouts.public')

@section('title', 'Tentang Kami')

@section('content')

{{-- Hero Section with Contact Info --}}
<div class="relative w-full h-[900px] flex items-end overflow-hidden" style="background: #FFE9D5;">
    {{-- Background Image --}}
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/homepage/karang-taruna-1.jpeg') }}" alt="Karang Taruna" class="w-full h-full object-cover">
    </div>
    
    {{-- Overlay Gradients --}}
    <div class="absolute inset-0 z-10" style="background: rgba(31, 31, 31, 0.75);"></div>
    <div class="absolute inset-0 z-10" style="background: linear-gradient(180deg, rgba(0, 0, 0, 0) -1.23%, #000000 80%);"></div>
    
    {{-- Wave Decoration at Bottom --}}
    <div class="absolute bottom-0 left-0 right-0 z-10">
        <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
            <path d="M0 0L720 80L1440 0V80H0V0Z" fill="white"/>
        </svg>
    </div>
    
    {{-- Content Container --}}
    <div class="relative z-20 w-full px-8 md:px-20 lg:px-[120px] pt-20 pb-20" style="padding: 80px 120px;">
        <div class="max-w-7xl">
            {{-- Main Title with Gradient --}}
            <h1 class="text-5xl md:text-6xl lg:text-[64px] font-bold uppercase mb-10 leading-tight" 
                style="font-family: 'Plus Jakarta Sans', sans-serif; 
                       font-weight: 700; 
                       font-size: 64px; 
                       line-height: 81px;
                       background: linear-gradient(90deg, #55BDC0 0%, rgba(85, 189, 192, 0) 100%), #F5F9FA;
                       -webkit-background-clip: text;
                       -webkit-text-fill-color: transparent;
                       background-clip: text;">
                DIMANA ANDA DAPAT MENEMUKAN KAMI?
            </h1>
            
            {{-- Contact Info Grid --}}
            <div class="grid md:grid-cols-2 gap-10 max-w-3xl">
                {{-- Location --}}
                <div class="space-y-4">
                    <h3 class="text-white font-semibold text-sm">Lokasi</h3>
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-white opacity-50" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <p class="text-white text-sm leading-relaxed">
                            Jl. Melati II, RT 021 RW 001, Kelurahan Gandul, Kecamatan Cinere, Kota Depok
                        </p>
                    </div>
                </div>
                
                {{-- Contact --}}
                <div class="space-y-4">
                    <h3 class="text-white font-semibold text-sm">Kontak Kami</h3>
                    <div class="space-y-4">
                        {{-- Phone --}}
                        <div class="flex items-center gap-4">
                            <svg class="w-5 h-5 text-white opacity-50 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span class="text-white text-sm">021-88345897</span>
                        </div>
                        {{-- Email --}}
                        <div class="flex items-center gap-4">
                            <svg class="w-5 h-5 text-white opacity-50 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-white text-sm">info@karangtarunapregas.id</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Contact Form Section --}}
<div class="relative bg-white" style="padding: 40px 120px;">
    <div class="max-w-7xl mx-auto">
        <div class="grid md:grid-cols-2 gap-10">
            {{-- Contact Form --}}
            <div class="space-y-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-8" style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 24px; line-height: 32px; color: #1F1F1F;">
                    Jangan ragu untuk menghubungi kami.<br>
                    Kami akan senang mendengar kabar dari Anda.
                </h2>
                
                <form class="space-y-6">
                    {{-- Name Field --}}
                    <div>
                        <input type="text" placeholder="Nama" 
                               class="w-full px-4 py-3 border border-[#E1E1E1] rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" 
                               style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 14px; color: #8E8E8E;">
                    </div>
                    
                    {{-- Email Field --}}
                    <div>
                        <input type="email" placeholder="Email" 
                               class="w-full px-4 py-3 border border-[#E1E1E1] rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                               style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 14px; color: #8E8E8E;">
                    </div>
                    
                    {{-- Subject Field --}}
                    <div>
                        <input type="text" placeholder="Subjek" 
                               class="w-full px-4 py-3 border border-[#E1E1E1] rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                               style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 14px; color: #8E8E8E;">
                    </div>
                    
                    {{-- Message Field --}}
                    <div>
                        <textarea placeholder="Masukkan pesan Anda di sini" rows="4"
                                  class="w-full px-4 py-3 border border-[#E1E1E1] rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent resize-none"
                                  style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 14px; color: #8E8E8E;"></textarea>
                    </div>
                    
                    {{-- Submit Button --}}
                    <div>
                        <button type="submit" 
                                class="px-8 py-3 text-white font-medium rounded-lg transition"
                                style="background: #1CA09A; min-width: 120px; height: 48px; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 16px;">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
            
            {{-- Google Maps --}}
            <div class="h-[508px] rounded-2xl overflow-hidden" style="background: #FFE9D5;">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.2834775!2d106.7750!3d-6.3250!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTknMzAuMCJTIDEwNsKwNDYnMzAuMCJF!5e0!3m2!1sen!2sid!4v1234567890"
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
</div>

{{-- PREGAS Organization Info Section --}}
<div class="bg-blue-600 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg p-6 md:p-10">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">KARANG TARUNA PREGAS</h2>
                <p class="text-lg text-gray-700 mb-3">Karang Taruna Persatuan Remaja Gandul Selatan</p>
                <p class="text-gray-600">Berdiri: 26 Agustus 1987</p>
            </div>

            <div class="grid md:grid-cols-2 gap-6 mb-8">
                <div class="border border-gray-200 rounded-lg p-5">
                    <h4 class="font-semibold text-gray-900 mb-3">Sekretariat</h4>
                    <p class="text-gray-700">
                        Jl. Melati II, RT 021 RW 001<br>
                        Kelurahan Gandul, Kecamatan Cinere<br>
                        Kota Depok
                    </p>
                </div>

                <div class="border border-gray-200 rounded-lg p-5">
                    <h4 class="font-semibold text-gray-900 mb-3">Pengurus Inti</h4>
                    <ul class="text-gray-700 space-y-1">
                        <li>• Ketua Umum</li>
                        <li>• Wakil Ketua Umum</li>
                        <li>• Sekretaris</li>
                        <li>• Bendahara</li>
                    </ul>
                </div>
            </div>

            <div class="border border-gray-200 rounded-lg p-5">
                <h4 class="font-semibold text-gray-900 mb-3">Ketua Bidang</h4>
                <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-3">
                    <div class="bg-gray-50 rounded px-3 py-2 text-gray-700 text-center text-sm">
                        Bidang Acara
                    </div>
                    <div class="bg-gray-50 rounded px-3 py-2 text-gray-700 text-center text-sm">
                        Bidang Media
                    </div>
                    <div class="bg-gray-50 rounded px-3 py-2 text-gray-700 text-center text-sm">
                        Bidang Perlengkapan
                    </div>
                    <div class="bg-gray-50 rounded px-3 py-2 text-gray-700 text-center text-sm">
                        Bidang Humas
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Profile Section --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    @if($organization)
        <div class="bg-white rounded-2xl shadow-lg p-8 md:p-12">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Profil Organisasi</h2>
                    <div class="prose prose-lg text-gray-600">
                        {!! nl2br(e($organization->about)) !!}
                    </div>
                </div>
                <div class="bg-gradient-to-br from-blue-50 to-teal-50 rounded-xl p-8">
                    <div class="space-y-6">
                        @if($organization->address)
                        <div class="flex items-start">
                            <svg class="h-6 w-6 text-blue-600 mt-1 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">Alamat</h4>
                                <p class="text-gray-600">{{ $organization->address }}</p>
                            </div>
                        </div>
                        @endif

                        @if($organization->phone)
                        <div class="flex items-start">
                            <svg class="h-6 w-6 text-blue-600 mt-1 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">Telepon</h4>
                                <p class="text-gray-600">{{ $organization->phone }}</p>
                            </div>
                        </div>
                        @endif

                        @if($organization->email)
                        <div class="flex items-start">
                            <svg class="h-6 w-6 text-blue-600 mt-1 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">Email</h4>
                                <p class="text-gray-600">{{ $organization->email }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @if($organization->vision || $organization->mission)
        <div class="mt-16 grid md:grid-cols-2 gap-8">
            @if($organization->vision)
            <div class="bg-gradient-to-br from-blue-500 to-blue-700 text-white rounded-2xl p-8 shadow-lg">
                <div class="flex items-center mb-6">
                    <svg class="h-12 w-12 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    <h3 class="text-2xl font-bold">Visi</h3>
                </div>
                <p class="text-lg leading-relaxed">{{ $organization->vision }}</p>
            </div>
            @endif

            @if($organization->mission)
            <div class="bg-gradient-to-br from-teal-500 to-teal-700 text-white rounded-2xl p-8 shadow-lg">
                <div class="flex items-center mb-6">
                    <svg class="h-12 w-12 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                    <h3 class="text-2xl font-bold">Misi</h3>
                </div>
                <p class="text-lg leading-relaxed">{{ $organization->mission }}</p>
            </div>
            @endif
        </div>
        @endif
    @else
        <div class="text-center py-16">
            <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p class="text-gray-500 text-lg">Profil organisasi belum tersedia</p>
        </div>
    @endif
</div>

{{-- Call to Action --}}
<div class="bg-gradient-to-r from-blue-600 to-teal-600 text-white py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold mb-4">Tertarik Bergabung?</h2>
        <p class="text-xl text-blue-100 mb-8">
            Mari bersama-sama membangun generasi muda yang lebih baik
        </p>
        <a href="{{ url('/activities') }}" class="inline-block bg-white text-blue-600 px-8 py-4 rounded-lg font-semibold hover:bg-blue-50 transition shadow-lg">
            Lihat Kegiatan Kami
        </a>
    </div>
</div>

@endsection
