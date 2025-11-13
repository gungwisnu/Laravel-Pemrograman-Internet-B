<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MahasiswaApiController;

// Default route untuk cek user login via token
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// 🔑 Login untuk dapatkan token
Route::post('/login', [AuthController::class, 'login']);

// 🔒 Route yang butuh token (protected)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // ✅ Ganti nama rute agar tidak bentrok dengan web route
    Route::apiResource('mahasiswa', MahasiswaApiController::class)->names([
        'index'   => 'api.mahasiswa.index',
        'store'   => 'api.mahasiswa.store',
        'show'    => 'api.mahasiswa.show',
        'update'  => 'api.mahasiswa.update',
        'destroy' => 'api.mahasiswa.destroy',
    ]);
});
