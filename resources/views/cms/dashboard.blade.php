@extends('cms.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="mb-4">
    <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
    <p class="text-gray-600">Selamat datang, {{ auth()->user()->name }} ({{ auth()->user()->role->name }})</p>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 gap-4 mb-4 sm:grid-cols-2 lg:grid-cols-4">
    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow">
        <div class="flex items-center">
            <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-700">{{ $stats['total_users'] ?? 0 }}</p>
                <p class="text-sm text-gray-500">Total Anggota Aktif</p>
            </div>
        </div>
    </div>

    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow">
        <div class="flex items-center">
            <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-700">{{ $stats['total_activities'] ?? 0 }}</p>
                <p class="text-sm text-gray-500">Total Kegiatan</p>
            </div>
        </div>
    </div>

    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow">
        <div class="flex items-center">
            <div class="p-3 mr-4 text-purple-500 bg-purple-100 rounded-full">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-700">{{ $stats['total_contents'] ?? 0 }}</p>
                <p class="text-sm text-gray-500">Konten Terpublikasi</p>
            </div>
        </div>
    </div>

    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow">
        <div class="flex items-center">
            <div class="p-3 mr-4 text-yellow-500 bg-yellow-100 rounded-full">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-700">{{ $stats['total_documentation'] ?? 0 }}</p>
                <p class="text-sm text-gray-500">Dokumentasi</p>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activities -->
<div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow">
        <h2 class="mb-3 text-lg font-semibold text-gray-900">Kegiatan Terbaru</h2>
        <div class="space-y-3">
            @forelse($recentActivities ?? [] as $activity)
            <div class="pb-3 border-b border-gray-200">
                <div class="flex items-start justify-between">
                    <div>
                        <h3 class="text-sm font-medium text-gray-900">{{ $activity->title }}</h3>
                        <p class="text-xs text-gray-500">{{ $activity->category->name ?? 'Umum' }} • {{ $activity->planned_date->format('d M Y') }}</p>
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium 
                            @if($activity->status === 'approved') bg-green-100 text-green-800 
                            @elseif($activity->status === 'proposed') bg-yellow-100 text-yellow-800 
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ ucfirst($activity->status) }}
                        </span>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-sm text-gray-500">Belum ada kegiatan terbaru</p>
            @endforelse
        </div>
    </div>

    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow">
        <h2 class="mb-3 text-lg font-semibold text-gray-900">Konten Terbaru</h2>
        <div class="space-y-3">
            @forelse($recentContents ?? [] as $content)
            <div class="pb-3 border-b border-gray-200">
                <h3 class="text-sm font-medium text-gray-900">{{ $content->title }}</h3>
                <p class="text-xs text-gray-500">{{ $content->category->name ?? 'Uncategorized' }} • {{ $content->created_at->diffForHumans() }}</p>
                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium 
                    @if($content->status === 'published') bg-green-100 text-green-800 
                    @else bg-gray-100 text-gray-800 @endif">
                    {{ ucfirst($content->status) }}
                </span>
            </div>
            @empty
            <p class="text-sm text-gray-500">Belum ada konten terbaru</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
