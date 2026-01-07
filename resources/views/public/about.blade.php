@extends('layouts.public')

@section('title', 'Tentang Kami')

@section('content')

{{-- Hero Section with Contact Info --}}
<div class="relative w-full h-[600px] flex items-center overflow-hidden" style="background: #FFE9D5;">
    {{-- Background Image --}}
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/homepage/karang-taruna-1.jpeg') }}" alt="Karang Taruna" class="w-full h-full object-cover">
    </div>
    
    {{-- Overlay Gradients --}}
    <div class="absolute inset-0 z-10" style="background: rgba(31, 31, 31, 0.75);"></div>
    <div class="absolute inset-0 z-10" style="background: linear-gradient(180deg, rgba(0, 0, 0, 0) -1.23%, #000000 80%);"></div>
    

    
    {{-- Content Container --}}
    <div class="relative z-20 w-full px-4 sm:px-8 md:px-20 lg:px-[120px] py-12 sm:py-16 md:py-20">
        <div class="max-w-7xl">
            {{-- Main Title with Gradient --}}
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-[64px] font-bold uppercase mb-6 sm:mb-8 md:mb-10 leading-tight" 
                style="font-family: 'Plus Jakarta Sans', sans-serif; 
                       font-weight: 700; 
                       background: linear-gradient(90deg, #55BDC0 0%, rgba(85, 189, 192, 0) 100%), #F5F9FA;
                       -webkit-background-clip: text;
                       -webkit-text-fill-color: transparent;
                       background-clip: text;">
                DIMANA ANDA DAPAT MENEMUKAN KAMI?
            </h1>
            
            {{-- Contact Info Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-4">
                {{-- Location --}}
                <div class="space-y-4">
                    <h3 class="text-white font-semibold text-sm">Lokasi Sekretariat</h3>
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
                        <!-- {{-- Phone --}}
                        <div class="flex items-center gap-4">
                            <svg class="w-5 h-5 text-white opacity-50 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span class="text-white text-sm">021-88345897</span>
                        </div> -->
                        {{-- Email --}}
                        <div class="flex items-center gap-4">
                            <svg class="w-5 h-5 text-white opacity-50 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-white text-sm">karangtarunapregas87@gmail.com</span>
                        </div>
                        {{-- Email 2 --}}
                        <div class="flex items-center gap-4">
                            <svg class="w-5 h-5 text-white opacity-50 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-white text-sm">katarpregas@gmail.com</span>
                        </div>
                    </div>
                </div>
                <div class="space-y-4">
                    <h3 class="text-white font-semibold text-sm">Sosial Media</h3>
                    <div class="space-y-4">
                        <!-- {{-- Phone --}}
                        <div class="flex items-center gap-4">
                            <svg class="w-5 h-5 text-white opacity-50 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span class="text-white text-sm">021-88345897</span>
                        </div> -->
                        {{-- Youtube --}}
                        <div class="flex items-center gap-4">
                            <svg class="w-5 h-5 flex-shrink-0" viewBox="0 0 24 24" fill="#FF0000">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                            <span class="text-white text-sm">Karang Taruna Pregas</span>
                        </div>
                        {{-- Instagram --}}
                        <div class="flex items-center gap-4">
                            <svg class="w-5 h-5 flex-shrink-0" viewBox="0 0 24 24" fill="url(#instagram-gradient)">
                                <defs>
                                    <linearGradient id="instagram-gradient" x1="0%" y1="100%" x2="100%" y2="0%">
                                        <stop offset="0%" style="stop-color:#FED373;stop-opacity:1" />
                                        <stop offset="15%" style="stop-color:#F15245;stop-opacity:1" />
                                        <stop offset="30%" style="stop-color:#D92E7F;stop-opacity:1" />
                                        <stop offset="70%" style="stop-color:#9B36B7;stop-opacity:1" />
                                        <stop offset="100%" style="stop-color:#515ECF;stop-opacity:1" />
                                    </linearGradient>
                                </defs>
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                            <span class="text-white text-sm">Karang Taruna Pregas</span>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

{{-- Contact Form Section --}}
<!-- <div class="relative bg-white" style="padding: 40px 120px;">
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
</div> -->

{{-- Visi & Misi Section --}}
<div class="bg-gradient-to-br from-teal-50 to-blue-50 py-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Title --}}
        <h2 class="text-4xl md:text-5xl font-bold text-center mb-12" style="color: #1CA09A;">KARANG TARUNA PREGAS</h2>
        
        {{-- Team Photo --}}
        <div class="mb-16">
            <div class="bg-white rounded-3xl shadow-xl p-4 md:p-8">
                <img src="{{ asset('images/homepage/logo-pregas.jpeg') }}" 
                     alt="Karang Taruna PREGAS Team" 
                     class="w-full h-auto rounded-2xl">
            </div>
        </div>

        <p class="text-gray-700 text-lg leading-relaxed mb-12">
            Berdiri sejak 26 Agustus 1987, Karang Taruna PREGAS (Persatuan Remaja Gandul Selatan) adalah wadah kreativitas pemuda yang bergerak dalam kegiatan sosial dan pelestarian lingkungan untuk memberikan dampak positif bagi Wilayah Kelurahan Gandul.
        </p>

        {{-- Visi --}}
        <div class="mb-12">
            <h3 class="text-3xl font-bold mb-4" style="color: #1CA09A;">Visi</h3>
            <p class="text-gray-700 text-lg leading-relaxed">
                Mewujudkan generasi muda berkarakter mulia, bersatu, unggul, serta adaptif dalam membangun kesejahteraan lingkungan.
            </p>
        </div>

        {{-- Misi --}}
        <div class="mb-12">
            <h3 class="text-3xl font-bold mb-4" style="color: #1CA09A;">Misi</h3>
            <ul class="space-y-3 text-gray-700 text-lg">
                <li class="flex items-start">
                    <span class="text-teal-600 mr-3 mt-1">•</span>
                    <span><strong>Integritas:</strong> Membangun iman, takwa, dan budi pekerti luhur.</span>
                </li>
                <li class="flex items-start">
                    <span class="text-teal-600 mr-3 mt-1">•</span>
                    <span><strong>Solidaritas:</strong> Memperkuat silaturahmi, gotong royong, dan kerukunan warga.</span>
                </li>
                <li class="flex items-start">
                    <span class="text-teal-600 mr-3 mt-1">•</span>
                    <span><strong>Kreativitas:</strong> Mewadahi bakat dan kemandirian untuk menciptakan inovasi.</span>
                </li>
                <li class="flex items-start">
                    <span class="text-teal-600 mr-3 mt-1">•</span>
                    <span><strong>Kompetensi:</strong> Membentuk SDM cerdas yang tanggap dan adaptif terhadap zaman.</span>
                </li>
                <li class="flex items-start">
                    <span class="text-teal-600 mr-3 mt-1">•</span>
                    <span><strong>Pengabdian:</strong> Melakukan aksi sosial nyata demi menjaga kehormatan organisasi dan wilayah.</span>
                </li>
            </ul>
        </div>

        {{-- MAKNA & FILOSOFI LAMBANG --}}
        <div class="mb-12">
            <h3 class="text-3xl font-bold mb-4" style="color: #1CA09A;">MAKNA & FILOSOFI LAMBANG</h3>
            <ul class="space-y-3 text-gray-700 text-lg">
                <li class="flex items-start">
                    <span class="text-teal-600 mr-3 mt-1">•</span>
                    <span><strong>TEKS MELENGKUNG:</strong> Simbol payung pemersatu yang inklusif, fleksibel, dan tanpa membedakan latar belakang.</span>
                </li>
                <li class="flex items-start">
                    <span class="text-teal-600 mr-3 mt-1">•</span>
                    <span><strong>API MERAH:</strong> Melambangkan kekuatan, keberanian, dan semangat juang yang terus menyala.</span>
                </li>
                <li class="flex items-start">
                    <span class="text-teal-600 mr-3 mt-1">•</span>
                    <span><strong>BINTANG BIRU:</strong> Cita-cita tinggi dan landasan spiritual; simbol kebijaksanaan untuk menyeimbangkan semangat (api).</span>
                </li>
                <li class="flex items-start">
                    <span class="text-teal-600 mr-3 mt-1">•</span>
                    <span><strong>TIGA LINGKARAN:</strong> Dalam (Tebal), Keteguhan prinsip menjaga persaudaraan. Tengah (Tipis), Keseimbangan dan harmoni. Luar (Adaptif), Fleksibilitas menyesuaikan diri dengan perkembangan zaman.</span>
                </li>
                <li class="flex items-start">
                    <span class="text-teal-600 mr-3 mt-1">•</span>
                    <span><strong>JABAT TANGAN:</strong> Simbol utama persaudaraan, kolaborasi, dan gotong royong.</span>
                </li>
                <li class="flex items-start">
                    <span class="text-teal-600 mr-3 mt-1">•</span>
                    <span><strong>PITA PENYANGGA:</strong> Pondasi kokoh dan komitmen menjaga nama baik wilayah.</span>
                </li>
                <li class="flex items-start">
                    <span class="text-teal-600 mr-3 mt-1">•</span>
                    <span><strong>AKRONIM "PREGAS":</strong> Identitas organisasi yang solid, berintegritas, dan lugas.</span>
                </li>
            </ul>
        </div>

        {{-- KESIMPULAN --}}
        <div class="mb-12">
            <h3 class="text-3xl font-bold mb-4" style="color: #1CA09A;">KESIMPULAN</h3>
            <p class="text-gray-700 text-lg leading-relaxed">
                PREGAS adalah organisasi yang menjunjung tinggi persatuan dan semangat juang, namun tetap bijaksana dan adaptif demi kemajuan Wilayah Kelurahan Gandul.
            </p>
        </div>
    </div>
</div>

@endsection
