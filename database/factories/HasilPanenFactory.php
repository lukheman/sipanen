<?php

namespace Database\Factories;

use App\Models\HasilPanen;
use App\Models\Tanaman;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class HasilPanenFactory extends Factory
{
    protected $model = HasilPanen::class;

    public function definition(): array
    {
        return [
            'tanggal_panen' => $this->faker->date(),
            'jumlah' => $this->faker->numberBetween(10, 500), // jumlah produksi
            'satuan' => $this->faker->randomElement(['Kg', 'Ton', 'Ikat', 'Karung']),
            'id_tanaman' => Tanaman::inRandomOrder()->first()->id_tanaman ?? Tanaman::factory(),
            'id_petani' => User::inRandomOrder()->first()->id_petani ?? User::factory(),
        ];
    }
}
