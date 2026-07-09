<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\AuthController;

// Halaman Autentikasi Publik
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Proteksi Halaman (Hanya mengecek apakah user sudah login)
Route::middleware(['auth'])->group(function () {
    
    // Halaman Kasir
    Route::get('/', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::post('/hitung', [TransaksiController::class, 'hitung'])->name('transaksi.hitung');

    // Halaman Dashboard Owner
    Route::get('/owner/dashboard', function () {
        // Mengambil seluruh data transaksi toko cat terbaru dari database
        $semuaTransaksi = \App\Models\Transaksi::orderBy('id', 'desc')->get();
        $totalPendapatan = \App\Models\Transaksi::sum('total_harga');

        return view('owner_dashboard', compact('semuaTransaksi', 'totalPendapatan'));
    })->name('owner.dashboard');
});