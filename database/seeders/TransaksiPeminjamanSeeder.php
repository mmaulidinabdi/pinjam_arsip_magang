<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TransaksiPeminjaman;

class TransaksiPeminjamanSeeder extends Seeder
{
    public function run()
    {
        TransaksiPeminjaman::factory()->count(10)->create(); // Buat 10 data contoh
    }
}
