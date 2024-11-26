<?php

namespace Database\Factories;

use App\Models\Histori;
use App\Models\TransaksiPeminjaman;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Histori>
 */
class historiFactory extends Factory
{
    protected $model = Histori::class;

    public function definition()
    {
        $status = $this->faker->randomElement(['diacc', 'ditolak']);
        $jenis_arsip = $this->faker->randomElement(['SK', 'Arsip2', 'IMB']); // Pilih jenis arsip secara acak

        // Inisialisasi id dengan nilai null
        $imb_id = null;
        $sk_id = null;
        $arsip2_id = null;

        // Tentukan id hanya jika status diacc dan jenis arsip sesuai
        if ($status === 'diacc') {
            if ($jenis_arsip === 'IMB') {
                $imb_id = $this->faker->randomElement([1, 2, 3, 4, 5, 6, 7]);
            } elseif ($jenis_arsip === 'SK') {
                $sk_id = $this->faker->randomElement([1, 2, 3, 4, 5, 6, 7]);
            } elseif ($jenis_arsip === 'Arsip2') {
                $arsip2_id = $this->faker->randomElement([1, 2, 3, 4, 5, 6, 7]);
            }
        }

        // Ambil satu TransaksiPeminjaman secara acak
        $transaksi = TransaksiPeminjaman::inRandomOrder()->first();

        if (!$transaksi) {
            throw new \Exception('Tabel TransaksiPeminjaman kosong, tidak bisa membuat histori.');
        }

        return [
            'peminjam_id' => $transaksi->peminjam_id,
            'imb_id' => $imb_id, // Hanya terisi jika jenis_arsip adalah IMB
            'sk_id' => $sk_id,  // Hanya terisi jika jenis_arsip adalah SK
            'arsip2_id' => $arsip2_id, // Hanya terisi jika jenis_arsip adalah Arsip2
            'nama_arsip' => $this->faker->sentence(),
            'status' => $status,
            'alasan_ditolak' => $status === 'ditolak' ? $this->faker->sentence() : null,
            'tanggal_peminjaman' => $transaksi->tanggal_peminjaman,
            'tujuan_peminjam' => $transaksi->tujuan_peminjam,
            'dokumen_pendukung' => $transaksi->dokumen_pendukung,
            'tanggal_pengembalian' => $status === 'diacc'
                ? (rand(0, 1) === 1
                    ? null
                    : \Carbon\Carbon::parse($transaksi->tanggal_peminjaman)->addDays(rand(15, 30))->toDateString())
                : null,
            'tanggal_divalidasi' => $this->faker->date(),
            'jenis_arsip' => $jenis_arsip, // Jenis arsip yang dipilih
        ];
    }
}
