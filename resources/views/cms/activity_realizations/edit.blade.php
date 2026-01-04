@extends('cms.layouts.app')

@section('title', 'Edit Laporan Realisasi')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('cms.activity-realizations.index') }}" class="p-2 bg-white rounded-lg border border-gray-200 hover:bg-gray-50 transition text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Edit Laporan Realisasi</h2>
            <p class="text-gray-600 mt-1">Perbarui laporan pelaksanaan kegiatan</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="mb-6 p-4 bg-gray-50 rounded-lg border border-gray-100">
            <h3 class="font-semibold text-gray-700 mb-1">{{ $activityRealization->activityPlan->title }}</h3>
            <p class="text-sm text-gray-600">
                Rencana: {{ $activityRealization->activityPlan->planned_date->format('d M Y') }} | 
                Anggaran Rencana: Rp {{ number_format($activityRealization->activityPlan->budget, 0, ',', '.') }}
            </p>
        </div>

        <form action="{{ route('cms.activity-realizations.update', $activityRealization) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pelaksanaan Aktual</label>
                    <input type="date" name="actual_date" value="{{ old('actual_date', $activityRealization->actual_date->format('Y-m-d')) }}" 
                        class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 @error('actual_date') border-red-500 @enderror" required>
                    @error('actual_date')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Peserta</label>
                    <input type="number" name="participants_count" value="{{ old('participants_count', $activityRealization->participants_count) }}" 
                        class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 @error('participants_count') border-red-500 @enderror"
                        required min="0">
                    @error('participants_count')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi Aktual</label>
                    <input type="text" name="actual_location" value="{{ old('actual_location', $activityRealization->actual_location) }}" 
                        class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 @error('actual_location') border-red-500 @enderror">
                    @error('actual_location')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Anggaran Terpakai (Rp)</label>
                    <input type="number" name="actual_budget" value="{{ old('actual_budget', $activityRealization->actual_budget) }}" 
                        class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 @error('actual_budget') border-red-500 @enderror"
                        min="0">
                    @error('actual_budget')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 @error('status') border-red-500 @enderror" required>
                        <option value="draft" {{ old('status', $activityRealization->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="submitted" {{ old('status', $activityRealization->status) == 'submitted' ? 'selected' : '' }}>Diajukan</option>
                        @if(auth()->user()->isKetua() || auth()->user()->isAdmin())
                            <option value="verified" {{ old('status', $activityRealization->status) == 'verified' ? 'selected' : '' }}>Terverifikasi</option>
                            <option value="rejected" {{ old('status', $activityRealization->status) == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        @endif
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Laporan Pelaksanaan</label>
                <textarea name="report" rows="6" 
                    class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 @error('report') border-red-500 @enderror"
                    required>{{ old('report', $activityRealization->report) }}</textarea>
                @error('report')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pencapaian</label>
                    <textarea name="achievements" rows="4" 
                        class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 @error('achievements') border-red-500 @enderror">{{ old('achievements', $activityRealization->achievements) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kendala / Hambatan</label>
                    <textarea name="obstacles" rows="4" 
                        class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 @error('obstacles') border-red-500 @enderror">{{ old('obstacles', $activityRealization->obstacles) }}</textarea>
                </div>
            </div>

            <div class="flex justify-end gap-4 pt-4 border-t border-gray-100">
                <a href="{{ route('cms.activity-realizations.index') }}" class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition font-medium">Batal</a>
                <button type="submit" class="px-6 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition font-medium">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
