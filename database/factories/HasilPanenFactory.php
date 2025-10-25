<?php

namespace Database\Factories;

use App\Models\HasilPanen;
use App\Models\Kecamatan;
use App\Models\Tanaman;
use Illuminate\Database\Eloquent\Factories\Factory;

class HasilPanenFactory extends Factory
{
    protected $model = HasilPanen::class;

    public function definition(): array
    {
        return [
            'jumlah' => $this->faker->numberBetween(10, 500), // jumlah produksi
            'tahun' => $this->faker->numberBetween(2020, date('Y')), // tahun acak antara 2020 dan tahun sekarang
            'id_tanaman' => Tanaman::inRandomOrder()->value('id_tanaman') ?? Tanaman::factory(),
            'id_kecamatan' => Kecamatan::inRandomOrder()->value('id_kecamatan') ?? Kecamatan::factory(),
        ];
    }
}
