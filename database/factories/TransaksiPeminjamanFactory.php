<?php

namespace Database\Factories;

use App\Models\TransaksiPeminjaman;
use App\Models\Peminjam;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransaksiPeminjamanFactory extends Factory
{
    protected $model = TransaksiPeminjaman::class;

    public function definition()
    {
        return [
            'peminjam_id' => Peminjam::factory(),
            'admin_id' => Admin::factory(),
            'tanggal_peminjaman' => $this->faker->date(),
            'tujuan_peminjam' => $this->faker->sentence(),
            'dokumen_pendukung' => $this->faker->word() . '.pdf',
            'status' => $this->faker->randomElement(['diperiksa', 'disetujui', 'tolak']),
            'no_arsip' => $this->faker->unique()->numerify('ARSIP###'),
            'nama_arsip' => $this->faker->words(3, true),
            'data_arsip' => $this->faker->sentence(),
            'jenis_arsip' => $this->faker->randomElement(['Arsip1', 'arsip2', 'IMB']),
            'alasan_ditolak' => $this->faker->optional()->sentence(),
        ];
    }
}
