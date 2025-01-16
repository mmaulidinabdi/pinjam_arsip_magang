<?php

namespace Database\Seeders;

use App\Models\SK;
use App\Models\Imb;
use App\Models\Admin;
use App\Models\Arsip1;
use App\Models\Arsip2;
use App\Models\Histori;
use App\Models\Peminjam;
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

        // Peminjam::factory()->count(100)->create();
        // TransaksiPeminjaman::factory()->count(100)->create();
        // Imb::factory()->count(500)->create();
        // Arsip1::factory()->count(100)->create();
        // Arsip2::factory()->count(50)->create();
        // histori::factory()->count(10)->create();
        // Buat data di tabel `imbs`

    // Imb::factory(10)->create();
    // SK::factory(5)->create();
    // Arsip2::factory(5)->create();

    // Lalu lanjutkan dengan `Peminjam`, `TransaksiPeminjaman`, dan `Histori`
    // Peminjam::factory(10)->create()->each(function ($peminjam) {
    //     TransaksiPeminjaman::factory(3)->create(['peminjam_id' => $peminjam->id])->each(function ($transaksi) use ($peminjam) {
    //         Histori::factory(1)->create([
    //             'peminjam_id' => $peminjam->id,
                 // Pastikan `imb_id` mengacu pada data yang ada
    //         ]);
    //     });
    // });
    
    // Tambahkan arsip lainnya (Arsip1, Arsip2)
   

        Admin::create([
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345'),
        ]);

        // Peminjam::create([
        //     'nama_lengkap' => 'Dio Brando',
        //     'email'=>'dio@gmail.com',
        //     'password'=> Hash::make('12345'),
        // ]);
    }
}
