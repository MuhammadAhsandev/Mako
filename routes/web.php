<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PrestasiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelanggaranController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    // Common routes for all authenticated users
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Role-based routes
    Route::middleware('user-access:admin')->group(function () {
        Route::get('/admin/dashboard', [HomeController::class, 'adminDashboard'])->name('admin.dashboard');
    });

    Route::middleware('user-access:guru')->group(function () {
        Route::get('/guru/dashboard', [HomeController::class, 'guruDashboard'])->name('guru.dashboard');

        // Prestasi routes
        Route::get('/guru/prestasi', [PrestasiController::class, 'index'])->name('guru.prestasi');
        Route::get('/guru/prestasi/create', [PrestasiController::class, 'create'])->name('guru.prestasi.create');
        Route::post('/guru/prestasi', [PrestasiController::class, 'store'])->name('guru.prestasi.store');
        // Pelanggaran routes
        Route::get('/guru/pelanggaran', [PelanggaranController::class, 'index'])->name('guru.pelanggaran');
        Route::get('/guru/pelanggaran/create', [PelanggaranController::class, 'create'])->name('guru.pelanggaran.create');
        Route::post('/guru/pelanggaran', [PelanggaranController::class, 'store'])->name('guru.pelanggaran.store');
    });

    Route::middleware('user-access:orangtua')->group(function () {
        Route::get('/orangtua/dashboard', [HomeController::class, 'orangtuaDashboard'])->name('orangtua.dashboard');
    });

    Route::middleware('user-access:siswa')->group(function () {
        Route::get('/siswa/dashboard', [HomeController::class, 'siswaDashboard'])->name('siswa.dashboard');
    });
});

require __DIR__.'/auth.php';
