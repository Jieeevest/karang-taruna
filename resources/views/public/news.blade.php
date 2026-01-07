@extends('layouts.public')

@section('title', 'Berita')

@section('content')

{{-- Hero Section --}}
<div class="relative text-white overflow-hidden flex items-center justify-center" style="min-height: 320px; background: linear-gradient(to right, rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65)), url('{{ asset('images/homepage/hero-news.png') }}'); background-size: cover; background-position: center;">
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-16">
        <h1 class="text-4xl sm:text-5xl font-bold mb-4">Berita & Informasi</h1>
        <p class="text-xl text-blue-100">Update terkini seputar Karang Taruna</p>
    </div>
</div>

{{-- News Grid --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    @if($news->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($news as $item)
                <article class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    @if($item->featured_image)
                        <div class="h-56 overflow-hidden">
                            <img src="{{ asset('storage/' . $item->featured_image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        </div>
                    @else
                        <div class="h-56 overflow-hidden bg-gray-200">
                            <img src="https://picsum.photos/seed/news-{{ $item->id }}/600/400" 
                                 alt="{{ $item->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        </div>
                    @endif
                    <div class="p-6">
                        @if($item->category)
                            <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full mb-3">
                                {{ $item->category->name }}
                            </span>
                        @endif
                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition">
                            <a href="{{ url('/news/' . $item->slug) }}">{{ $item->title }}</a>
                        </h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ Str::limit($item->excerpt, 120) }}</p>
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ $item->published_at->format('d M Y') }}
                            </div>
                            <a href="{{ url('/news/' . $item->slug) }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">
                                Baca →
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-12">
            {{ $news->links() }}
        </div>
    @else
        <div class="text-center py-16 bg-gray-50 rounded-2xl">
            <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
            </svg>
            <p class="text-gray-500 text-lg">Belum ada berita yang dipublikasikan</p>
        </div>
    @endif
</div>

@endsection
