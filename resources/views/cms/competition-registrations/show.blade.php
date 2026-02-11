@extends('cms.layouts.app')

@section('title', 'Detail Pendaftaran')

@section('content')
<div class="mb-6">
    <div class="flex items-center space-x-4">
        <a href="{{ route('cms.competition-registrations.index') }}" class="text-gray-600 hover:text-gray-900 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Detail Pendaftaran</h1>
            <p class="text-gray-600">Informasi lengkap peserta lomba</p>
        </div>
    </div>
</div>

<div class="max-w-full">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- Data Peserta --}}
            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-100 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Informasi Peserta
                </h3>
                <div class="space-y-4">
                    <div class="bg-gray-50 rounded-lg p-4 transition hover:bg-gray-100">
                        <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Nama Peserta</span>
                        <span class="block text-base text-gray-900 font-medium">{{ $competitionRegistration->name }}</span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 rounded-lg p-4 transition hover:bg-gray-100">
                            <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Umur</span>
                            <span class="block text-base text-gray-900">{{ $competitionRegistration->age }} Tahun</span>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4 transition hover:bg-gray-100">
                            <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Kelas</span>
                            <span class="block text-base text-gray-900">{{ $competitionRegistration->school_class }}</span>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4 transition hover:bg-gray-100">
                        <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">WhatsApp</span>
                        <div class="flex items-center justify-between">
                            <span class="text-base text-gray-900">{{ $competitionRegistration->whatsapp }}</span>
                            <a href="https://wa.me/{{ preg_replace('/^0/', '62', $competitionRegistration->whatsapp) }}" target="_blank" 
                               class="inline-flex items-center px-3 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full hover:bg-green-200 transition">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.506-.669-.514-.173-.008-.371-.008-.57-.008-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.463 1.065 2.876 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                                </svg>
                                Chat
                            </a>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4 transition hover:bg-gray-100">
                        <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Domisili RT</span>
                        <span class="block text-base text-gray-900">{{ $competitionRegistration->domicile_rt }}</span>
                    </div>
                </div>
            </div>

            {{-- Data Lomba & Pembayaran --}}
            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-100 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Informasi Lomba & Pembayaran
                </h3>
                <div class="space-y-4">
                    <div class="bg-gray-50 rounded-lg p-4 transition hover:bg-gray-100">
                        <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Jenis Lomba</span>
                        <span class="block text-base font-bold text-teal-600">{{ $competitionRegistration->competition_type }}</span>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 rounded-lg p-4 transition hover:bg-gray-100">
                             <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Metode Bayar</span>
                            <span class="block text-base text-gray-900">{{ $competitionRegistration->payment_method }}</span>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4 transition hover:bg-gray-100">
                            <span class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Tanggal Daftar</span>
                            <span class="block text-base text-gray-900">{{ $competitionRegistration->created_at->format('d M Y') }}</span>
                            <span class="text-xs text-gray-500">{{ $competitionRegistration->created_at->format('H:i') }} WIB</span>
                        </div>
                    </div>

                    {{-- Bukti Pembayaran --}}
                    <div class="mt-6">
                        <h4 class="text-sm font-semibold text-gray-900 mb-3 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Bukti Pembayaran
                        </h4>
                        @if($competitionRegistration->payment_proof)
                            <div class="border border-gray-200 rounded-lg overflow-hidden group relative">
                                <div class="bg-gray-100 aspect-w-16 aspect-h-9 flex items-center justify-center bg-checkered p-4">
                                    <img src="{{ Storage::url($competitionRegistration->payment_proof) }}" alt="Bukti Pembayaran" class="max-w-full max-h-[300px] object-contain shadow-sm rounded">
                                </div>
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                                    <a href="{{ Storage::url($competitionRegistration->payment_proof) }}" target="_blank" class="px-4 py-2 bg-white text-gray-900 rounded-lg font-medium shadow-lg hover:bg-gray-50 transition transform scale-95 group-hover:scale-100">
                                        Lihat Ukuran Penuh
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6 text-center">
                                <div class="inline-flex items-center justify-center w-12 h-12 bg-yellow-100 rounded-full mb-3">
                                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                </div>
                                <p class="text-yellow-800 font-medium">Belum ada bukti pembayaran</p>
                                <p class="text-yellow-600 text-sm mt-1">Peserta tidak mengunggah bukti saat mendaftar.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Delete Action --}}
        <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end">
             <form action="{{ route('cms.competition-registrations.destroy', $competitionRegistration) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini? Aksi ini tidak dapat dibatalkan.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="flex items-center px-4 py-2 bg-red-50 text-red-700 rounded-lg hover:bg-red-100 transition border border-red-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Hapus Data Pendaftaran
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
