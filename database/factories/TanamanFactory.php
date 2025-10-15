<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tanaman>
 */
class TanamanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $musim = ['Musim Hujan', 'Musim Kemarau', 'Sepanjang Tahun'];

        return [
            'nama_tanaman' => $this->faker->unique()->word(),
            'musim_tanam' => $this->faker->randomElement($musim),
        ];
    }
}
