@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Detail Pendaftaran</h2>
        <a href="{{ route('cms.competition-registrations.index') }}" class="text-gray-600 hover:text-gray-900">
            &larr; Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Data Peserta --}}
        <div>
            <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Peserta</h3>
            <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                <div>
                    <span class="block text-xs font-medium text-gray-500 uppercase">Nama Peserta</span>
                    <span class="block text-sm text-gray-900 font-semibold">{{ $competitionRegistration->name }}</span>
                </div>
                <div>
                    <span class="block text-xs font-medium text-gray-500 uppercase">Umur</span>
                    <span class="block text-sm text-gray-900">{{ $competitionRegistration->age }} Tahun</span>
                </div>
                <div>
                    <span class="block text-xs font-medium text-gray-500 uppercase">Kelas</span>
                    <span class="block text-sm text-gray-900">{{ $competitionRegistration->school_class }}</span>
                </div>
                <div>
                    <span class="block text-xs font-medium text-gray-500 uppercase">Input WhatsApp</span>
                    <span class="block text-sm text-gray-900">{{ $competitionRegistration->whatsapp }}</span>
                    <a href="https://wa.me/{{ preg_replace('/^0/', '62', $competitionRegistration->whatsapp) }}" target="_blank" class="text-xs text-green-600 hover:text-green-800 mt-1 inline-block">
                        Hubungi via WhatsApp &rarr;
                    </a>
                </div>
                <div>
                    <span class="block text-xs font-medium text-gray-500 uppercase">Domisili RT</span>
                    <span class="block text-sm text-gray-900">{{ $competitionRegistration->domicile_rt }}</span>
                </div>
            </div>
        </div>

        {{-- Data Lomba & Pembayaran --}}
        <div>
            <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Lomba & Pembayaran</h3>
            <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                <div>
                    <span class="block text-xs font-medium text-gray-500 uppercase">Jenis Lomba</span>
                    <span class="block text-sm font-semibold text-blue-600">{{ $competitionRegistration->competition_type }}</span>
                </div>
                <div>
                    <span class="block text-xs font-medium text-gray-500 uppercase">Metode Pembayaran</span>
                    <span class="block text-sm text-gray-900">{{ $competitionRegistration->payment_method }}</span>
                </div>
                <div>
                    <span class="block text-xs font-medium text-gray-500 uppercase">Tanggal Daftar</span>
                    <span class="block text-sm text-gray-900">{{ $competitionRegistration->created_at->format('l, d F Y H:i') }}</span>
                </div>
            </div>

            {{-- Bukti Pembayaran --}}
            <div class="mt-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Bukti Pembayaran</h3>
                @if($competitionRegistration->payment_proof)
                    <div class="border rounded-lg overflow-hidden">
                        <img src="{{ Storage::url($competitionRegistration->payment_proof) }}" alt="Bukti Pembayaran" class="w-full h-auto object-contain max-h-[400px]">
                        <div class="bg-gray-50 p-2 text-center">
                            <a href="{{ Storage::url($competitionRegistration->payment_proof) }}" target="_blank" class="text-sm text-indigo-600 hover:text-indigo-900">
                                Lihat Ukuran Asli
                            </a>
                        </div>
                    </div>
                @else
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 text-center text-yellow-800">
                        <p class="text-sm">Peserta tidak mengunggah bukti pembayaran.</p>
                        @if($competitionRegistration->payment_method == 'COD')
                            <p class="text-xs text-mt-1 text-yellow-600">Metode pembayaran adalah COD.</p>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
