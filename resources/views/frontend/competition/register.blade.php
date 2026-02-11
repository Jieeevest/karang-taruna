@extends('layouts.public')

@section('title', 'Pendaftaran Lomba')

@section('content')

{{-- Hero Section --}}
<div class="relative w-full min-h-[400px] md:min-h-[500px] h-auto flex items-center overflow-hidden" style="background: #FFE9D5;">
    {{-- Background Image --}}
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/homepage/karang-taruna-1.jpeg') }}" alt="Karang Taruna" class="w-full h-full object-cover">
    </div>
    
    {{-- Overlay Gradients --}}
    <div class="absolute inset-0 z-10" style="background: rgba(31, 31, 31, 0.75);"></div>
    <div class="absolute inset-0 z-10" style="background: linear-gradient(180deg, rgba(0, 0, 0, 0) -1.23%, #000000 80%);"></div>
    
    {{-- Content Container --}}
    <div class="relative z-20 w-full px-4 sm:px-8 md:px-20 lg:px-[120px] py-20 md:py-12">
        <div class="max-w-7xl">
            {{-- Main Title with Gradient --}}
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-[54px] font-bold uppercase mb-4 leading-tight" 
                style="font-family: 'Plus Jakarta Sans', sans-serif; 
                       font-weight: 700; 
                       background: linear-gradient(90deg, #55BDC0 0%, rgba(85, 189, 192, 0) 100%), #F5F9FA;
                       -webkit-background-clip: text;
                       -webkit-text-fill-color: transparent;
                       background-clip: text;">
                PENDAFTARAN PERLOMBAAN<br>RAMADAN PREGAS 2026
            </h1>
            <p class="text-gray-300 text-lg md:text-xl max-w-2xl">
                Silakan isi formulir di bawah ini dengan data yang benar untuk mengikuti perlombaan.
            </p>
        </div>
    </div>
</div>

{{-- Main Content Section --}}
<div class="bg-gradient-to-br from-teal-50 to-blue-50 py-12 md:py-20">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Syarat & Ketentuan --}}
        <div class="bg-white rounded-3xl p-6 md:p-10 mb-8 md:mb-10">
            <h2 class="text-3xl font-bold mb-8 text-center" style="color: #1CA09A; font-family: 'Plus Jakarta Sans', sans-serif;">SYARAT & KETENTUAN</h2>
            <div class="grid md:grid-cols-2 gap-x-12 gap-y-4">
                <ul class="space-y-4 text-gray-700 text-lg">
                    <li class="flex items-start">
                        <span class="text-teal-600 mr-3 mt-1">•</span>
                        Biaya Pendaftaran Rp 25.000 (1 Jenis Lomba)
                    </li>
                    <li class="flex items-start">
                        <span class="text-teal-600 mr-3 mt-1">•</span>
                        Pembayaran Melalui Transfer/Cash
                    </li>
                    <li class="flex items-start">
                        <span class="text-teal-600 mr-3 mt-1">•</span>
                        Wajib Melunasi Pembayaran Pendaftaran H-1
                    </li>
                    <li class="flex items-start">
                        <span class="text-teal-600 mr-3 mt-1">•</span>
                        Cantumkan Nomor WA Untuk Informasi Terbaru
                    </li>
                    <li class="flex items-start">
                        <span class="text-teal-600 mr-3 mt-1">•</span>
                        Pendaftaran terakhir Jumat, 6 Maret 2026
                    </li>
                    <li class="flex items-start">
                        <span class="text-teal-600 mr-3 mt-1">•</span>
                        Lomba Dilaksanakan Sabtu, 7 Maret 2026
                    </li>
                    <li class="flex items-start">
                        <span class="text-teal-600 mr-3 mt-1">•</span>
                        Lomba Dimulai Pukul 08.00 WB s.d. Selesai
                    </li>
                </ul>
                <ul class="space-y-4 text-gray-700 text-lg">
                    <li class="flex items-start">
                        <span class="text-teal-600 mr-3 mt-1">•</span>
                        Hadiah dibagikan Minggu, 8 Maret 2026
                    </li>
                    <li class="flex items-start">
                        <span class="text-teal-600 mr-3 mt-1">•</span>
                        Lomba Adzan Memakai Teks Adzan Shubuh
                    </li>
                    <li class="flex items-start">
                        <span class="text-teal-600 mr-3 mt-1">•</span>
                        Lomba Fashion Show Busana Muslim / Muslimah
                    </li>
                    <li class="flex items-start">
                        <span class="text-teal-600 mr-3 mt-1">•</span>
                        Lomba Da'i Cilik Berdurasi Maksimal 5 Menit
                    </li>
                    <li class="flex items-start">
                        <span class="text-teal-600 mr-3 mt-1">•</span>
                        Lomba Merwarnai Membawa ATK & Meja Pribadi
                    </li>
                    <li class="flex items-start">
                        <span class="text-teal-600 mr-3 mt-1">•</span>
                        Lomba MHQ Besar Surat Al Qari'ah s.d. Ad-Duha
                    </li>
                    <li class="flex items-start">
                        <span class="text-teal-600 mr-3 mt-1">•</span>
                        Lomba MHQ Kecil Surat An-Nas s.d. At-Takatsur
                    </li>
                </ul>
            </div>
        </div>

        {{-- Form Section --}}
        <div class="bg-white rounded-3xl overflow-hidden">
            <div class="p-6 md:p-10">
                <h3 class="text-2xl md:text-3xl font-bold mb-6 md:mb-8 text-center" style="color: #1CA09A; font-family: 'Plus Jakarta Sans', sans-serif;">FORMULIR PENDAFTARAN</h3>

                @if(session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-8 rounded-r-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-green-700">
                                    <span class="font-bold">Sukses!</span> {{ session('success') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-8 rounded-r-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan pada input Anda:</h3>
                                <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('competition.register.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid md:grid-cols-2 gap-6">
                        {{-- Name --}}
                        <div class="md:col-span-2">
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Peserta</label>
                            <input type="text" name="name" id="name" 
                                class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition" 
                                style="font-family: 'Plus Jakarta Sans', sans-serif;"
                                placeholder="Masukkan nama lengkap peserta"
                                value="{{ old('name') }}" required>
                        </div>

                        {{-- Age --}}
                        <div>
                            <label for="age" class="block text-sm font-semibold text-gray-700 mb-2">Umur</label>
                            <input type="number" name="age" id="age" 
                                class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition" 
                                style="font-family: 'Plus Jakarta Sans', sans-serif;"
                                placeholder="Contoh: 10"
                                value="{{ old('age') }}" required min="1">
                        </div>

                        {{-- School Class --}}
                        <div>
                            <label for="school_class" class="block text-sm font-semibold text-gray-700 mb-2">Kelas</label>
                            <div class="relative">
                                <select name="school_class" id="school_class" 
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition bg-white"
                                    style="font-family: 'Plus Jakarta Sans', sans-serif;"
                                    required>
                                    <option value="">Pilih Kelas</option>
                                    <option value="Belum Sekolah" {{ old('school_class') == 'Belum Sekolah' ? 'selected' : '' }}>Belum Sekolah</option>
                                    <option value="SD" {{ old('school_class') == 'SD' ? 'selected' : '' }}>SD</option>
                                    <option value="SMP" {{ old('school_class') == 'SMP' ? 'selected' : '' }}>SMP</option>
                                    <option value="SMA" {{ old('school_class') == 'SMA' ? 'selected' : '' }}>SMA</option>
                                </select>
                            </div>
                        </div>

                        {{-- Whatsapp --}}
                        <div>
                            <label for="whatsapp" class="block text-sm font-semibold text-gray-700 mb-2">Nomor WA</label>
                            <input type="text" name="whatsapp" id="whatsapp" 
                                class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition" 
                                style="font-family: 'Plus Jakarta Sans', sans-serif;"
                                placeholder="08xxxxxxxxxx"
                                value="{{ old('whatsapp') }}" required>
                        </div>

                        {{-- Domicile RT --}}
                        <div>
                            <label for="domicile_rt" class="block text-sm font-semibold text-gray-700 mb-2">Domisili RT</label>
                            <div class="relative">
                                <select name="domicile_rt" id="domicile_rt" 
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition bg-white"
                                    style="font-family: 'Plus Jakarta Sans', sans-serif;"
                                    required>
                                    <option value="">Pilih RT</option>
                                    <option value="RT 003" {{ old('domicile_rt') == 'RT 003' ? 'selected' : '' }}>RT 003</option>
                                    <option value="RT 021" {{ old('domicile_rt') == 'RT 021' ? 'selected' : '' }}>RT 021</option>
                                    <option value="Lainnya" {{ old('domicile_rt') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>
                        </div>

                        {{-- Competition Type --}}
                        <div class="md:col-span-2">
                            <label for="competition_type" class="block text-sm font-semibold text-gray-700 mb-2">Jenis Lomba</label>
                            <div class="relative">
                                <select name="competition_type" id="competition_type" 
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition bg-white"
                                    style="font-family: 'Plus Jakarta Sans', sans-serif;"
                                    required>
                                    <option value="">Pilih Lomba yang Diikuti</option>
                                    <option value="Adzan SD" {{ old('competition_type') == 'Adzan SD' ? 'selected' : '' }}>Adzan SD</option>
                                    <option value="Adzan SMP-SMA" {{ old('competition_type') == 'Adzan SMP-SMA' ? 'selected' : '' }}>Adzan SMP-SMA</option>
                                    <option value="Dai Cilik SD-SMP" {{ old('competition_type') == 'Dai Cilik SD-SMP' ? 'selected' : '' }}>Dai Cilik SD-SMP</option>
                                    <option value="Mewarnai 4-6 TH" {{ old('competition_type') == 'Mewarnai 4-6 TH' ? 'selected' : '' }}>Mewarnai 4-6 TH</option>
                                    <option value="Fashion Show 4-8 TH" {{ old('competition_type') == 'Fashion Show 4-8 TH' ? 'selected' : '' }}>Fashion Show 4-8 TH</option>
                                    <option value="MHQ 4-7 TH" {{ old('competition_type') == 'MHQ 4-7 TH' ? 'selected' : '' }}>MHQ 4-7 TH</option>
                                    <option value="MHQ 8-12 TH" {{ old('competition_type') == 'MHQ 8-12 TH' ? 'selected' : '' }}>MHQ 8-12 TH</option>
                                </select>
                            </div>
                        </div>

                        {{-- Payment Method --}}
                        <div class="md:col-span-2">
                            <label for="payment_method" class="block text-sm font-semibold text-gray-700 mb-2">Metode Pembayaran</label>
                            <div class="relative">
                                <select name="payment_method" id="payment_method" 
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition bg-white"
                                    style="font-family: 'Plus Jakarta Sans', sans-serif;"
                                    required>
                                    <option value="">Pilih Metode Pembayaran</option>
                                    <option value="Transfer" {{ old('payment_method') == 'Transfer' ? 'selected' : '' }}>Transfer</option>
                                    <option value="COD" {{ old('payment_method') == 'COD' ? 'selected' : '' }}>COD (Bayar Tunai)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <div class="pt-6">
                        <button type="submit" 
                            class="w-full md:w-auto px-8 py-4 text-white font-bold rounded-lg transition transform hover:-translate-y-1 hover:shadow-lg"
                            style="background: #1CA09A; min-width: 200px; font-family: 'Plus Jakarta Sans', sans-serif;">
                            DAFTAR SEKARANG
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
