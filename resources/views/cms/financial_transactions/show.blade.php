@extends('cms.layouts.app')

@section('title', 'Detail Transaksi Keuangan')

@section('content')
<div class="max-w-3xl">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Detail Transaksi Keuangan</h1>
            <p class="text-gray-600 mt-1">Informasi lengkap transaksi</p>
        </div>
        <a href="{{ route('cms.financial-transactions.index') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
            Kembali
        </a>
    </div>

    <!-- Transaction Details -->
    <div class="bg-white border border-gray-200 rounded-lg p-6 mb-6">
        <div class="grid grid-cols-1 gap-6">
            <!-- Type Badge -->
            <div>
                @if($financialTransaction->type === 'income')
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-700">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd"></path>
                    </svg>
                    Pemasukan
                </span>
                @else
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-700">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd"></path>
                    </svg>
                    Pengeluaran
                </span>
                @endif
            </div>

            <!-- Amount -->
            <div class="border-l-4 {{ $financialTransaction->type === 'income' ? 'border-green-500' : 'border-red-500' }} pl-4">
                <p class="text-sm text-gray-600 mb-1">Jumlah</p>
                <p class="text-3xl font-bold {{ $financialTransaction->type === 'income' ? 'text-green-700' : 'text-red-700' }}">
                    {{ $financialTransaction->type === 'income' ? '+' : '-' }} Rp {{ number_format($financialTransaction->amount, 0, ',', '.') }}
                </p>
            </div>

            <!-- Transaction Info -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Tanggal Transaksi</p>
                    <p class="text-base font-medium text-gray-900">{{ $financialTransaction->transaction_date->format('d F Y') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-1">Kategori</p>
                    <p class="text-base font-medium text-gray-900">{{ $financialTransaction->category }}</p>
                </div>
            </div>

            <!-- Description -->
            <div>
                <p class="text-sm text-gray-600 mb-1">Deskripsi</p>
                <p class="text-base text-gray-900">{{ $financialTransaction->description }}</p>
            </div>

            <!-- Notes -->
            @if($financialTransaction->notes)
            <div>
                <p class="text-sm text-gray-600 mb-1">Catatan Tambahan</p>
                <p class="text-base text-gray-700">{{ $financialTransaction->notes }}</p>
            </div>
            @endif

            <!-- Evidence File -->
            @if($financialTransaction->evidence_file)
            <div>
                <p class="text-sm text-gray-600 mb-2">File Bukti</p>
                <a href="{{ asset('storage/' . $financialTransaction->evidence_file) }}" target="_blank" 
                   class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13l-3 3m0 0l-3-3m3 3V8m0 13a9 9 0 110-18 9 9 0 010 18z"></path>
                    </svg>
                    Lihat File Bukti
                </a>
            </div>
            @endif

            <!-- Created By -->
            <div class="pt-4 border-t border-gray-200">
                <p class="text-sm text-gray-600 mb-1">Dibuat Oleh</p>
                <p class="text-base font-medium text-gray-900">{{ $financialTransaction->user->name }}</p>
                <p class="text-sm text-gray-600">{{ $financialTransaction->created_at->format('d F Y, H:i') }}</p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-3 mt-6 pt-6 border-t border-gray-200">
            <a href="{{ route('cms.financial-transactions.edit', $financialTransaction) }}" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition">
                Edit Transaksi
            </a>
            <form action="{{ route('cms.financial-transactions.destroy', $financialTransaction) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                    Hapus Transaksi
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
