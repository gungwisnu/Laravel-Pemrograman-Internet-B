<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

// Halaman welcome
Route::get('/', function () {
    return view('welcome');
});

// =======================
// AUTH + DASHBOARD + PROFIL
// =======================
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// =======================
// ROUTES MANAJEMEN DATA
// =======================
Route::middleware(['auth'])->group(function() {

    // -------- Mahasiswa --------
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
    Route::get('/mahasiswa/search', [MahasiswaController::class, 'search']);

    // User hanya bisa lihat data mahasiswa (index, search)
    // Admin bisa tambah, edit, hapus
    Route::middleware('role:admin')->group(function() {
        Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
        Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
        Route::get('/mahasiswa/{id}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
        Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
        Route::get('/mahasiswa/{id}/confirm-delete', [MahasiswaController::class, 'confirmDelete'])->name('mahasiswa.confirmDelete');
        Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
    });

    // AJAX - get Prodi berdasarkan Fakultas
    Route::get('/get-prodi/{fakultas_id}', function ($fakultas_id) {
        return \App\Models\Prodi::where('fakultas_id', $fakultas_id)->get();
    });

    // -------- Prodi --------
    Route::get('/prodi', [ProdiController::class,'index'])->name('prodi.index');

    // hanya admin yang bisa CRUD Prodi
    Route::middleware('role:admin')->group(function() {
        Route::get('/prodi/create', [ProdiController::class,'create'])->name('prodi.create');
        Route::post('/prodi', [ProdiController::class,'store'])->name('prodi.store');
        Route::get('/prodi/{id}/edit', [ProdiController::class,'edit'])->name('prodi.edit');
        Route::put('/prodi/{id}', [ProdiController::class,'update'])->name('prodi.update');
        Route::get('/prodi/{id}/confirm-delete', [ProdiController::class,'confirmDelete'])->name('prodi.confirmDelete');
        Route::delete('/prodi/{id}', [ProdiController::class,'destroy'])->name('prodi.destroy');
    });

    // -------- Fakultas --------
    Route::get('/fakultas', [FakultasController::class,'index'])->name('fakultas.index');

    // hanya admin yang bisa CRUD Fakultas
    Route::middleware('role:admin')->group(function() {
        Route::get('/fakultas/create', [FakultasController::class,'create'])->name('fakultas.create');
        Route::post('/fakultas', [FakultasController::class,'store'])->name('fakultas.store');
        Route::get('/fakultas/{id}/edit', [FakultasController::class,'edit'])->name('fakultas.edit');
        Route::put('/fakultas/{id}', [FakultasController::class,'update'])->name('fakultas.update');
        Route::get('/fakultas/{id}/confirm-delete', [FakultasController::class,'confirmDelete'])->name('fakultas.confirmDelete');
        Route::delete('/fakultas/{id}', [FakultasController::class,'destroy'])->name('fakultas.destroy');
    });
    
});
