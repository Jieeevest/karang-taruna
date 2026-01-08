@extends('cms.layouts.app')

@section('title', 'Detail Dokumen')

@section('content')
<!-- Header -->
<div class="flex justify-between items-start mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Detail Dokumen</h1>
        <p class="text-gray-600 mt-1">Informasi lengkap dokumen</p>
    </div>
    <div class="flex gap-3">
        <a href="{{ route('cms.documents.download', $document) }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
            </svg>
            Download
        </a>
        <a href="{{ route('cms.documents.index') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
            Kembali
        </a>
    </div>
</div>

<!-- Document Info -->
<div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
    <!-- File Preview Section -->
    <div class="p-8 bg-gray-50 border-b border-gray-200 text-center">
        <div class="inline-block">
            <div class="w-24 h-24 {{ $document->file_icon }} bg-opacity-10 rounded-2xl flex items-center justify-center mb-4">
                <svg class="w-12 h-12 {{ $document->file_icon }}" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <h2 class="text-xl font-bold text-gray-900 mb-1">{{ $document->title }}</h2>
            <p class="text-sm text-gray-600">{{ $document->file_name }}</p>
        </div>
    </div>

    <!-- Document Details -->
    <div class="p-6">
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Description -->
            <div class="md:col-span-2">
                <dt class="text-sm font-medium text-gray-500 mb-1">Deskripsi</dt>
                <dd class="text-sm text-gray-900">{{ $document->description ?? '-' }}</dd>
            </div>

            <!-- File Size -->
            <div>
                <dt class="text-sm font-medium text-gray-500 mb-1">Ukuran File</dt>
                <dd class="text-sm text-gray-900 font-semibold">{{ $document->formatted_file_size }}</dd>
            </div>

            <!-- File Type -->
            <div>
                <dt class="text-sm font-medium text-gray-500 mb-1">Tipe File</dt>
                <dd class="text-sm text-gray-900">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 uppercase">
                        {{ $document->file_extension }}
                    </span>
                </dd>
            </div>

            <!-- Uploaded By -->
            <div>
                <dt class="text-sm font-medium text-gray-500 mb-1">Diupload Oleh</dt>
                <dd class="text-sm text-gray-900">{{ $document->user->name }}</dd>
            </div>

            <!-- Upload Date -->
            <div>
                <dt class="text-sm font-medium text-gray-500 mb-1">Tanggal Upload</dt>
                <dd class="text-sm text-gray-900">{{ $document->created_at->format('d M Y H:i') }}</dd>
            </div>

            <!-- Last Updated -->
            <div>
                <dt class="text-sm font-medium text-gray-500 mb-1">Terakhir Diupdate</dt>
                <dd class="text-sm text-gray-900">{{ $document->updated_at->format('d M Y H:i') }}</dd>
            </div>

            <!-- MIME Type -->
            <div>
                <dt class="text-sm font-medium text-gray-500 mb-1">MIME Type</dt>
                <dd class="text-sm text-gray-900 font-mono text-xs">{{ $document->file_type }}</dd>
            </div>
        </dl>
    </div>

    <!-- Actions -->
    @if(auth()->id() === $document->user_id || auth()->user()->isKetua())
    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-3">
        <a href="{{ route('cms.documents.edit', $document) }}" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            Edit
        </a>
        <form action="{{ route('cms.documents.destroy', $document) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
                Hapus
            </button>
        </form>
    </div>
    @endif
</div>
@endsection
