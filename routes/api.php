<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

use App\Http\Controllers\Api\TransaksiController;

// Endpoint Publik (Untuk Login via Dio)
Route::post('/login', [AuthController::class, 'login']);

// Endpoint Terproteksi (Harus bawa Token di Headers Dio)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/transaksi', [TransaksiController::class, 'store']);
    
    // PERBAIKAN ROUTE: Cukup gunakan AuthController::class karena sudah di-import di atas
    Route::get('/owner/dashboard', [AuthController::class, 'ownerDashboard']);
});