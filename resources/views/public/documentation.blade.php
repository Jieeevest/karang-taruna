@extends('layouts.public')

@section('title', 'Dokumentasi')

@section('content')

{{-- Hero Section --}}
<div class="relative text-white overflow-hidden flex items-center justify-center" style="min-height: 320px; background: linear-gradient(to right, rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65)), url('{{ asset('images/homepage/hero-activities.png') }}'); background-size: cover; background-position: center;">
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-16">
        <h1 class="text-4xl sm:text-5xl font-bold mb-4">Dokumentasi Kegiatan</h1>
        <p class="text-xl text-blue-100">Galeri foto dan video kegiatan Karang Taruna</p>
    </div>
</div>

{{-- Documentation Grid --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    @if($documentation->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($documentation as $doc)
                <div class="group relative aspect-square overflow-hidden rounded-lg shadow-lg hover:shadow-2xl transition-all duration-300">
                    @if($doc->file_path)
                        @if(Str::endsWith($doc->file_path, ['.jpg', '.jpeg', '.png', '.gif', '.webp']))
                            <img src="{{ asset('storage/' . $doc->file_path) }}" alt="{{ $doc->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-blue-400 to-teal-500 flex items-center justify-center">
                                <svg class="h-16 w-16 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                    @else
                        <img src="https://picsum.photos/seed/doc-{{ $doc->id }}/400/400" 
                             alt="{{ $doc->title }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    @endif
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-0 left-0 right-0 p-4">
                            <h3 class="text-white font-semibold text-sm mb-1">{{ $doc->title }}</h3>
                            @if($doc->activityRealization)
                                <p class="text-white/80 text-xs">{{ $doc->activityRealization->title }}</p>
                            @endif
                            @if($doc->created_at)
                                <p class="text-white/60 text-xs mt-1">{{ $doc->created_at->format('d M Y') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-12">
            {{ $documentation->links() }}
        </div>
    @else
        <div class="text-center py-16 bg-gray-50 rounded-2xl">
            <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <p class="text-gray-500 text-lg">Belum ada dokumentasi yang tersedia</p>
        </div>
    @endif
</div>

@endsection
