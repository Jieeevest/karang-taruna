@extends('cms.layouts.app')

@section('title', 'Edit Dokumentasi')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('cms.documentation.index') }}" class="p-2 bg-white rounded-lg border border-gray-200 hover:bg-gray-50 transition text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Edit Dokumentasi</h2>
            <p class="text-gray-600 mt-1">Perbarui informasi file</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex flex-col md:flex-row gap-8">
            <div class="w-full md:w-1/3">
                <div class="bg-gray-100 rounded-lg overflow-hidden border border-gray-200">
                    @if($documentation->type == 'photo')
                        <img src="{{ Storage::url($documentation->file_path) }}" class="w-full h-auto">
                    @elseif($documentation->type == 'video')
                        <div class="flex items-center justify-center h-48 bg-gray-800 text-white">
                            <span class="text-sm">Video Preview</span>
                        </div>
                    @else
                        <div class="flex items-center justify-center h-48 bg-gray-100 text-gray-500">
                            <span class="text-sm">Dokumen Preview</span>
                        </div>
                    @endif
                </div>
                <div class="mt-4 text-sm text-gray-500">
                    <p class="truncate">File: {{ $documentation->file_name }}</p>
                    <p>Ukuran: {{ round($documentation->file_size / 1024, 2) }} KB</p>
                </div>
            </div>

            <div class="w-full md:w-2/3">
                <form action="{{ route('cms.documentation.update', $documentation) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Judul Dokumentasi</label>
                        <input type="text" name="title" value="{{ old('title', $documentation->title) }}" 
                            class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 @error('title') border-red-500 @enderror"
                            required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tipe File</label>
                        <select name="type" class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 @error('type') border-red-500 @enderror" required>
                            <option value="photo" {{ old('type', $documentation->type) == 'photo' ? 'selected' : '' }}>Foto</option>
                            <option value="video" {{ old('type', $documentation->type) == 'video' ? 'selected' : '' }}>Video</option>
                            <option value="document" {{ old('type', $documentation->type) == 'document' ? 'selected' : '' }}>Dokumen</option>
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
                                <option value="{{ $realization->id }}" {{ old('activity_realization_id', $documentation->activity_realization_id) == $realization->id ? 'selected' : '' }}>
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
                            class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 @error('description') border-red-500 @enderror">{{ old('description', $documentation->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-4 pt-4 border-t border-gray-100">
                        <a href="{{ route('cms.documentation.index') }}" class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition font-medium">Batal</a>
                        <button type="submit" class="px-6 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition font-medium">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
