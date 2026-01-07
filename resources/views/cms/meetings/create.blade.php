@extends('cms.layouts.app')

@section('title', 'Tambah Rapat')

@section('content')
<!-- Header -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Tambah Rapat Koordinasi</h1>
        <p class="text-gray-600 mt-1">Buat jadwal rapat baru</p>
    </div>

    <!-- Form -->
    <div class="bg-white border border-gray-200 rounded-lg p-6">
        <form action="{{ route('cms.meetings.store') }}" method="POST">
            @csrf

            <div class="space-y-6">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Rapat *</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                        placeholder="Rapat Koordinasi Bulanan"
                        class="w-full border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500 @error('title') border-red-500 @enderror">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Meeting Date & Time -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="meeting_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Rapat *</label>
                        <input type="date" name="meeting_date" id="meeting_date" value="{{ old('meeting_date') }}" required
                            class="w-full border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500 @error('meeting_date') border-red-500 @enderror">
                        @error('meeting_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="meeting_time" class="block text-sm font-medium text-gray-700 mb-2">Waktu Rapat *</label>
                        <input type="time" name="meeting_time" id="meeting_time" value="{{ old('meeting_time') }}" required
                            class="w-full border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500 @error('meeting_time') border-red-500 @enderror">
                        @error('meeting_time')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Location -->
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Lokasi *</label>
                    <input type="text" name="location" id="location" value="{{ old('location') }}" required
                        placeholder="Sekretariat Karang Taruna"
                        class="w-full border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500 @error('location') border-red-500 @enderror">
                    @error('location')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Agenda -->
                <div>
                    <label for="agenda" class="block text-sm font-medium text-gray-700 mb-2">Agenda Rapat *</label>
                    <textarea name="agenda" id="agenda" rows="6" required
                        placeholder="1. Pembukaan&#10;2. Laporan kegiatan bulan lalu&#10;3. Pembahasan rencana kegiatan&#10;4. Penutup"
                        class="w-full border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500 @error('agenda') border-red-500 @enderror">{{ old('agenda') }}</textarea>
                    @error('agenda')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Notes -->
                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Catatan</label>
                    <textarea name="notes" id="notes" rows="3"
                        placeholder="Catatan tambahan atau hasil rapat (opsional)..."
                        class="w-full border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500 @error('notes') border-red-500 @enderror">{{ old('notes') }}</textarea>
                    @error('notes')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                    <select name="status" id="status" required
                        class="w-full border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500 @error('status') border-red-500 @enderror">
                        <option value="scheduled" {{ old('status') === 'scheduled' ? 'selected' : '' }}>Terjadwal</option>
                        <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Selesai</option>
                        <option value="cancelled" {{ old('status') === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('cms.meetings.index') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition">
                    Simpan Rapat
                </button>
            </div>
        </form>
    </div>
@endsection
