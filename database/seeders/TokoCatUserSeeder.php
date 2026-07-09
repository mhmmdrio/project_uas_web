<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class TokoCatUserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Membuat Role
        $kasirRole = Role::create(['name' => 'Kasir']);
        $ownerRole = Role::create(['name' => 'Owner']);

        // 2. Akun Kasir (Gunakan NIM kamu sebagai bagian dari email agar unik)
        $kasir = User::create([
            'name' => 'Kasir Dwi Prasetiyo',
            'email' => 'kasir.C030324043@gunabangunjaya.com',
            'password' => Hash::make('kasir123'),
        ]);
        $kasir->assignRole($kasirRole);

        // 3. Akun Owner / Pemilik Toko
        $owner = User::create([
            'name' => 'Owner Guna Bangun Jaya',
            'email' => 'owner@gunabangunjaya.com',
            'password' => Hash::make('owner123'),
        ]);
        $owner->assignRole($ownerRole);
    }
}