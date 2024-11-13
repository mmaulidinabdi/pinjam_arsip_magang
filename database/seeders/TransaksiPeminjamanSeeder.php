<?php

namespace Database\Seeders;

use App\Models\Peminjam;
use Illuminate\Database\Seeder;
use App\Models\TransaksiPeminjaman;

class TransaksiPeminjamanSeeder extends Seeder
{
    public function run()
    {
        Peminjam::factory()->count(100)->create();
        TransaksiPeminjaman::factory()->count(10)->create(); // Buat 10 data contoh
    }
}
