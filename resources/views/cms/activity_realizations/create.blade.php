@extends('cms.layouts.app')

@section('title', 'Buat Laporan Realisasi')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('cms.activity-realizations.index') }}" class="p-2 bg-white rounded-lg border border-gray-200 hover:bg-gray-50 transition text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Buat Laporan Realisasi</h2>
            <p class="text-gray-600 mt-1">Laporkan pelaksanaan kegiatan dari rencana yang telah disetujui</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        @if($plans->isEmpty())
            <div class="text-center py-8">
                <div class="text-yellow-500 mb-2">
                    <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900">Tidak Ada Rencana Tersedia</h3>
                <p class="text-gray-500 mt-1">Semua rencana kegiatan yang disetujui sudah memiliki laporan realisasi, atau belum ada rencana yang disetujui.</p>
                <a href="{{ route('cms.activity-plans.create') }}" class="inline-block mt-4 px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition">
                    Buat Rencana Baru
                </a>
            </div>
        @else
        <form action="{{ route('cms.activity-realizations.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Kegiatan</label>
                    <select name="activity_plan_id" class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 @error('activity_plan_id') border-red-500 @enderror" required>
                        <option value="">-- Pilih Rencana Kegiatan --</option>
                        @foreach($plans as $plan)
                            <option value="{{ $plan->id }}" {{ old('activity_plan_id') == $plan->id ? 'selected' : '' }}>
                                {{ $plan->title }} ({{ $plan->planned_date->format('d M Y') }})
                            </option>
                        @endforeach
                    </select>
                    @error('activity_plan_id')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pelaksanaan Aktual</label>
                    <input type="date" name="actual_date" value="{{ old('actual_date') }}" 
                        class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 @error('actual_date') border-red-500 @enderror" required>
                    @error('actual_date')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Peserta</label>
                    <input type="number" name="participants_count" value="{{ old('participants_count') }}" 
                        class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 @error('participants_count') border-red-500 @enderror"
                        placeholder="0" required min="0">
                    @error('participants_count')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi Aktual</label>
                    <input type="text" name="actual_location" value="{{ old('actual_location') }}" 
                        class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 @error('actual_location') border-red-500 @enderror"
                        placeholder="Lokasi kegiatan dilaksanakan">
                    @error('actual_location')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Anggaran Terpakai (Rp)</label>
                    <input type="number" name="actual_budget" value="{{ old('actual_budget') }}" 
                        class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 @error('actual_budget') border-red-500 @enderror"
                        placeholder="0" min="0">
                    @error('actual_budget')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Laporan Pelaksanaan</label>
                <textarea name="report" rows="6" 
                    class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 @error('report') border-red-500 @enderror"
                    placeholder="Ceritakan jalannya kegiatan secara detail..." required>{{ old('report') }}</textarea>
                @error('report')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pencapaian</label>
                    <textarea name="achievements" rows="4" 
                        class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 @error('achievements') border-red-500 @enderror"
                        placeholder="Apa saja yang berhasil dicapai?">{{ old('achievements') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kendala / Hambatan</label>
                    <textarea name="obstacles" rows="4" 
                        class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 @error('obstacles') border-red-500 @enderror"
                        placeholder="Kendala yang dihadapi selama kegiatan?">{{ old('obstacles') }}</textarea>
                </div>
            </div>

            <div class="flex justify-end gap-4 pt-4 border-t border-gray-100">
                <a href="{{ route('cms.activity-realizations.index') }}" class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition font-medium">Batal</a>
                <button type="submit" class="px-6 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition font-medium">Simpan Laporan</button>
            </div>
        </form>
        @endif
    </div>
</div>
@endsection
