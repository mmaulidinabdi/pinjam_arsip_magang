<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Histori;

class historiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        histori::factory()->count(10)->create();
    }
}
