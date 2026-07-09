<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // <-- 1. TAMBAHKAN INI UNTUK MENGHILANGKAN GARIS MERAH \DB
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Email atau password salah'], 401);
        }

        $user = User::where('email', $request->email)->first();
        $role = $user->role ?? 'Kasir';

        $token = $user->createToken('mobile-token')->plainTextToken;

        return response()->json([
            'message' => 'Login Berhasil',
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'role' => $role
            ],
            'token' => $token
        ], 200);
    }

    // 2. KODE DASHBOARD OWNER YANG SUDAH BERSIH DARI GARIS MERAH
    public function ownerDashboard()
    {
        // Mengambil total transaksi & pendapatan langsung menggunakan facade DB yang sudah di-import
        $totalTransaksi = DB::table('transaksis')->count();
        $totalPendapatan = DB::table('transaksis')->sum('total_harga') ?? 0;
        
        // Mengambil 5 transaksi terbaru
        $riwayat = DB::table('transaksis')
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get();

        return response()->json([
            'total_transaksi' => $totalTransaksi,
            'total_pendapatan' => $totalPendapatan,
            'riwayat' => $riwayat
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logout Berhasil'], 200);
    }
}