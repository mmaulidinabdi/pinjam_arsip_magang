<?php

namespace Database\Factories;
use App\Models\Histori;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\histori>
 */
class historiFactory extends Factory
{
    protected $model = Histori::class;

    public function definition()
    {
        $status = $this->faker->randomElement(['diacc', 'ditolak']);
    
    return [
        'peminjaman_id' => $this->faker->randomElement(['1', '2', '3', '4', '5', '6', '7']),
        'peminjam_id' => $this->faker->randomElement(['1', '2', '3', '4', '5', '6', '7']),
        'imb_id' => $status === 'diacc' ? '1' : null, // Jika status diacc, imb_id bernilai 1; jika ditolak, imb_id null
        'status' => $status,
        'alasan_ditolak' => $status === 'ditolak' ? $this->faker->sentence() : null, // Jika status ditolak, alasan_ditolak berisi kalimat; jika diacc, kosong
        'tanggal_peminjaman' => $this->faker->date(),
        'tujuan_peminjam' => $this->faker->sentence(),
        'dokumen_pendukung' => $this->faker->word() . '.pdf',
        'jenis_arsip' => $this->faker->randomElement(['Arsip1', 'arsip2', 'IMB']),
    ];
    }
}
