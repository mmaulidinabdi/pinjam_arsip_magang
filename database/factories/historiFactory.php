<?php

namespace Database\Factories;

use App\Models\Histori;
use App\Models\TransaksiPeminjaman;
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

        // Ambil satu TransaksiPeminjaman secara acak
        $transaksi = TransaksiPeminjaman::inRandomOrder()->first();


        return [
            'peminjaman_id' => $transaksi->id,
            'peminjam_id' => $transaksi->peminjam_id,
            'imb_id' => $status === 'diacc' ? $this->faker->randomElement(['1', '2', '3', '4', '5', '6', '7']) : null,
            'nama_arsip' => $this->faker->sentence(),
            'status' => $status,
            'alasan_ditolak' => $status === 'ditolak' ? $this->faker->sentence() : null, // Jika status ditolak, alasan_ditolak berisi kalimat; jika diacc, kosong
            'tanggal_peminjaman' => $transaksi->tanggal_peminjaman, // Menggunakan tanggal peminjaman dari TransaksiPeminjaman
            'tujuan_peminjam' => $transaksi->tujuan_peminjam, // Menggunakan tujuan dari TransaksiPeminjaman
            'dokumen_pendukung' => $transaksi->dokumen_pendukung, // Menggunakan dokumen pendukung dari TransaksiPeminjaman
            'tanggal_pengembalian' => $status === 'diacc'
                ? (rand(0, 1) === 1 // Acak antara kosong atau tanggal
                    ? null // Kosong (belum dikembalikan)
                    : \Carbon\Carbon::parse($transaksi->tanggal_peminjaman)->addDays(rand(15, 30))->toDateString() // 15-30 hari dari tanggal_peminjaman
                )
                : null,
            'jenis_arsip' => $this->faker->randomElement(['Arsip1', 'Arsip2', 'IMB']),
        ];
    }


}
