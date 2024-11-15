<?php

namespace Database\Factories;

use App\Models\Imb;
use App\Models\Arsip1;
use App\Models\Arsip2;
use App\Models\Peminjam;
use App\Models\TransaksiPeminjaman;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransaksiPeminjamanFactory extends Factory
{
    protected $model = TransaksiPeminjaman::class;

    public function definition()
    {

        $arsip = $this->getRandomArsip();

        return [
            'peminjam_id' => Peminjam::factory(),
            'tanggal_peminjaman' => $this->faker->date(),
            'tujuan_peminjam' => $this->faker->sentence(),
            'dokumen_pendukung' => $this->faker->word() . '.pdf',
            'status' => $this->faker->randomElement(['diperiksa', 'disetujui', 'tolak']),
            'no_arsip' => $arsip->id, // Menggunakan ID arsip sebagai nomor arsip
            'nama_arsip' => $arsip->nama ?? $this->faker->words(3, true), // Nama arsip jika ada, jika tidak nama acak
            'data_arsip' => $this->faker->sentence(),
            'jenis_arsip' => class_basename($arsip), // Menyimpan jenis arsip dari nama class
            // 'alasan_ditolak' => $this->faker->optional()->sentence(),
        ];
    }

    private function getRandomArsip()
    {
        // Memilih model arsip secara acak
        $arsipModel = $this->faker->randomElement([Imb::class, Arsip1::class, Arsip2::class]);
        return $arsipModel::factory()->create(); // Membuat instance arsip acak dan mengembalikannya
    }
}
