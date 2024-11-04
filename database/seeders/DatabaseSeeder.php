<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Peminjam;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Admin::create([
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345'),
        ]);

        $peminjams = [
            [
                'nama_lengkap' => 'Nasi aja',
                'email' => 'nasiaja@nasi.com',
                'password' => Hash::make('12345'),
                'alamat' => 'Jl. Kumpulan Nasi gg. haruan no.27',
                'no_telp' => '087812384535',
            ],
            [
                'nama_lengkap' => 'Nasi Kuning',
                'email' => 'naskun@nasi.com',
                'password' => Hash::make('12345'),
                'alamat' => 'Jl. Kumpulan Nasi gg. haruan no.27',
                'no_telp' => '087812328335',
            ],
            [
                'nama_lengkap' => 'Nasi Goreng',
                'email' => 'nasgor@nasi.com',
                'password' => Hash::make('12345'),
                'alamat' => 'Jl. Kumpulan Nasi gg. haruan no.27',
                'no_telp' => '087818251235',
            ],
            [
                'nama_lengkap' => 'Nasi Padang',
                'email' => 'nasipad@nasi.com',
                'password' => Hash::make('12345'),
                'alamat' => 'Jl. Kumpulan Nasi gg. haruan no.27',
                'no_telp' => '087841751235',
            ],
            [
                'nama_lengkap' => 'Ayam Goreng',
                'email' => 'Ayamgoreng@aym.com',
                'password' => Hash::make('12345'),
                'alamat' => 'Jl. Kumpulan Ayam gg. Nasi Kuning no.27',
                'no_telp' => '087812361235',
            ],
            [
                'nama_lengkap' => 'Ayam Geprek',
                'email' => 'Ayamgeprek@aym.com',
                'password' => Hash::make('12345'),
                'alamat' => 'Jl. Kumpulan Ayam gg. Nasi Kuning no.27',
                'no_telp' => '087812781235',
            ],
            [
                'nama_lengkap' => 'Ayam Penyet',
                'email' => 'Ayampenyet@aym.com',
                'password' => Hash::make('12345'),
                'alamat' => 'Jl. Kumpulan Ayam gg. Nasi Kuning no.27',
                'no_telp' => '087812241235',
            ],
            [
                'nama_lengkap' => 'Ayam rebus',
                'email' => 'Ayamrebus@aym.com',
                'password' => Hash::make('12345'),
                'alamat' => 'Jl. Kumpulan Ayam gg. Nasi Kuning no.27',
                'no_telp' => '0878126461235',
            ],
            [
                'nama_lengkap' => 'Ayam bakar',
                'email' => 'Ayambakar@aym.com',
                'password' => Hash::make('12345'),
                'alamat' => 'Jl. Kumpulan Ayam gg. Nasi Kuning no.27',
                'no_telp' => '087812671235',
            ],
            [
                'nama_lengkap' => 'Ayam kukus',
                'email' => 'Ayamkukus@aym.com',
                'password' => Hash::make('12345'),
                'alamat' => 'Jl. Kumpulan Ayam gg. Nasi Kuning no.27',
                'no_telp' => '081212781325',
            ],
        ];


        foreach($peminjams as $peminjam){
            Peminjam::create($peminjam);
        }
    }
}
