@extends('cms.layouts.app')

@section('title', 'Rencana Kegiatan')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Rencana Kegiatan</h2>
            <p class="text-gray-600 mt-1">Kelola rencana kegiatan Karang Taruna</p>
        </div>
        <a href="{{ route('cms.activity-plans.create') }}" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Buat Rencana Baru
        </a>
    </div>

    <!-- Filters -->
    <div class="mb-6 bg-gray-50 p-4 rounded-lg border border-gray-100">
        <form action="{{ route('cms.activity-plans.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4">

            <div class="w-full sm:w-48">
                <select name="status" class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500">
                    <option value="">Semua Status</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Review</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>
            <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700 transition">
                Filter
            </button>
        </form>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b border-gray-200">
                    <th class="pb-3 font-semibold text-gray-600">Judul Kegiatan</th>
                    <th class="pb-3 font-semibold text-gray-600">Tanggal</th>
                    <th class="pb-3 font-semibold text-gray-600">Anggaran</th>
                    <th class="pb-3 font-semibold text-gray-600">Status</th>
                    <th class="pb-3 font-semibold text-gray-600 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($activityPlans as $plan)
                <tr class="hover:bg-gray-50 transition">
                    <td class="py-4">
                        <div class="font-medium text-gray-800">{{ $plan->title }}</div>
                        <div class="text-sm text-gray-500">{{ $plan->category->name }}</div>
                    </td>
                    <td class="py-4 text-gray-600">
                        {{ $plan->planned_date->format('d M Y') }}
                    </td>
                    <td class="py-4 text-gray-600">
                        Rp {{ number_format($plan->budget, 0, ',', '.') }}
                    </td>
                    <td class="py-4">
                        @php
                            $statusColors = [
                                'draft' => 'bg-gray-100 text-gray-700',
                                'pending' => 'bg-yellow-100 text-yellow-700',
                                'approved' => 'bg-green-100 text-green-700',
                                'rejected' => 'bg-red-100 text-red-700',
                            ];
                        @endphp
                        <span class="px-2 py-1 text-xs rounded-full font-medium {{ $statusColors[$plan->status] ?? 'bg-gray-100 text-gray-700' }}">
                            {{ ucfirst($plan->status) }}
                        </span>
                    </td>
                    <td class="py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('cms.activity-plans.edit', $plan) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                            <form action="{{ route('cms.activity-plans.destroy', $plan) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus rencana kegiatan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-8 text-center text-gray-500">
                        Belum ada rencana kegiatan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $activityPlans->links() }}
    </div>
</div>
@endsection
