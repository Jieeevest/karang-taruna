@extends('cms.layouts.app')

@section('title', 'Rencana Kegiatan')

@section('content')
<!-- Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Rencana Kegiatan</h2>
            <p class="text-gray-600 mt-1">Kelola rencana kegiatan Karang Taruna</p>
        </div>
        <a href="{{ route('cms.activity-plans.create') }}" class="px-4 py-2.5 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition flex items-center font-medium">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Rencana
        </a>
    </div>

    <!-- Tabs -->
    <div class="border-b border-gray-200 mb-6">
        <nav class="-mb-px flex space-x-8">
            <a href="{{ route('cms.activity-plans.index') }}" class="@if(!request('status')) border-teal-500 text-teal-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Semua Kegiatan
                <span class="ml-2 py-0.5 px-2.5 rounded-full text-xs @if(!request('status')) bg-teal-100 text-teal-600 @else bg-gray-100 text-gray-600 @endif">
                    {{ $activityPlans->total() }}
                </span>
            </a>
            <a href="{{ route('cms.activity-plans.index', ['status' => 'approved']) }}" class="@if(request('status') === 'approved') border-teal-500 text-teal-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Disetujui
                <span class="ml-2 py-0.5 px-2.5 rounded-full text-xs @if(request('status') === 'approved') bg-teal-100 text-teal-600 @else bg-gray-100 text-gray-600 @endif">
                    {{ \App\Models\ActivityPlan::where('status', 'approved')->count() }}
                </span>
            </a>
            <a href="{{ route('cms.activity-plans.index', ['status' => 'pending_review']) }}" class="@if(request('status') === 'pending_review') border-teal-500 text-teal-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Menunggu Review
                <span class="ml-2 py-0.5 px-2.5 rounded-full text-xs @if(request('status') === 'pending_review') bg-teal-100 text-teal-600 @else bg-gray-100 text-gray-600 @endif">
                    {{ \App\Models\ActivityPlan::where('status', 'pending_review')->count() }}
                </span>
            </a>
        </nav>
    </div>

    <!-- Cards List -->
    <div class="space-y-4">
        @forelse($activityPlans as $plan)
        <div class="bg-white border border-gray-200 rounded-lg p-6 hover:border-teal-300 transition shadow-sm">
            <div class="flex gap-4">
                <!-- Content -->
                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1">
                            <!-- Status Badge -->
                            @php
                                $statusConfig = [
                                    'draft' => ['label' => 'Draft', 'class' => 'bg-gray-100 text-gray-700'],
                                    'pending_review' => ['label' => 'Menunggu Review', 'class' => 'bg-yellow-100 text-yellow-700'],
                                    'approved' => ['label' => 'Disetujui', 'class' => 'bg-green-100 text-green-700'],
                                    'rejected' => ['label' => 'Ditolak', 'class' => 'bg-red-100 text-red-700'],
                                ];
                                $status = $statusConfig[$plan->status] ?? ['label' => ucfirst($plan->status), 'class' => 'bg-gray-100 text-gray-700'];
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $status['class'] }} mb-2">
                                {{ $status['label'] }}
                            </span>

                            <!-- Title & Category -->
                            <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $plan->title }}</h3>
                            <p class="text-sm text-gray-600 mb-2">{{ $plan->category->name }}</p>

                            <!-- Description -->
                            <p class="text-sm text-gray-700 line-clamp-2 mb-3">{{ $plan->description }}</p>

                            <!-- Meta Info -->
                            <div class="flex flex-wrap gap-4 text-xs text-gray-500">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $plan->planned_date->format('d M Y') }}
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    Rp {{ number_format($plan->budget, 0, ',', '.') }}
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ $plan->location }}
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center gap-2">
                            @if($plan->status === 'draft')
                            <!-- Submit for Review Button -->
                            <form action="{{ route('cms.activity-plans.submit-for-review', $plan) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="px-3 py-2 text-sm font-medium text-white bg-teal-600 border border-teal-600 rounded-lg hover:bg-teal-700 transition flex items-center">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Kirim untuk Review
                                </button>
                            </form>
                            @endif

                            @if($plan->status === 'pending_review' && auth()->user()->isKetua())
                            <!-- Approve Button -->
                            <button onclick="approvePlan({{ $plan->id }})" 
                                    onmouseover="this.style.backgroundColor='#15803d'" 
                                    onmouseout="this.style.backgroundColor='#16a34a'"
                                    style="background-color: #16a34a; color: white;"
                                    class="px-3 py-2 text-sm font-medium text-white border border-green-600 rounded-lg transition flex items-center">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Setujui
                            </button>

                            <!-- Reject Button -->
                            <button onclick="rejectPlan({{ $plan->id }}, '{{ $plan->title }}')" 
                                    onmouseover="this.style.backgroundColor='#b91c1c'" 
                                    onmouseout="this.style.backgroundColor='#dc2626'"
                                    style="background-color: #dc2626; color: white;"
                                    class="px-3 py-2 text-sm font-medium text-white border border-red-600 rounded-lg transition flex items-center">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Tolak
                            </button>

                            <form id="approve-form-{{ $plan->id }}" action="{{ route('cms.activity-plans.approve', $plan) }}" method="POST" class="hidden">
                                @csrf
                            </form>

                            <form id="reject-form-{{ $plan->id }}" action="{{ route('cms.activity-plans.reject', $plan) }}" method="POST" class="hidden">
                                @csrf
                                <input type="hidden" name="rejection_reason" id="rejection-reason-{{ $plan->id }}">
                            </form>
                            @endif
                            
                            <a href="{{ route('cms.activity-plans.edit', $plan) }}" class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition flex items-center">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit
                            </a>
                            <button type="button" onclick="openDeleteModal({{ $plan->id }}, '{{ $plan->title }}')" class="px-3 py-2 text-sm font-medium text-red-700 bg-white border border-red-300 rounded-lg hover:bg-red-50 transition flex items-center">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Delete
                            </button>
                            <form id="delete-form-{{ $plan->id }}" action="{{ route('cms.activity-plans.destroy', $plan) }}" method="POST" class="hidden">
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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada rencana kegiatan</h3>
            <p class="mt-1 text-sm text-gray-500">Mulai dengan membuat rencana kegiatan baru.</p>
            <div class="mt-6">
                <a href="{{ route('cms.activity-plans.create') }}" class="inline-flex items-center px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Rencana
                </a>
            </div>
        </div>
        @endforelse
    </div>

<!-- Pagination -->
<div class="mt-6">
    {{ $activityPlans->links() }}
</div>

<script>
function openDeleteModal(id, title) {
    Swal.fire({
        title: 'Perhatian!',
        html: `Apakah Anda yakin ingin menghapus rencana kegiatan ini?<br><strong>${title}</strong>`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}

function approvePlan(id) {
    Swal.fire({
        title: 'Setujui Rencana Kegiatan?',
        text: 'Rencana kegiatan akan disetujui dan realisasi akan dibuat otomatis.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#16a34a',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Setujui!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('approve-form-' + id).submit();
        }
    });
}

function rejectPlan(id, title) {
    Swal.fire({
        title: 'Tolak Rencana Kegiatan?',
        html: `<p class="mb-4">Anda akan menolak: <strong>${title}</strong></p>`,
        input: 'textarea',
        inputLabel: 'Alasan Penolakan',
        inputPlaceholder: 'Tuliskan alasan penolakan...',
        inputAttributes: {
            'aria-label': 'Alasan penolakan',
            'rows': 3
        },
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Tolak',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        inputValidator: (value) => {
            if (!value) {
                return 'Alasan penolakan harus diisi!'
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('rejection-reason-' + id).value = result.value;
            document.getElementById('reject-form-' + id).submit();
        }
    });
}
</script>
@endsection

