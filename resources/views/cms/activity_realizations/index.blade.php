@extends('cms.layouts.app')

@section('title', 'Realisasi Kegiatan')

@section('content')
<!-- Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Realisasi Kegiatan</h1>
        <p class="text-gray-600 mt-1">Laporan pelaksanaan kegiatan</p>
    </div>
    <a href="{{ route('cms.activity-realizations.create') }}" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
        </svg>
        Buat Laporan Realisasi
    </a>
</div>

<!-- Tabs -->
<div class="border-b border-gray-200 mb-6">
    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
        <a href="{{ route('cms.activity-realizations.index') }}" 
           class="@if(!request('status')) border-teal-500 text-teal-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
            Semua
            <span class="@if(!request('status')) bg-teal-100 text-teal-600 @else bg-gray-100 text-gray-600 @endif ml-2 py-0.5 px-2.5 rounded-full text-xs font-medium">
                {{ $realizations->total() }}
            </span>
        </a>
        <a href="{{ route('cms.activity-realizations.index', ['status' => 'sedang_berjalan']) }}" 
           class="@if(request('status') == 'sedang_berjalan') border-teal-500 text-teal-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
            Sedang Berjalan
            <span class="@if(request('status') == 'sedang_berjalan') bg-teal-100 text-teal-600 @else bg-gray-100 text-gray-600 @endif ml-2 py-0.5 px-2.5 rounded-full text-xs font-medium">
                {{ \App\Models\ActivityRealization::where('status', 'sedang_berjalan')->count() }}
            </span>
        </a>
        <a href="{{ route('cms.activity-realizations.index', ['status' => 'final']) }}" 
           class="@if(request('status') == 'final') border-teal-500 text-teal-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
            Final
            <span class="@if(request('status') == 'final') bg-teal-100 text-teal-600 @else bg-gray-100 text-gray-600 @endif ml-2 py-0.5 px-2.5 rounded-full text-xs font-medium">
                {{ \App\Models\ActivityRealization::where('status', 'final')->count() }}
            </span>
        </a>
        <a href="{{ route('cms.activity-realizations.index', ['status' => 'batal']) }}" 
           class="@if(request('status') == 'batal') border-teal-500 text-teal-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
            Batal
            <span class="@if(request('status') == 'batal') bg-teal-100 text-teal-600 @else bg-gray-100 text-gray-600 @endif ml-2 py-0.5 px-2.5 rounded-full text-xs font-medium">
                {{ \App\Models\ActivityRealization::where('status', 'batal')->count() }}
            </span>
        </a>
    </nav>
</div>

<!-- Cards List -->
<div class="space-y-4">
    @forelse($realizations as $realization)
    <div class="bg-white border border-gray-200 rounded-lg p-6 hover:border-teal-300 transition shadow-sm">
        <div class="flex gap-4">
            <!-- Content -->
            <div class="flex-1 min-w-0">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex-1">
                        <!-- Status Badge -->
                        @php
                            $statusConfig = [
                                'sedang_berjalan' => [
                                    'class' => 'bg-yellow-100 text-yellow-700',
                                    'label' => 'Sedang Berjalan'
                                ],
                                'final' => [
                                    'class' => 'bg-green-100 text-green-700',
                                    'label' => 'Final'
                                ],
                                'batal' => [
                                    'class' => 'bg-red-100 text-red-700',
                                    'label' => 'Batal'
                                ],
                            ];
                            $config = $statusConfig[$realization->status] ?? ['class' => 'bg-gray-100 text-gray-700', 'label' => $realization->status];
                        @endphp
                        <span class="inline-block px-2 py-1 text-xs rounded-full font-medium {{ $config['class'] }} mb-2">
                            {{ $config['label'] }}
                        </span>

                        <!-- Title & Category -->
                        <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $realization->activityPlan->title }}</h3>
                        <p class="text-sm text-gray-600 mb-2">{{ $realization->activityPlan->category->name }}</p>

                        <!-- Description -->
                        <p class="text-sm text-gray-700 line-clamp-2 mb-3">{{ $realization->report }}</p>

                        <!-- Meta Info -->
                        <div class="flex flex-wrap gap-4 text-xs text-gray-500">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ $realization->actual_date->format('d M Y') }}
                            </div>
                            @if($realization->actual_budget)
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                Rp {{ number_format($realization->actual_budget, 0, ',', '.') }}
                            </div>
                            @endif
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $realization->actual_location ?? $realization->activityPlan->location }}
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                {{ $realization->participants_count }} peserta
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-2">
                        <a href="{{ route('cms.activity-realizations.edit', $realization) }}" 
                           class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit
                        </a>
                        <button onclick="deleteRealization({{ $realization->id }})" 
                                class="inline-flex items-center px-3 py-2 border border-red-300 shadow-sm text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Hapus
                        </button>
                        <form id="delete-form-{{ $realization->id }}" 
                              action="{{ route('cms.activity-realizations.destroy', $realization) }}" 
                              method="POST" 
                              class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="text-center py-12">
        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
        </svg>
        <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada realisasi kegiatan</h3>
        <p class="mt-1 text-sm text-gray-500">Mulai dengan membuat laporan realisasi kegiatan pertama Anda.</p>
        <div class="mt-6">
            <a href="{{ route('cms.activity-realizations.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Realisasi Baru
            </a>
        </div>
    </div>
    @endforelse
</div>

<!-- Pagination -->
<div class="mt-6">
    {{ $realizations->links() }}
</div>

<script>
function deleteRealization(id) {
    Swal.fire({
        title: 'Perhatian!',
        html: 'Apakah Anda yakin ingin menghapus laporan realisasi kegiatan ini?<br><small class="text-gray-500">Data yang dihapus tidak dapat dikembalikan.</small>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Tidak',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>
@endsection
