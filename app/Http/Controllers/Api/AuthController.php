<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        
        // PERBAIKAN: Cek Role berdasarkan Email (Karena tidak ada kolom role di DB)
        if ($user->email === 'owner@gunabangunjaya.com') {
            $role = 'Owner';
        } else {
            $role = 'Kasir';
        }

        $token = $user->createToken('mobile-token')->plainTextToken;

        return response()->json([
            'message' => 'Login Berhasil',
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'role' => $role // Sekarang Flutter akan menerima role yang benar!
            ],
            'token' => $token
        ], 200);
    }

    // Fungsi Dashboard Owner yang sebelumnya kita buat
    public function ownerDashboard()
    {
        $totalTransaksi = DB::table('transaksis')->count();
        $totalPendapatan = DB::table('transaksis')->sum('total_harga') ?? 0;
        
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