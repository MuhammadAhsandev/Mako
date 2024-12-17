<?php
use Illuminate\Support\Facades\Auth;
?>
@extends('layouts.guru.app')
@section('content')
<div class="mt-4 max-w-4xl mx-auto p-6 bg-white shadow-sm rounded-lg">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Input Pelanggaran Siswa</h2>
        <a href="{{ route('guru.dashboard') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
            Kembali
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('guru.pelanggaran.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Pilih Siswa -->
        <div class="grid grid-cols-1 gap-4">
            <div>
                <label for="search_siswa" class="block font-medium text-gray-700 mb-2">Cari Siswa</label>
                <input type="text" 
                       id="search_siswa" 
                       class="w-full p-2 border rounded focus:ring-blue-500 focus:border-blue-500" 
                       placeholder="Masukkan nama siswa untuk mencari">
            </div>

            <div>
                <label for="siswa_id" class="block font-medium text-gray-700 mb-2">Nama Siswa <span class="text-red-500">*</span></label>
                <select name="siswa_id" 
                        id="siswa_id" 
                        class="w-full p-2 border rounded focus:ring-blue-500 focus:border-blue-500 @error('siswa_id') border-red-500 @enderror" 
                        required>
                    <option value="">-- Pilih Siswa --</option>
                    @foreach ($siswas as $siswa)
                        <option value="{{ $siswa->id }}" {{ old('siswa_id') == $siswa->id ? 'selected' : '' }}>
                            {{ $siswa->nama }} - {{ $siswa->NISN }}
                        </option>
                    @endforeach
                </select>
                @error('siswa_id')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- JavaScript untuk Pencarian Nama Siswa -->
        <script>
            document.getElementById('search_siswa').addEventListener('input', function () {
                const query = this.value.toLowerCase();
                const options = document.querySelectorAll('#siswa_id option');

                options.forEach(option => {
                    if (option.textContent.toLowerCase().includes(query)) {
                        option.style.display = 'block';
                        option.selected = true;
                    } else if (option.value !== '') {
                        option.style.display = 'none';
                    }
                });
            });
        </script>

        <!-- Detail Pelanggaran -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="pelanggaran" class="block font-medium text-gray-700 mb-2">Pelanggaran <span class="text-red-500">*</span></label>
                <input type="text" 
                       name="pelanggaran" 
                       id="pelanggaran" 
                       class="w-full p-2 border rounded focus:ring-blue-500 focus:border-blue-500 @error('pelanggaran') border-red-500 @enderror" 
                       value="{{ old('pelanggaran') }}" 
                       required>
                @error('pelanggaran')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="kategori" class="block font-medium text-gray-700 mb-2">Kategori Pelanggaran <span class="text-red-500">*</span></label>
                <input type="text" 
                       name="kategori" 
                       id="kategori" 
                       class="w-full p-2 border rounded focus:ring-blue-500 focus:border-blue-500 @error('kategori') border-red-500 @enderror" 
                       value="{{ old('Kategori') }}" 
                       required>
                @error('kategori')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="point" class="block font-medium text-gray-700 mb-2">Poin Pelanggaran</label>
                <input type="number" 
                       name="point" 
                       id="point" 
                       class="w-full p-2 border rounded focus:ring-blue-500 focus:border-blue-500 @error('point') border-red-500 @enderror" 
                       value="{{ old('point') }}">
                @error('point')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="tanggal_melanggar" class="block font-medium text-gray-700 mb-2">Tanggal Pelanggaran <span class="text-red-500">*</span></label>
                <input type="date" 
                       name="tanggal_melanggar" 
                       id="tanggal_melanggar" 
                       class="w-full p-2 border rounded focus:ring-blue-500 focus:border-blue-500 @error('tanggal_melanggar') border-red-500 @enderror" 
                       value="{{ old('tanggal_melanggar') }}" 
                       required>
                @error('tanggal_melanggar')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="input_data" class="block font-medium text-gray-700 mb-2">Diinput Oleh</label>
                <input type="text" 
                       name="input_data" 
                       id="input_data" 
                       class="w-full p-2 border border-gray-300 rounded bg-gray-100" 
                       value="{{ Auth::user()->name }}" 
                       readonly>
            </div>
        </div>

        <!-- Tombol Submit -->
        <div class="flex justify-end space-x-2">
            <button type="reset" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                Reset
            </button>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Simpan Pelanggaran
            </button>
        </div>
    </form>
</div>
@endsection
