@extends('layouts.public')

@section('title', 'Kegiatan')

@section('content')

{{-- Hero Section --}}
<div class="relative text-white py-20 overflow-hidden" style="background: linear-gradient(to right, rgba(17, 94, 89, 0.85), rgba(17, 94, 89, 0.85)), url('{{ asset('images/homepage/hero-activities.png') }}'); background-size: cover; background-position: center;">
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl sm:text-5xl font-bold mb-4">Kegiatan Karang Taruna</h1>
        <p class="text-xl text-blue-100">Program dan aktivitas yang kami jalankan</p>
    </div>
</div>

{{-- Filter Section --}}
<div class="bg-white border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="{{ url('/activities') }}" class="px-6 py-2 rounded-lg font-semibold transition {{ !request('filter') ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Semua
            </a>
            <a href="{{ url('/activities?filter=upcoming') }}" class="px-6 py-2 rounded-lg font-semibold transition {{ request('filter') === 'upcoming' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Akan Datang
            </a>
            <a href="{{ url('/activities?filter=past') }}" class="px-6 py-2 rounded-lg font-semibold transition {{ request('filter') === 'past' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Selesai
            </a>
        </div>
    </div>
</div>

{{-- Activities Grid --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    @if($activities->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($activities as $activity)
                <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="h-48 overflow-hidden bg-gray-200">
                        <img src="https://picsum.photos/seed/activity-{{ $activity->id }}/400/300" 
                             alt="{{ $activity->title }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    </div>
                    <div class="p-6">
                        @if($activity->category)
                            <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full mb-3">
                                {{ $activity->category->name }}
                            </span>
                        @endif
                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition">
                            {{ $activity->title }}
                        </h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ Str::limit($activity->description, 120) }}</p>
                        
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ $activity->planned_date->format('d M Y') }}
                            </div>
                            @if($activity->location)
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $activity->location }}
                            </div>
                            @endif
                        </div>

                        <span class="inline-flex items-center text-sm font-semibold {{ $activity->planned_date >= now() ? 'text-green-600' : 'text-gray-500' }}">
                            <span class="w-2 h-2 rounded-full {{ $activity->planned_date >= now() ? 'bg-green-600' : 'bg-gray-400' }} mr-2"></span>
                            {{ $activity->planned_date >= now() ? 'Akan Datang' : 'Selesai' }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-12">
            {{ $activities->links() }}
        </div>
    @else
        <div class="text-center py-16 bg-gray-50 rounded-2xl">
            <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <p class="text-gray-500 text-lg">Belum ada kegiatan yang dijadwalkan</p>
        </div>
    @endif
</div>

@endsection
