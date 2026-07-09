<?php

namespace App\Http\Controllers; 

use Illuminate\Http\Request;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    // Menampilkan halaman form
    public function index()
    {
        return view('form_cat');
    }

    // Memproses hitungan dan menyimpan data
    public function hitung(Request $request)
    {
        // 1. Validasi input form
        $request->validate([
            'nama_customer' => 'required|string|max:255',
            'alamat' => 'required|string',
            'jenis_cat' => 'required',
            'warna_cat' => 'required',
            'jumlah_beli' => 'required|integer|min:1',
        ]);

        // 2. Tentukan harga satuan berdasarkan Jenis Cat
        $harga_satuan = 0;
        if ($request->jenis_cat == 'CATYLAC') {
            $harga_satuan = 100000;
        } elseif ($request->jenis_cat == 'Vinilex') {
            $harga_satuan = 85000;
        } elseif ($request->jenis_cat == 'Dulux') {
            $harga_satuan = 150000;
        }

        // 3. Hitung total harga
        $total_harga = $harga_satuan * $request->jumlah_beli;

        // 4. Simpan ke Database
        $transaksi = Transaksi::create([
            'nama_customer' => $request->nama_customer,
            'alamat' => $request->alamat,
            'jenis_cat' => $request->jenis_cat,
            'warna_cat' => $request->warna_cat,
            'jumlah_beli' => $request->jumlah_beli,
            'total_harga' => $total_harga
        ]);

        // 5. Kembalikan ke halaman form dengan membawa data transaksi (sebagai array)
        return redirect()->back()->with([
            'success' => 'Transaksi Berhasil Disimpan!',
            'total_harga' => $total_harga,
            'data' => $transaksi->toArray() // Diubah ke Array agar sinkron dengan file Blade kamu yang memakai kurung siku []
        ]);
    }
}