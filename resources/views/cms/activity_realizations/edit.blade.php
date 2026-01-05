@extends('cms.layouts.app')

@section('title', 'Edit Laporan Realisasi')

@section('content')
<div class="max-w-full mx-auto">
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

        <form action="{{ route('cms.activity-realizations.update', $activityRealization) }}" method="POST" enctype="multipart/form-data">
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

            <!-- Attendance Section -->
            <div class="mb-6 p-6 bg-gray-50 rounded-lg border border-gray-300">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Daftar Hadir Peserta</h3>
                
                <!-- Add Participant -->
                <div class="flex gap-2 mb-4">
                    <input type="text" id="participant-name" placeholder="Nama Peserta" 
                           class="flex-1 rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500">
                    <button type="button" onclick="addParticipant()" 
                            class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Peserta
                    </button>
                </div>

                <!-- Participants Table -->
                <div class="overflow-x-auto bg-white rounded-lg border border-gray-300">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-100 border-b border-gray-300">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700">No</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700">Nama Peserta</th>
                                <th class="px-4 py-3 text-center font-semibold text-gray-700">Status Hadir</th>
                                <th class="px-4 py-3 text-center font-semibold text-gray-700">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="attendance-list" class="divide-y divide-gray-200">
                            <tr>
                                <td colspan="4" class="px-4 py-8 text-center text-gray-500">Belum ada peserta. Klik "Tambah Peserta" untuk menambahkan.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <!-- Hidden input for attendance data -->
                <input type="hidden" name="attendance_list" id="attendance-data">
                
                <!-- Summary -->
                <div class="mt-4 p-4 bg-blue-50 rounded-lg border border-blue-200">
                    <div class="flex gap-6 text-sm">
                        <div>
                            <span class="font-semibold text-blue-900">Total Peserta:</span>
                            <span class="text-blue-700" id="total-participants">0</span>
                        </div>
                        <div>
                            <span class="font-semibold text-green-900">Hadir:</span>
                            <span class="text-green-700" id="total-present">0</span>
                        </div>
                        <div>
                            <span class="font-semibold text-red-900">Tidak Hadir:</span>
                            <span class="text-red-700" id="total-absent">0</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Evidence Upload Section -->
            <div class="mb-6 p-6 bg-gray-50 rounded-lg border border-gray-300">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Bukti Dokumentasi Kegiatan</h3>
                
                <div class="mb-4">
                    <input type="file" name="evidence[]" id="evidence-upload" multiple accept="image/*" class="hidden">
                    <button type="button" onclick="document.getElementById('evidence-upload').click()"
                            class="px-4 py-3 bg-white border-2 border-dashed border-gray-300 rounded-lg hover:bg-gray-50 transition flex items-center gap-2 text-gray-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Upload Foto Dokumentasi
                    </button>
                    <p class="mt-2 text-sm text-gray-500">Upload multiple gambar (max 5MB per gambar)</p>
                </div>

                <div id="preview-container" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 mb-4"></div>

                @if(isset($activityRealization) && $activityRealization->documentation && $activityRealization->documentation->count() > 0)
                <div class="mt-6 pt-6 border-t border-gray-300">
                    <h4 class="font-medium text-gray-700 mb-3">Dokumentasi Tersimpan ({{ $activityRealization->documentation->count() }})</h4>
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                        @foreach($activityRealization->documentation as $doc)
                        <div class="relative group" id="evidence-{{ $doc->id }}">
                            <img src="{{ asset('storage/' . $doc->file_path) }}" alt="{{ $doc->title }}"
                                 class="w-full h-32 object-cover rounded-lg border border-gray-300">
                            <button type="button" onclick="deleteEvidence({{ $doc->id }})" 
                                    class="absolute top-2 right-2 bg-red-600 text-white p-1.5 rounded-lg opacity-0 group-hover:opacity-100 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <div class="flex justify-end gap-4 pt-4 border-t border-gray-100">
                <a href="{{ route('cms.activity-realizations.index') }}" class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition font-medium">Batal</a>
                <button type="submit" class="px-6 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition font-medium">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('evidence-upload').addEventListener('change', function(e) {
    const container = document.getElementById('preview-container');
    container.innerHTML = '';
    
    Array.from(e.target.files).forEach((file) => {
        const reader = new FileReader();
        reader.onload = function(event) {
            const div = document.createElement('div');
            div.className = 'relative';
            div.innerHTML = `
                <img src="${event.target.result}" class="w-full h-32 object-cover rounded-lg border border-gray-300">
                <div class="absolute bottom-1 left-1 right-1 bg-black/50 text-white text-xs p-1 rounded truncate">${file.name}</div>
            `;
            container.appendChild(div);
        };
        reader.readAsDataURL(file);
    });
});

// ===== Attendance Management =====
let attendanceList = [];

// Load existing attendance
function loadAttendance() {
    const existing = {!! json_encode($activityRealization->attendance_list ?? []) !!};
    attendanceList = Array.isArray(existing) ? existing : [];
    renderAttendance();
}

// Add participant
function addParticipant() {
    const input = document.getElementById('participant-name');
    const name = input.value.trim();
    
    if (!name) {
        Swal.fire('Perhatian!', 'Nama peserta tidak boleh kosong!', 'warning');
        return;
    }
    
    attendanceList.push({
        name: name,
        status: 'present'
    });
    
    input.value = '';
    input.focus();
    renderAttendance();
}

// Remove participant
function removeParticipant(index) {
    Swal.fire({
        title: 'Hapus Peserta?',
        text: `Hapus ${attendanceList[index].name} dari daftar?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            attendanceList.splice(index, 1);
            renderAttendance();
        }
    });
}

// Toggle attendance status
function toggleStatus(index) {
    attendanceList[index].status = attendanceList[index].status === 'present' ? 'absent' : 'present';
    renderAttendance();
}

// Render attendance table
function renderAttendance() {
    const tbody = document.getElementById('attendance-list');
    
    if (attendanceList.length === 0) {
        tbody.innerHTML = '<tr><td colspan="4" class="px-4 py-8 text-center text-gray-500">Belum ada peserta. Klik "Tambah Peserta" untuk menambahkan.</td></tr>';
    } else {
        let presentCount = 0;
        let absentCount = 0;
        let html = '';
        
        attendanceList.forEach((participant, index) => {
            if (participant.status === 'present') presentCount++;
            else absentCount++;
            
            const statusClass = participant.status === 'present' 
                ? 'bg-green-100 text-green-700 hover:bg-green-200' 
                : 'bg-red-100 text-red-700 hover:bg-red-200';
            const statusText = participant.status === 'present' ? 'Hadir' : 'Tidak Hadir';
            
            html += `
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">${index + 1}</td>
                    <td class="px-4 py-3 font-medium">${participant.name}</td>
                    <td class="px-4 py-3 text-center">
                        <button type="button" onclick="toggleStatus(${index})"
                                class="px-3 py-1 rounded text-sm font-medium transition ${statusClass}">
                            ${statusText}
                        </button>
                    </td>
                    <td class="px-4 py-3 text-center">
                        <button type="button" onclick="removeParticipant(${index})"
                                class="text-red-600 hover:text-red-800 p-1 rounded hover:bg-red-50 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </td>
                </tr>
            `;
        });
        
        tbody.innerHTML = html;
        
        // Update summary
        document.getElementById('total-participants').textContent = attendanceList.length;
        document.getElementById('total-present').textContent = presentCount;
        document.getElementById('total-absent').textContent = absentCount;
        
        // Auto-update participants_count with present count
        const participantsInput = document.querySelector('input[name="participants_count"]');
        if (participantsInput) {
            participantsInput.value = presentCount;
        }
    }
    
    // Update hidden input
    document.getElementById('attendance-data').value = JSON.stringify(attendanceList);
}

// Allow Enter key to add participant
document.addEventListener('DOMContentLoaded', function() {
    loadAttendance();
    
    const participantInput = document.getElementById('participant-name');
    if (participantInput) {
        participantInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                addParticipant();
            }
        });
    }
});

function deleteEvidence(id) {
    if (confirm('Hapus dokumentasi ini?')) {
        fetch(`/cms/documentation/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        }).then(response => response.json())
          .then(data => {
              document.getElementById('evidence-' + id).remove();
              Swal.fire('Berhasil!', 'Dokumentasi berhasil dihapus.', 'success');
          });
    }
}
</script>
@endsection
