@extends('cms.layouts.app')

@section('title', 'Upload Dokumentasi')

@section('content')
<div class="max-w-full mx-auto">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('cms.documentation.index') }}" class="p-2 bg-white rounded-lg border border-gray-200 hover:bg-gray-50 transition text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Upload Dokumentasi</h2>
            <p class="text-gray-600 mt-1">Unggah foto, video, atau dokumen kegiatan</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Preview Column -->
            <div class="w-full md:w-1/3">
                <div id="preview-container" class="bg-gray-100 rounded-lg overflow-hidden border border-gray-200 hover:border-teal-400 transition cursor-pointer relative" style="min-height: 400px;">
                    <div id="placeholder" class="flex flex-col items-center justify-center p-6 text-center" style="min-height: 400px;">
                        <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                        <p class="text-gray-600 font-medium mb-1">Klik atau drag & drop file</p>
                        <p class="text-xs text-gray-500">Maks. 10MB - JPG, PNG, MP4, PDF</p>
                    </div>
                    <img id="image-preview" class="hidden w-full h-auto object-cover" style="min-height: 400px;">
                    <div id="video-preview" class="hidden bg-gray-800 text-white" style="min-height: 400px;">
                        <div class="flex items-center justify-center h-full">
                            <span class="text-sm">Video Preview</span>
                        </div>
                    </div>
                    <div id="document-preview" class="hidden bg-gray-100 text-gray-500" style="min-height: 400px;">
                        <div class="flex items-center justify-center h-full">
                            <span class="text-sm">Dokumen Preview</span>
                        </div>
                    </div>
                </div>
                <div id="file-info" class="hidden mt-4 text-sm text-gray-500">
                    <p class="truncate" id="file-name"></p>
                    <p id="file-size"></p>
                </div>
            </div>

            <!-- Form Column -->
            <div class="w-full md:w-2/3">
                <form action="{{ route('cms.documentation.store') }}" method="POST" enctype="multipart/form-data" id="upload-form">
                    @csrf

                    <input type="file" name="file" id="file-input" class="hidden" required>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Judul Dokumentasi</label>
                        <input type="text" name="title" value="{{ old('title') }}" 
                            class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 @error('title') border-red-500 @enderror"
                            placeholder="Judul foto/dokumen..." required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tipe File</label>
                        <select name="type" id="type-select" class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 @error('type') border-red-500 @enderror" required>
                            <option value="photo" {{ old('type') == 'photo' ? 'selected' : '' }}>Foto</option>
                            <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>Video</option>
                            <option value="document" {{ old('type') == 'document' ? 'selected' : '' }}>Dokumen</option>
                        </select>
                        @error('type')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Terkait dengan Kegiatan (Opsional)</label>
                        <select name="activity_realization_id" class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 @error('activity_realization_id') border-red-500 @enderror">
                            <option value="">-- Tidak Ada / Umum --</option>
                            @foreach($realizations as $realization)
                                <option value="{{ $realization->id }}" {{ old('activity_realization_id') == $realization->id ? 'selected' : '' }}>
                                    {{ $realization->activityPlan->title }} ({{ $realization->actual_date->format('d M Y') }})
                                </option>
                            @endforeach
                        </select>
                        @error('activity_realization_id')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan (Opsional)</label>
                        <textarea name="description" rows="3" 
                            class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 @error('description') border-red-500 @enderror"
                            placeholder="Tambah keterangan...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-4 pt-4 border-t border-gray-100">
                        <a href="{{ route('cms.documentation.index') }}" class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition font-medium">Batal</a>
                        <button type="submit" class="px-6 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition font-medium">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const fileInput = document.getElementById('file-input');
    const previewContainer = document.getElementById('preview-container');
    const placeholder = document.getElementById('placeholder');
    const imagePreview = document.getElementById('image-preview');
    const videoPreview = document.getElementById('video-preview');
    const documentPreview = document.getElementById('document-preview');
    const fileInfo = document.getElementById('file-info');
    const fileName = document.getElementById('file-name');
    const fileSize = document.getElementById('file-size');

    // Click to upload
    previewContainer.addEventListener('click', () => {
        fileInput.click();
    });

    // Drag and drop
    previewContainer.addEventListener('dragover', (e) => {
        e.preventDefault();
        previewContainer.classList.add('border-teal-500', 'bg-teal-50');
    });

    previewContainer.addEventListener('dragleave', () => {
        previewContainer.classList.remove('border-teal-500', 'bg-teal-50');
    });

    previewContainer.addEventListener('drop', (e) => {
        e.preventDefault();
        previewContainer.classList.remove('border-teal-500', 'bg-teal-50');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            handleFileSelect(files[0]);
        }
    });

    // File input change
    fileInput.addEventListener('change', (e) => {
        if (e.target.files.length > 0) {
            handleFileSelect(e.target.files[0]);
        }
    });

    function handleFileSelect(file) {
        // Hide all previews
        placeholder.classList.add('hidden');
        imagePreview.classList.add('hidden');
        videoPreview.classList.add('hidden');
        documentPreview.classList.add('hidden');

        // Show file info
        fileInfo.classList.remove('hidden');
        fileName.textContent = 'File: ' + file.name;
        fileSize.textContent = 'Ukuran: ' + (file.size / 1024).toFixed(2) + ' KB';

        // Show appropriate preview based on file type
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = (e) => {
                imagePreview.src = e.target.result;
                imagePreview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        } else if (file.type.startsWith('video/')) {
            videoPreview.classList.remove('hidden');
        } else {
            documentPreview.classList.remove('hidden');
        }
    }
</script>
@endsection
