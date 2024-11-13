<?php

namespace Database\Factories;

use App\Models\Arsip2;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Arsip2>
 */
class Arsip2Factory extends Factory
{

    protected $model = Arsip2::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'nomor_dp' => $this->faker->randomNumber(5, true), // Angka acak 5 digit
            'nama_pemilik' => $this->faker->name, // Nama acak
            'alamat' => $this->faker->address, // Alamat acak
            'lokasi' => $this->faker->city, // Kota acak
            'box' => $this->faker->numberBetween(1, 999), // Kata acak untuk box
            'keterangan' => $this->faker->sentence, // Kalimat acak
            'tahun' => $this->faker->year, // Tahun acak
        ];
    }
}
