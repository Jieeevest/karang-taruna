@extends('cms.layouts.app')

@section('title', 'Detail Rapat')

@section('content')
<div class="max-w-4xl">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Detail Rapat Koordinasi</h1>
            <p class="text-gray-600 mt-1">Informasi lengkap rapat</p>
        </div>
        <a href="{{ route('cms.meetings.index') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
            Kembali
        </a>
    </div>

    <!-- Meeting Details -->
    <div class="bg-white border border-gray-200 rounded-lg p-6 mb-6">
        <div class="grid grid-cols-1 gap-6">
            <!-- Status Badge & Title -->
            <div>
                @php
                    $statusConfig = [
                        'scheduled' => ['label' => 'Terjadwal', 'class' => 'bg-blue-100 text-blue-700'],
                        'completed' => ['label' => 'Selesai', 'class' => 'bg-green-100 text-green-700'],
                        'cancelled' => ['label' => 'Dibatalkan', 'class' => 'bg-red-100 text-red-700'],
                    ];
                    $status = $statusConfig[$meeting->status] ?? ['label' => ucfirst($meeting->status), 'class' => 'bg-gray-100 text-gray-700'];
                @endphp
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $status['class'] }} mb-3">
                    {{ $status['label'] }}
                </span>
                <h2 class="text-2xl font-bold text-gray-900">{{ $meeting->title }}</h2>
            </div>

            <!-- Meeting Schedule -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4 bg-gray-50 rounded-lg">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Tanggal</p>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-base font-semibold text-gray-900">{{ $meeting->meeting_date->format('d F Y') }}</p>
                    </div>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-1">Waktu</p>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-base font-semibold text-gray-900">{{ \Carbon\Carbon::parse($meeting->meeting_time)->format('H:i') }} WIB</p>
                    </div>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-1">Lokasi</p>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <p class="text-base font-semibold text-gray-900">{{ $meeting->location }}</p>
                    </div>
                </div>
            </div>

            <!-- Agenda -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Agenda Rapat
                </h3>
                <div class="p-4 bg-gray-50 rounded-lg">
                    <pre class="whitespace-pre-wrap text-sm text-gray-700 font-sans">{{ $meeting->agenda }}</pre>
                </div>
            </div>

            <!-- Notes -->
            @if($meeting->notes)
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Catatan & Hasil Rapat
                </h3>
                <div class="p-4 bg-green-50 border border-green-200 rounded-lg">
                    <pre class="whitespace-pre-wrap text-sm text-gray-700 font-sans">{{ $meeting->notes }}</pre>
                </div>
            </div>
            @endif

            <!-- Created By -->
            <div class="pt-4 border-t border-gray-200">
                <p class="text-sm text-gray-600 mb-1">Dibuat Oleh</p>
                <p class="text-base font-medium text-gray-900">{{ $meeting->user->name }}</p>
                <p class="text-sm text-gray-600">{{ $meeting->created_at->format('d F Y, H:i') }}</p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-3 mt-6 pt-6 border-t border-gray-200">
            <a href="{{ route('cms.meetings.edit', $meeting) }}" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition">
                Edit Rapat
            </a>
            @if($meeting->status === 'scheduled')
            <form action="{{ route('cms.meetings.complete', $meeting) }}" method="POST">
                @csrf
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                    Tandai Selesai
                </button>
            </form>
            @endif
            <form action="{{ route('cms.meetings.destroy', $meeting) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus rapat ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                    Hapus Rapat
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
