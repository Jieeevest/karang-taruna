@extends('cms.layouts.app')

@section('title', 'Edit Rencana Kegiatan')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('cms.activity-plans.index') }}" class="p-2 bg-white rounded-lg border border-gray-200 hover:bg-gray-50 transition text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Edit Rencana Kegiatan</h2>
            <p class="text-gray-600 mt-1">Perbarui informasi rencana kegiatan</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <form action="{{ route('cms.activity-plans.update', $activityPlan) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Judul Kegiatan</label>
                    <input type="text" name="title" value="{{ old('title', $activityPlan->title) }}" 
                        class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 @error('title') border-red-500 @enderror"
                        required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                    <select name="category_id" class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 @error('category_id') border-red-500 @enderror" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $activityPlan->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pelaksanaan</label>
                    <input type="date" name="planned_date" value="{{ old('planned_date', $activityPlan->planned_date->format('Y-m-d')) }}" 
                        class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 @error('planned_date') border-red-500 @enderror" required>
                    @error('planned_date')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi</label>
                    <input type="text" name="location" value="{{ old('location', $activityPlan->location) }}" 
                        class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 @error('location') border-red-500 @enderror"
                        required>
                    @error('location')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Anggaran (Rp)</label>
                    <input type="number" name="budget" value="{{ old('budget', $activityPlan->budget) }}" 
                        class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 @error('budget') border-red-500 @enderror"
                        required min="0">
                    @error('budget')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 @error('status') border-red-500 @enderror" required>
                        <option value="draft" {{ old('status', $activityPlan->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="pending" {{ old('status', $activityPlan->status) == 'pending' ? 'selected' : '' }}>Menunggu Review</option>
                        @if(auth()->user()->isKetua() || auth()->user()->isAdmin())
                            <option value="approved" {{ old('status', $activityPlan->status) == 'approved' ? 'selected' : '' }}>Disetujui</option>
                            <option value="rejected" {{ old('status', $activityPlan->status) == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        @endif
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Kegiatan</label>
                <textarea name="description" rows="4" 
                    class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 @error('description') border-red-500 @enderror"
                    required>{{ old('description', $activityPlan->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Tujuan Kegiatan (Opsional)</label>
                <textarea name="objectives" rows="3" 
                    class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 @error('objectives') border-red-500 @enderror">{{ old('objectives', $activityPlan->objectives) }}</textarea>
                @error('objectives')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            @if(auth()->user()->isKetua() || auth()->user()->isAdmin())
            <div id="rejection_reason_container" class="mb-6 {{ old('status', $activityPlan->status) == 'rejected' ? '' : 'hidden' }}">
                <label class="block text-sm font-medium text-red-700 mb-2">Alasan Penolakan</label>
                <textarea name="rejection_reason" rows="3" 
                    class="w-full rounded-lg border-red-300 focus:border-red-500 focus:ring-red-500 bg-red-50"
                    placeholder="Jelaskan alasan penolakan...">{{ old('rejection_reason', $activityPlan->rejection_reason) }}</textarea>
            </div>
            @endif

            <div class="flex justify-end gap-4 pt-4 border-t border-gray-100">
                <a href="{{ route('cms.activity-plans.index') }}" class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition font-medium">Batal</a>
                <button type="submit" class="px-6 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition font-medium">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusSelect = document.querySelector('select[name="status"]');
    const rejectionContainer = document.getElementById('rejection_reason_container');

    if (statusSelect && rejectionContainer) {
        statusSelect.addEventListener('change', function() {
            if (this.value === 'rejected') {
                rejectionContainer.classList.remove('hidden');
            } else {
                rejectionContainer.classList.add('hidden');
            }
        });
    }
});
</script>
@endsection
