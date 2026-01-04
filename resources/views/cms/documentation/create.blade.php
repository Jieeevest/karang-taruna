@extends('cms.layouts.app')

@section('title', 'Upload Dokumentasi')

@section('content')
<div class="max-w-4xl mx-auto">
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
        <form action="{{ route('cms.documentation.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Judul Dokumentasi</label>
                    <input type="text" name="title" value="{{ old('title') }}" 
                        class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 @error('title') border-red-500 @enderror"
                        placeholder="Judul foto/dokumen..." required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tipe File</label>
                    <select name="type" class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 @error('type') border-red-500 @enderror" required>
                        <option value="photo" {{ old('type') == 'photo' ? 'selected' : '' }}>Foto</option>
                        <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>Video</option>
                        <option value="document" {{ old('type') == 'document' ? 'selected' : '' }}>Dokumen</option>
                    </select>
                    @error('type')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pilih File</label>
                    <input type="file" name="file" 
                        class="w-full rounded-lg border border-gray-300 focus:border-teal-500 focus:ring-teal-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100 @error('file') border-red-500 @enderror"
                        required>
                    <p class="text-xs text-gray-500 mt-1">Maksimal 10MB. Format: JPG, PNG, MP4, PDF, DOCX.</p>
                    @error('file')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-2">
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
@endsection
