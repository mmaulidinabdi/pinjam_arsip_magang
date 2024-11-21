<?php

namespace Database\Factories;

use App\Models\SK;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Arsip1>
 */
class SKFactory extends Factory
{

    protected $model = SK::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'nomor_sk' => $this->faker->randomNumber(5, true), // Angka acak 5 digit
            'tahun' => $this->faker->year, // Nama acak
            'tanggal_penetapan' => $this->faker->date(), // Alamat acak
            'tentang' => $this->faker->sentence, // Kota acak
        ];
    }
}
