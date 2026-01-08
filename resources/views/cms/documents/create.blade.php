@extends('cms.layouts.app')

@section('title', 'Upload Dokumen')

@section('content')
<!-- Header -->
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Upload Dokumen</h1>
    <p class="text-gray-600 mt-1">Upload dokumen baru ke repository</p>
</div>

<!-- Form -->
<div class="bg-white border border-gray-200 rounded-lg p-6">
    <form action="{{ route('cms.documents.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Title -->
        <div class="mb-6">
            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Dokumen *</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required
                class="w-full border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500 @error('title') border-red-500 @enderror">
            @error('title')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description -->
        <div class="mb-6">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
            <textarea name="description" id="description" rows="4"
                class="w-full border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
            @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- File Upload -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">File Dokumen *</label>
            
            <!-- Upload Area -->
            <div id="uploadArea" class="relative border-2 border-gray-300 rounded-lg p-8 text-center hover:border-teal-500 transition-all cursor-pointer bg-gray-50 hover:bg-teal-50 shadow-sm">
                <input type="file" name="file" id="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.zip,.rar" class="hidden" required>
                
                <!-- Upload Icon & Text -->
                <div id="uploadPrompt">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    <p class="text-sm font-medium text-gray-700 mb-1">Klik untuk upload atau drag & drop</p>
                    <p class="text-xs text-gray-500">PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, TXT, ZIP, RAR (Maksimal 10MB)</p>
                </div>

                <!-- Preview Area (Hidden by default) -->
                <div id="previewArea" class="hidden">
                    <div class="flex items-center justify-center gap-3">
                        <!-- File Icon -->
                        <div class="flex-shrink-0">
                            <div id="fileIcon" class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-teal-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                        
                        <!-- File Info -->
                        <div class="flex-1 text-left">
                            <p id="fileName" class="text-sm font-medium text-gray-900"></p>
                            <p id="fileSize" class="text-xs text-gray-500"></p>
                        </div>

                        <!-- Remove Button -->
                        <button type="button" id="removeFile" class="flex-shrink-0 p-2 text-red-600 hover:bg-red-50 rounded-lg transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
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

                // Click to upload
                uploadArea.addEventListener('click', function(e) {
                    if (e.target.id !== 'removeFile' && !e.target.closest('#removeFile')) {
                        fileInput.click();
                    }
                });

                // Drag and drop
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

                // File input change
                fileInput.addEventListener('change', function(e) {
                    if (e.target.files.length > 0) {
                        handleFileSelect(e.target.files[0]);
                    }
                });

                // Remove file
                removeFile.addEventListener('click', function(e) {
                    e.stopPropagation();
                    fileInput.value = '';
                    uploadPrompt.classList.remove('hidden');
                    previewArea.classList.add('hidden');
                });

                function handleFileSelect(file) {
                    // Update file info
                    fileName.textContent = file.name;
                    fileSize.textContent = formatFileSize(file.size);

                    // Show preview area
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
        <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-gray-200">
            <a href="{{ route('cms.documents.index') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                Batal
            </a>
            <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition">
                Upload Dokumen
            </button>
        </div>
    </form>
</div>
@endsection
