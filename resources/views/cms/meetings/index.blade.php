@extends('cms.layouts.app')

@section('title', 'Rapat Koordinasi')

@section('content')
<!-- Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Rapat Koordinasi</h1>
        <p class="text-gray-600 mt-1">Kelola jadwal dan agenda rapat</p>
    </div>
    <a href="{{ route('cms.meetings.create') }}" class="px-4 py-2.5 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition flex items-center font-medium">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Tambah Rapat
    </a>
</div>

<!-- Tabs -->
<div class="border-b border-gray-200 mb-6">
    <nav class="-mb-px flex space-x-8">
        <a href="{{ route('cms.meetings.index') }}" class="@if(!request('status')) border-teal-500 text-teal-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
            Semua Rapat
        </a>
        <a href="{{ route('cms.meetings.index', ['status' => 'scheduled']) }}" class="@if(request('status') === 'scheduled') border-teal-500 text-teal-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
            Terjadwal
        </a>
        <a href="{{ route('cms.meetings.index', ['status' => 'completed']) }}" class="@if(request('status') === 'completed') border-teal-500 text-teal-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
            Selesai
        </a>
    </nav>
</div>

<!-- Filters -->
<div class="bg-white border border-gray-200 rounded-lg p-4 mb-6">
    <form method="GET" action="{{ route('cms.meetings.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Dari</label>
            <input type="date" name="date_from" value="{{ request('date_from') }}" class="w-full border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Sampai</label>
            <input type="date" name="date_to" value="{{ request('date_to') }}" class="w-full border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500">
        </div>
        <div class="flex items-end">
            <button type="submit" class="w-full px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition">
                Filter
            </button>
        </div>
    </form>
</div>

<!-- Meetings List -->
<div class="space-y-4">
    @forelse($meetings as $meeting)
    <div class="bg-white border border-gray-200 rounded-lg p-6 hover:border-teal-300 transition shadow-sm">
        <div class="flex gap-4">
            <!-- Icon -->
            <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-teal-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path>
                    </svg>
                </div>
            </div>

            <!-- Content -->
            <div class="flex-1 min-w-0">
                <!-- Status Badge -->
                @php
                    $statusConfig = [
                        'scheduled' => ['label' => 'Terjadwal', 'class' => 'bg-blue-100 text-blue-700'],
                        'completed' => ['label' => 'Selesai', 'class' => 'bg-green-100 text-green-700'],
                        'cancelled' => ['label' => 'Dibatalkan', 'class' => 'bg-red-100 text-red-700'],
                    ];
                    $status = $statusConfig[$meeting->status] ?? ['label' => ucfirst($meeting->status), 'class' => 'bg-gray-100 text-gray-700'];
                @endphp
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $status['class'] }} mb-2">
                    {{ $status['label'] }}
                </span>

                <!-- Title -->
                <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $meeting->title }}</h3>

                <!-- Meeting Info -->
                <div class="flex flex-wrap gap-4 text-sm text-gray-600 mb-3">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        {{ $meeting->meeting_date->format('d M Y') }}
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ \Carbon\Carbon::parse($meeting->meeting_time)->format('H:i') }}
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        {{ $meeting->location }}
                    </div>
                </div>

                <!-- Agenda Preview -->
                <p class="text-sm text-gray-700 line-clamp-2 mb-3">{{ Str::limit($meeting->agenda, 150) }}</p>

                <!-- Created By -->
                <p class="text-xs text-gray-500">Dibuat oleh: {{ $meeting->user->name }}</p>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col items-end gap-2">
                <a href="{{ route('cms.meetings.show', $meeting) }}" class="px-3 py-1.5 text-sm bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition">
                    Detail
                </a>
                <a href="{{ route('cms.meetings.edit', $meeting) }}" class="px-3 py-1.5 text-sm bg-teal-50 text-teal-600 rounded-lg hover:bg-teal-100 transition">
                    Edit
                </a>
                @if($meeting->status === 'scheduled')
                <form action="{{ route('cms.meetings.complete', $meeting) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-3 py-1.5 text-sm bg-green-50 text-green-600 rounded-lg hover:bg-green-100 transition">
                        Tandai Selesai
                    </button>
                </form>
                @endif
                <form action="{{ route('cms.meetings.destroy', $meeting) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus rapat ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-3 py-1.5 text-sm bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="bg-white border border-gray-200 rounded-lg p-12 text-center">
        <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        <p class="font-medium text-gray-700">Belum ada rapat terjadwal</p>
        <p class="text-sm text-gray-600 mt-1">Mulai tambahkan jadwal rapat koordinasi</p>
    </div>
    @endforelse
</div>

<!-- Pagination -->
@if($meetings->hasPages())
<div class="mt-6">
    {{ $meetings->links() }}
</div>
@endif
@endsection
