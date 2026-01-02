@extends('layouts.public')

@section('title', $news->title)

@section('content')

{{-- Hero Section --}}
<div class="relative text-white py-20 overflow-hidden" style="background: linear-gradient(to right, rgba(30, 58, 138, 0.85), rgba(30, 58, 138, 0.85)), url('{{ $news->featured_image ? asset('storage/' . $news->featured_image) : 'https://picsum.photos/seed/news-' . $news->id . '/1920/600' }}'); background-size: cover; background-position: center;">
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="mb-4">
            @if($news->category)
                <span class="inline-block bg-blue-500 text-white px-4 py-1 rounded-full text-sm font-semibold">
                    {{ $news->category->name }}
                </span>
            @endif
        </div>
        <h1 class="text-4xl sm:text-5xl font-bold mb-4">{{ $news->title }}</h1>
        <div class="flex items-center justify-center space-x-4 text-blue-100">
            <span class="flex items-center">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                {{ $news->published_at->format('d M Y') }}
            </span>
            <span class="flex items-center">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
                {{ $news->views_count }} views
            </span>
        </div>
    </div>
</div>

{{-- Content Section --}}
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <article class="bg-white rounded-2xl shadow-lg p-8 md:p-12">
        @if($news->excerpt)
            <div class="text-xl text-gray-600 italic border-l-4 border-blue-500 pl-6 mb-8">
                {{ $news->excerpt }}
            </div>
        @endif

        <div class="prose prose-lg max-w-none">
            {!! $news->body !!}
        </div>
    </article>

    {{-- Related News --}}
    @if($relatedNews->isNotEmpty())
        <div class="mt-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Berita Terkait</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedNews as $related)
                    <a href="{{ route('news.detail', $related->slug) }}" class="group bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="h-48 overflow-hidden bg-gray-200">
                            @if($related->featured_image)
                                <img src="{{ asset('storage/' . $related->featured_image) }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            @else
                                <img src="https://picsum.photos/seed/news-{{ $related->id }}/600/400" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            @endif
                        </div>
                        <div class="p-6">
                            @if($related->category)
                                <span class="inline-block bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-xs font-semibold mb-3">
                                    {{ $related->category->name }}
                                </span>
                            @endif
                            <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition line-clamp-2">
                                {{ $related->title }}
                            </h3>
                            <p class="text-sm text-gray-500">
                                {{ $related->published_at->format('d M Y') }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Back Button --}}
    <div class="mt-12 text-center">
        <a href="{{ route('news') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-semibold">
            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Berita
        </a>
    </div>
</div>

@endsection
