<?php
use Illuminate\Support\Facades\Auth;
?>
@extends('layouts.guru.app')
@section('content')
<div class="mt-4 max-w-4xl mx-auto p-6 bg-white shadow-sm rounded-lg">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Input Prestasi Siswa</h2>
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

    <form action="{{ route('guru.prestasi.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Pilih Siswa -->
        <div class="grid grid-cols-1 gap-4">
            <div>
                <label for="siswa_id" class="block font-medium text-gray-700 mb-2">Nama Siswa <span class="text-red-500">*</span></label>
                <select name="siswa_id"
                        id="siswa_id"
                        class="w-full p-2 borderrounded focus:ring-blue-500 focus:border-blue-500 @error('siswa_id') border-red-500 @enderror"
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

        <!-- Detail Prestasi -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="nama_prestasi" class="block font-medium text-gray-700 mb-2">Nama Prestasi <span class="text-red-500">*</span></label>
                <input type="text"
                       name="nama_prestasi"
                       id="nama_prestasi"
                       class="w-full p-2 border  rounded focus:ring-blue-500 focus:border-blue-500 @error('nama_prestasi') border-red-500 @enderror"
                       value="{{ old('nama_prestasi') }}"
                       required>
                @error('nama_prestasi')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="lv_prestasi" class="block font-medium text-gray-700 mb-2">Level Prestasi <span class="text-red-500">*</span></label>
                <select name="lv_prestasi"
                        id="lv_prestasi"
                        class="w-full p-2 border  rounded focus:ring-blue-500 focus:border-blue-500 @error('lv_prestasi') border-red-500 @enderror"
                        required>
                    <option value="">-- Pilih Level --</option>
                    <option value="Sekolah" {{ old('lv_prestasi') == 'Sekolah' ? 'selected' : '' }}>Sekolah</option>
                    <option value="Kecamatan" {{ old('lv_prestasi') == 'Kecamatan' ? 'selected' : '' }}>Kecamatan</option>
                    <option value="Kabupaten" {{ old('lv_prestasi') == 'Kabupaten' ? 'selected' : '' }}>Kabupaten</option>
                    <option value="Provinsi" {{ old('lv_prestasi') == 'Provinsi' ? 'selected' : '' }}>Provinsi</option>
                    <option value="Nasional" {{ old('lv_prestasi') == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                    <option value="Internasional" {{ old('lv_prestasi') == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                </select>
                @error('lv_prestasi')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="tanggal_prestasi" class="block font-medium text-gray-700 mb-2">Tanggal Prestasi <span class="text-red-500">*</span></label>
                <input type="date"
                       name="tanggal_prestasi"
                       id="tanggal_prestasi"
                       class="w-full p-2 border rounded focus:ring-blue-500 focus:border-blue-500 @error('tanggal_prestasi') border-red-500 @enderror"
                       value="{{ old('tanggal_prestasi') }}"
                       required>
                @error('tanggal_prestasi')
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

        <!-- Keterangan -->
        <div>
            <label for="keterangan" class="block font-medium text-gray-700 mb-2">Keterangan Prestasi</label>
            <textarea name="keterangan"
                      id="keterangan"
                      rows="3"
                      class="w-full p-2 border rounded focus:ring-blue-500 focus:border-blue-500 @error('keterangan') border-red-500 @enderror">{{ old('keterangan') }}</textarea>
            @error('keterangan')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tombol Submit -->
        <div class="flex justify-end space-x-2">
            <button type="reset" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                Reset
            </button>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Simpan Prestasi
            </button>
        </div>
    </form>
</div>
@endsection
