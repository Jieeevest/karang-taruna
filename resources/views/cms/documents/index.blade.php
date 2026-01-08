@extends('cms.layouts.app')

@section('title', 'File Dokumen')

@section('content')
<!-- Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">File Dokumen</h1>
        <p class="text-gray-600 mt-1">Kelola repository dokumen Karang Taruna</p>
    </div>
    <a href="{{ route('cms.documents.create') }}" class="px-4 py-2.5 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition flex items-center font-medium">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Upload Dokumen
    </a>
</div>

<!-- Summary Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="bg-gradient-to-br from-teal-50 to-teal-100 border border-teal-200 rounded-lg p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-teal-600 font-medium mb-1">Total Dokumen</p>
                <p class="text-2xl font-bold text-teal-700">{{ number_format($totalDocuments) }}</p>
            </div>
            <div class="bg-teal-200 p-3 rounded-full">
                <svg class="w-6 h-6 text-teal-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-lg p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-blue-600 font-medium mb-1">Total Ukuran</p>
                <p class="text-2xl font-bold text-blue-700">
                    @php
                        $totalSizeFormatted = $totalSize >= 1073741824 
                            ? number_format($totalSize / 1073741824, 2) . ' GB'
                            : ($totalSize >= 1048576 
                                ? number_format($totalSize / 1048576, 2) . ' MB'
                                : ($totalSize >= 1024 
                                    ? number_format($totalSize / 1024, 2) . ' KB'
                                    : $totalSize . ' B'));
                    @endphp
                    {{ $totalSizeFormatted }}
                </p>
            </div>
            <div class="bg-blue-200 p-3 rounded-full">
                <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 12v3c0 1.657 3.134 3 7 3s7-1.343 7-3v-3c0 1.657-3.134 3-7 3s-7-1.343-7-3z"></path>
                    <path d="M3 7v3c0 1.657 3.134 3 7 3s7-1.343 7-3V7c0 1.657-3.134 3-7 3S3 8.657 3 7z"></path>
                    <path d="M17 5c0 1.657-3.134 3-7 3S3 6.657 3 5s3.134-3 7-3 7 1.343 7 3z"></path>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Search -->
<div class="bg-white border border-gray-200 rounded-lg p-4 mb-6">
    <form method="GET" action="{{ route('cms.documents.index') }}" class="flex gap-3">
        <div class="flex-1">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari dokumen..." 
                class="w-full border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500">
        </div>
        <button type="submit" class="px-6 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition">
            Cari
        </button>
        @if(request('search'))
        <a href="{{ route('cms.documents.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
            Reset
        </a>
        @endif
    </form>
</div>

<!-- Documents Table -->
<div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dokumen</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ukuran</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Upload Oleh</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Terakhir Update</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($documents as $document)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 {{ $document->file_icon }} bg-opacity-10 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 {{ $document->file_icon }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">{{ $document->title }}</p>
                                <p class="text-xs text-gray-500">{{ $document->file_name }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-700">
                        {{ Str::limit($document->description ?? '-', 50) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $document->formatted_file_size }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                        {{ $document->user->name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $document->updated_at->format('d M Y H:i') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <div class="flex justify-center gap-2">
                            <!-- Download Button -->
                            <a href="{{ route('cms.documents.download', $document) }}" 
                               class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition" 
                               title="Download">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                            </a>
                            
                            <!-- Detail Button -->
                            <a href="{{ route('cms.documents.show', $document) }}" 
                               class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" 
                               title="Detail">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </a>
                            
                            @if(auth()->id() === $document->user_id || auth()->user()->isKetua())
                            <!-- Edit Button -->
                            <a href="{{ route('cms.documents.edit', $document) }}" 
                               class="p-2 text-teal-600 hover:bg-teal-50 rounded-lg transition" 
                               title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                            
                            <!-- Delete Button -->
                            <form action="{{ route('cms.documents.destroy', $document) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" 
                                        title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <p class="font-medium">Belum ada dokumen</p>
                        <p class="text-sm mt-1">Mulai upload dokumen Anda</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($documents->hasPages())
    <div class="bg-gray-50 px-4 py-3 border-t border-gray-200">
        {{ $documents->links() }}
    </div>
    @endif
</div>
@endsection
