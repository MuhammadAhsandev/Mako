<?php
use Illuminate\Support\Facades\Auth;
?>
@extends('layouts.siswa.app')

@section('content')
<div class="flex flex-col sm:flex-row">
    <!-- Sidebar -->
    <div class="w-full sm:w-1/4 bg-gray-100 h-auto sm:h-screen p-4">
        <h3 class="text-lg font-medium mb-6">Menu</h3>
        <ul>
            <li class="mb-4">
                <a href="#" class="block bg-green-200 text-green-800 p-2 rounded hover:bg-green-300">Konsultasi</a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="w-full sm:w-3/4 p-6">
        <h3 class="text-lg font-medium mb-4">Selamat Datang, {{ Auth::user()->name }}!</h3>

        <!-- Tabel Prestasi -->
        <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Prestasi Siswa -->
                <div class="bg-green-100 p-4 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-green-800">Prestasi</h3>
                    <ul class="mt-4 list-disc list-inside">
                        @forelse ($prestasis as $prestasi)
                            <li>
                                <strong>{{ $prestasi->nama_prestasi }}</strong> <br> {{ $prestasi->tanggal_prestasi }}
                                <p class="text-sm text-gray-600">{{ $prestasi->keterangan }}</p>
                            </li>
                        @empty
                            <p class="text-gray-600">Belum ada data prestasi.</p>
                        @endforelse
                    </ul>
                </div>

                <!-- Pelanggaran Siswa -->
                <div class="bg-red-100 p-4 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-red-800">Pelanggaran</h3>
                    <ul class="mt-4 list-disc list-inside">
                        @forelse ($pelanggarans as $pelanggaran)
                            <li>
                                <strong>{{ $pelanggaran->pelanggaran }}</strong> <br> {{ $pelanggaran->tanggal_melanggar }}
                                <p class="text-sm text-gray-600">{{ $pelanggaran->kategori }} - Poin: {{ $pelanggaran->point }}</p>
                            </li>
                        @empty
                            <p class="text-gray-600">Belum ada data pelanggaran.</p>
                        @endforelse
                    </ul>
                </div>

                <!-- Total Poin Pelanggaran -->
                <div class="bg-yellow-100 p-4 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-yellow-800">Total Poin Pelanggaran</h3>
                    <p class="mt-4 text-xl font-bold text-gray-800">{{ $totalPoin }}</p>
                    <p class="text-sm text-gray-600">Jumlah total poin dari semua pelanggaran yang tercatat.</p>
                </div>
            </div>
    </div>
</div>
@endsection