@extends('cms.layouts.app')

@section('title', 'Dokumentasi')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Dokumentasi</h2>
            <p class="text-gray-600 mt-1">Galeri foto dan dokumen kegiatan</p>
        </div>
        <a href="{{ route('cms.documentation.create') }}" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
            </svg>
            Upload Dokumentasi
        </a>
    </div>

    <!-- Filters -->
    <div class="mb-6 bg-gray-50 p-4 rounded-lg border border-gray-100">
        <form action="{{ route('cms.documentation.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4">

            <div class="w-full sm:w-48">
                <select name="type" class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500">
                    <option value="">Semua Tipe</option>
                    <option value="photo" {{ request('type') == 'photo' ? 'selected' : '' }}>Foto</option>
                    <option value="video" {{ request('type') == 'video' ? 'selected' : '' }}>Video</option>
                    <option value="document" {{ request('type') == 'document' ? 'selected' : '' }}>Dokumen</option>
                </select>
            </div>
            <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700 transition">
                Filter
            </button>
        </form>
    </div>

    <!-- Gallery Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($documents as $document)
        <div class="group bg-white rounded-lg border border-gray-200 overflow-hidden hover:shadow-md transition">
            <div class="aspect-w-16 aspect-h-9 bg-gray-100 relative">
                @if($document->type == 'photo')
                    <img src="{{ Storage::url($document->file_path) }}" alt="{{ $document->title }}" class="object-cover w-full h-48">
                @elseif($document->type == 'video')
                    <div class="flex items-center justify-center h-48 bg-gray-800 text-white">
                        <svg class="w-12 h-12 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                @else
                    <div class="flex items-center justify-center h-48 bg-gray-100 text-gray-400">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                @endif
                
                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100 gap-2">
                    <a href="{{ Storage::url($document->file_path) }}" target="_blank" class="p-2 bg-white rounded-full text-gray-800 hover:text-teal-600 transition" title="Lihat">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </a>
                    <a href="{{ route('cms.documentation.edit', $document) }}" class="p-2 bg-white rounded-full text-gray-800 hover:text-blue-600 transition" title="Edit">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </a>
                    <form action="{{ route('cms.documentation.destroy', $document) }}" method="POST" onsubmit="return confirm('Hapus file ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 bg-white rounded-full text-gray-800 hover:text-red-600 transition" title="Hapus">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
            <div class="p-4">
                <h3 class="font-medium text-gray-800 truncate" title="{{ $document->title }}">{{ $document->title }}</h3>
                <p class="text-xs text-gray-500 mt-1">
                    {{ ucfirst($document->type) }} • {{ $document->created_at->diffForHumans() }}
                </p>
                @if($document->activityRealization)
                    <p class="text-xs text-teal-600 mt-1 truncate">
                        {{ $document->activityRealization->activityPlan->title }}
                    </p>
                @endif
            </div>
        </div>
        @empty
        <div class="col-span-1 sm:col-span-2 lg:col-span-3 xl:col-span-4 py-12 text-center text-gray-500">
            <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <p>Belum ada dokumentasi yang diunggah.</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $documents->links() }}
    </div>
</div>
@endsection
