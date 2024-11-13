<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Arsip1;
use App\Models\Arsip2;
use App\Models\Imb;
use App\Models\Peminjam;
use App\Models\Histori;
use Illuminate\Database\Seeder;
use App\Models\TransaksiPeminjaman;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Peminjam::factory()->count(100)->create();
        TransaksiPeminjaman::factory()->count(100)->create();
        Imb::factory()->count(500)->create();
        Arsip1::factory()->count(100)->create();
        Arsip2::factory()->count(50)->create();
        histori::factory()->count(10)->create();


            Admin::create([
                'email' => 'admin@admin.com',
                'password' => Hash::make('12345'),
            ]);    
    }
}
