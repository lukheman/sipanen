<?php

namespace Database\Factories;

use App\Models\HasilPanen;
use App\Models\Kecamatan;
use App\Models\Tanaman;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class HasilPanenFactory extends Factory
{
    protected $model = HasilPanen::class;

    public function definition(): array
    {
        return [
            'jumlah' => $this->faker->numberBetween(10, 500), // jumlah produksi
            'id_tanaman' => Tanaman::inRandomOrder()->first()->id_tanaman ?? Tanaman::factory(),
            'id_kecamatan' => Kecamatan::inRandomOrder()->first()->id_kecamatan ?? Kecamatan::factory(),
        ];
    }
}
