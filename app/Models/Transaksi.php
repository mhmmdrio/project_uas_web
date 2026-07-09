<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    // Tambahkan baris ini agar data bisa disimpan
    protected $fillable = [
        'nama_customer',
        'alamat',
        'jenis_cat',
        'warna_cat',
        'jumlah_beli',
        'total_harga'
    ];
}
