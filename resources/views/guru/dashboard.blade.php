<?php
use Illuminate\Support\Facades\Auth;
?>
@extends('layouts.guru.app')

@section('content')
<div class="flex flex-col sm:flex-row">
    <!-- Sidebar -->
    <div class="w-full sm:w-1/4 bg-gray-100 h-auto sm:h-screen p-4">
        <h3 class="text-lg font-medium mb-6">Menu</h3>
        <ul>
            <li class="mb-4">
                <a href="{{route('guru.prestasi')}}" class="block bg-green-200 text-green-800 p-2 rounded hover:bg-green-300">Input Prestasi</a>
            </li>
            <li>
                <a href="{{route('guru.pelanggaran')}}" class="block bg-blue-200 text-blue-800 p-2 rounded hover:bg-blue-300">Laporan Pelanggaran</a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="w-full sm:w-3/4 p-6">
        <h3 class="text-lg font-medium mb-4">Selamat Datang, {{ Auth::user()->name }}!</h3>

        <!-- Tabel Prestasi -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h4 class="font-bold mb-4 text-lg">Daftar Prestasi</h4>
                <!-- Wrapper responsive -->
                <div class="overflow-x-auto">
                    <table class="table-auto border-collapse border border-gray-300 w-full text-left">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="border border-gray-300 px-4 py-2">No</th>
                                <th class="border border-gray-300 px-4 py-2">Nama Siswa</th>
                                <th class="border border-gray-300 px-4 py-2">Prestasi</th>
                                <th class="border border-gray-300 px-4 py-2">Level Prestasi</th>
                                <th class="border border-gray-300 px-4 py-2">Tanggal</th>
                                <th class="border border-gray-300 px-4 py-2">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($prestasis as $key => $prestasi)
                                <tr class="{{ $loop->even ? 'bg-gray-100' : '' }}">
                                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $key + 1 }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $prestasi->siswa->nama ?? 'Tidak Diketahui' }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $prestasi->nama_prestasi }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $prestasi->lv_prestasi }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $prestasi->tanggal_prestasi }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $prestasi->keterangan }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2 text-center" colspan="6">Tidak ada data prestasi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Tabel Prestasi -->
        <div class="mt-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h4 class="font-bold mb-4 text-lg">Daftar Pelanggaran</h4>
                <!-- Wrapper responsive -->
                <div class="overflow-x-auto">
                    <table class="table-auto border-collapse border border-gray-300 w-full text-left">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="border border-gray-300 px-4 py-2">No</th>
                                <th class="border border-gray-300 px-4 py-2">Nama Siswa</th>
                                <th class="border border-gray-300 px-4 py-2">Pelanggaran</th>
                                <th class="border border-gray-300 px-4 py-2">Point</th>
                                <th class="border border-gray-300 px-4 py-2">Tanggal</th>
                                <th class="border border-gray-300 px-4 py-2">Kategori</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pelanggarans as $key => $pelanggaran)
                                <tr class="{{ $loop->even ? 'bg-gray-100' : '' }}">
                                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $key + 1 }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $pelanggaran->siswa->nama ?? 'Tidak Diketahui' }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $pelanggaran->pelanggaran }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $pelanggaran->point }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $pelanggaran->tanggal_melanggar }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $pelanggaran->kategori }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2 text-center" colspan="6">Tidak ada data Pelanggaran.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
