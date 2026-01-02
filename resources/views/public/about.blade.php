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
        <h2 class="text-4xl md:text-5xl font-bold text-center mb-12" style="color: #1CA09A;">Visi & Misi</h2>
        
        {{-- Team Photo --}}
        <div class="mb-16">
            <div class="bg-white rounded-3xl shadow-xl p-4 md:p-8">
                <img src="{{ asset('images/homepage/karang-taruna-5.jpeg') }}" 
                     alt="Karang Taruna PREGAS Team" 
                     class="w-full h-auto rounded-2xl">
            </div>
        </div>

        {{-- Visi --}}
        <div class="mb-12">
            <h3 class="text-3xl font-bold mb-4" style="color: #1CA09A;">Visi</h3>
            <p class="text-gray-700 text-lg leading-relaxed">
                Menjadi wadah pembinaan dan pengembangan generasi muda yang berkarakter, kreatif, dan berdaya saing di tingkat nasional pada tahun 2030.
            </p>
        </div>

        {{-- Misi --}}
        <div class="mb-12">
            <h3 class="text-3xl font-bold mb-4" style="color: #1CA09A;">Misi</h3>
            <ul class="space-y-3 text-gray-700 text-lg">
                <li class="flex items-start">
                    <span class="text-teal-600 mr-3 mt-1">•</span>
                    <span>Meningkatkan peran serta karang taruna dalam pemberdayaan generasi muda di kelurahan.</span>
                </li>
                <li class="flex items-start">
                    <span class="text-teal-600 mr-3 mt-1">•</span>
                    <span>Menyelenggarakan program dan kegiatan yang mendukung pengembangan Tri Dharma Karang Taruna (Tri Bina).</span>
                </li>
                <li class="flex items-start">
                    <span class="text-teal-600 mr-3 mt-1">•</span>
                    <span>Meningkatkan kualitas SDM melalui pelatihan dan pendampingan berkelanjutan.</span>
                </li>
                <li class="flex items-start">
                    <span class="text-teal-600 mr-3 mt-1">•</span>
                    <span>Meningkatkan peran dalam pendidikan dan pencegahan penyalahgunaan NAPZA.</span>
                </li>
                <li class="flex items-start">
                    <span class="text-teal-600 mr-3 mt-1">•</span>
                    <span>Meningkatkan pengabdian kepada masyarakat melalui bakti sosial dan kerja sama dengan berbagai pihak terkait untuk kesejahteraan bersama masyarakat.</span>
                </li>
            </ul>
        </div>

        {{-- Tujuan --}}
        <div class="mb-12">
            <h3 class="text-3xl font-bold mb-4" style="color: #1CA09A;">Tujuan</h3>
            <ul class="space-y-3 text-gray-700 text-lg">
                <li class="flex items-start">
                    <span class="text-teal-600 mr-3 mt-1">•</span>
                    <span>Mengembangkan jiwa berorganisasi dan kepemimpinan.</span>
                </li>
                <li class="flex items-start">
                    <span class="text-teal-600 mr-3 mt-1">•</span>
                    <span>Meningkatkan kapasitas SDM.</span>
                </li>
                <li class="flex items-start">
                    <span class="text-teal-600 mr-3 mt-1">•</span>
                    <span>Meningkatkan partisipasi dalam berbagai kegiatan meliputi: sosial, ekonomi, keagamaan.</span>
                </li>
                <li class="flex items-start">
                    <span class="text-teal-600 mr-3 mt-1">•</span>
                    <span>Meningkatkan jiwa peduli dengan pencegahan tinggi kesehatan dalam negeri maupun negara yang berkembang.</span>
                </li>
                <li class="flex items-start">
                    <span class="text-teal-600 mr-3 mt-1">•</span>
                    <span>Meningkatkan kesadaran akan pentingnya lingkungan yang sehat dan bersih.</span>
                </li>
                <li class="flex items-start">
                    <span class="text-teal-600 mr-3 mt-1">•</span>
                    <span>Mewujudkan kepedulian sesama dan terlibat langsung dalam kegiatan akademis dan non akademis.</span>
                </li>
            </ul>
        </div>

        {{-- Sasaran --}}
        <div class="mb-12">
            <h3 class="text-3xl font-bold mb-4" style="color: #1CA09A;">Sasaran</h3>
            <ul class="space-y-3 text-gray-700 text-lg">
                <li class="flex items-start">
                    <span class="text-teal-600 mr-3 mt-1">•</span>
                    <span>Generasi muda penghuni wilayah pekarangan tumbuh kuat berbagai aspek sosialitas dan kreativitas.</span>
                </li>
                <li class="flex items-start">
                    <span class="text-teal-600 mr-3 mt-1">•</span>
                    <span>Tumbuh berkembang secara selaras dan sejahtera dalam upaya menuju negara.</span>
                </li>
                <li class="flex items-start">
                    <span class="text-teal-600 mr-3 mt-1">•</span>
                    <span>Meningkatkan kreativitas generasi muda yang memiliki kepedulian terhadap lingkungan dan sosial kemasyarakatan.</span>
                </li>
                <li class="flex items-start">
                    <span class="text-teal-600 mr-3 mt-1">•</span>
                    <span>Bergerak aktif dalam bidang pendidikan dalam aspek NAPZA.</span>
                </li>
                <li class="flex items-start">
                    <span class="text-teal-600 mr-3 mt-1">•</span>
                    <span>Turut dalam kepedulian sosial melalui aksi kegiatan yang mendorong rasa kasih sosial di dalam negeri maupun per kelas stikes.</span>
                </li>
                <li class="flex items-start">
                    <span class="text-teal-600 mr-3 mt-1">•</span>
                    <span>Terlibat aktif dalam kegiatan CSR di dalam atau sekitar lokasi lingkungan.</span>
                </li>
                <li class="flex items-start">
                    <span class="text-teal-600 mr-3 mt-1">•</span>
                    <span>Terlibat dalam bersifat pencegahan terhadap pencemaran di alam.</span>
                </li>
                <li class="flex items-start">
                    <span class="text-teal-600 mr-3 mt-1">•</span>
                    <span>Meningkatkan partisipasi terhadap kegiatan sosial kemasyarakatan agar tercipta kuantitas perkumpulan sosial yang berguna untuk semua kalangan.</span>
                </li>
            </ul>
        </div>
    </div>
</div>

@endsection
