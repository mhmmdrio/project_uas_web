<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan Halaman Login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Memproses Aksi Login
    public function login(Request $request)
    {
        // 1. Validasi Input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Coba Autentikasi Login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            /** @var \App\Models\User $user */
            $user = Auth::user();

            // 3. Cek Pengalihan Berdasarkan Email (Karena tidak ada kolom role di DB)
            if ($user->email === 'owner@gunabangunjaya.com') {
                // Jika emailnya ini, dia pasti Owner
                return redirect()->route('owner.dashboard');
            } else {
                // Jika emailnya yang lain, anggap saja Kasir
                return redirect()->route('transaksi.index');
            }
        }

        // 4. Jika Email atau Password Salah
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    // Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}