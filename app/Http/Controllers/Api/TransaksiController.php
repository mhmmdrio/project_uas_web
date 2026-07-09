<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    // Menyimpan transaksi baru dari aplikasi mobile (Flutter)
    public function store(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'nama_customer' => 'required|string|max:255',
            'alamat' => 'required|string',
            'jenis_cat' => 'required|string',
            'warna_cat' => 'required|string',
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
            'total_harga' => $total_harga,
        ]);

        // 5. Kembalikan response JSON (dibaca oleh Dio di Flutter)
        return response()->json([
            'message' => 'Transaksi Berhasil Disimpan!',
            'total_harga' => $total_harga,
            'data' => $transaksi,
        ], 201);
    }
}
