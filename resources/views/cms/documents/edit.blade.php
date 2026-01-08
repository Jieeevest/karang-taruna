@extends('cms.layouts.app')

@section('title', 'Edit Dokumen')

@section('content')
<!-- Header -->
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Edit Dokumen</h1>
    <p class="text-gray-600 mt-1">Perbarui informasi dokumen</p>
</div>

<!-- Form -->
<div class="bg-white border border-gray-200 rounded-lg p-6">
    <form action="{{ route('cms.documents.update', $document) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div class="mb-6">
            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Dokumen *</label>
            <input type="text" name="title" id="title" value="{{ old('title', $document->title) }}" required
                class="w-full border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500 @error('title') border-red-500 @enderror">
            @error('title')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description -->
        <div class="mb-6">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
            <textarea name="description" id="description" rows="4"
                class="w-full border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500 @error('description') border-red-500 @enderror">{{ old('description', $document->description) }}</textarea>
            @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Current File Info -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">File Saat Ini</label>
            <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-lg border border-gray-200">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 {{ $document->file_icon }} bg-opacity-10 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 {{ $document->file_icon }}" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-900">{{ $document->file_name }}</p>
                    <p class="text-xs text-gray-500">{{ $document->formatted_file_size }}</p>
                </div>
                <a href="{{ route('cms.documents.download', $document) }}" class="px-3 py-1.5 text-sm bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition">
                    Download
                </a>
            </div>
        </div>

        <!-- Replace File (Optional) -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Ganti File (Opsional)</label>
            
            <!-- Upload Area -->
            <div id="uploadArea" class="relative border-2 border-gray-300 rounded-lg p-8 text-center hover:border-teal-500 transition-all cursor-pointer bg-gray-50 hover:bg-teal-50 shadow-sm">
                <input type="file" name="file" id="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.zip,.rar" class="hidden">
                
                <!-- Upload Icon & Text -->
                <div id="uploadPrompt">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    <p class="text-sm font-medium text-gray-700 mb-1">Klik untuk upload file baru atau drag & drop</p>
                    <p class="text-xs text-gray-500">PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, TXT, ZIP, RAR (Maksimal 10MB)</p>
                </div>

                <!-- Preview Area (Hidden by default) -->
                <div id="previewArea" class="hidden">
                    <div class="flex items-center justify-center gap-3">
                        <div class="flex-shrink-0">
                            <div id="fileIcon" class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-teal-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 text-left ml-3">
                            <p id="fileName" class="text-sm font-medium text-gray-900"></p>
                            <p id="fileSize" class="text-xs text-gray-500"></p>
                        </div>
                        <button type="button" id="removeFile" class="flex-shrink-0 p-2 text-red-600 hover:bg-red-50 rounded-lg transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            @error('file')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const uploadArea = document.getElementById('uploadArea');
                const fileInput = document.getElementById('file');
                const uploadPrompt = document.getElementById('uploadPrompt');
                const previewArea = document.getElementById('previewArea');
                const fileName = document.getElementById('fileName');
                const fileSize = document.getElementById('fileSize');
                const removeFile = document.getElementById('removeFile');

                uploadArea.addEventListener('click', function(e) {
                    if (e.target.id !== 'removeFile' && !e.target.closest('#removeFile')) {
                        fileInput.click();
                    }
                });

                uploadArea.addEventListener('dragover', function(e) {
                    e.preventDefault();
                    uploadArea.classList.add('border-teal-500', 'bg-teal-50');
                });

                uploadArea.addEventListener('dragleave', function(e) {
                    e.preventDefault();
                    uploadArea.classList.remove('border-teal-500', 'bg-teal-50');
                });

                uploadArea.addEventListener('drop', function(e) {
                    e.preventDefault();
                    uploadArea.classList.remove('border-teal-500', 'bg-teal-50');
                    
                    const files = e.dataTransfer.files;
                    if (files.length > 0) {
                        fileInput.files = files;
                        handleFileSelect(files[0]);
                    }
                });

                fileInput.addEventListener('change', function(e) {
                    if (e.target.files.length > 0) {
                        handleFileSelect(e.target.files[0]);
                    }
                });

                removeFile.addEventListener('click', function(e) {
                    e.stopPropagation();
                    fileInput.value = '';
                    uploadPrompt.classList.remove('hidden');
                    previewArea.classList.add('hidden');
                });

                function handleFileSelect(file) {
                    fileName.textContent = file.name;
                    fileSize.textContent = formatFileSize(file.size);
                    uploadPrompt.classList.add('hidden');
                    previewArea.classList.remove('hidden');
                }

                function formatFileSize(bytes) {
                    if (bytes === 0) return '0 Bytes';
                    const k = 1024;
                    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                    const i = Math.floor(Math.log(bytes) / Math.log(k));
                    return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
                }
            });
        </script>

        <!-- Action Buttons -->
        <div class="flex justify-end gap-6 mt-8 pt-6 border-t border-gray-200">
            <a href="{{ route('cms.documents.index') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                Batal
            </a>
            <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition">
                Update Dokumen
            </button>
        </div>
    </form>
</div>
@endsection
