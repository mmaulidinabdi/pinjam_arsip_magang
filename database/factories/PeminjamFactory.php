<?php

namespace Database\Factories;

use App\Models\Peminjam;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Peminjam>
 */
class PeminjamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = peminjam::class;

    public function definition(): array
    {

        return [
            'nama_lengkap' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt(12345),
            'alamat' => $this->faker->address(),
            'no_telp' => $this->faker->unique()->phoneNumber(),
            

        ];
    }
}
