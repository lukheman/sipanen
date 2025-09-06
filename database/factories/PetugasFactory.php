<?php

namespace Database\Factories;

use App\Models\Kecamatan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Petugas>
 */
class PetugasFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama_petugas' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password123'), // default password
            'telepon' => $this->faker->phoneNumber(),
            'jabatan' => $this->faker->randomElement(['Pencatan tanaman', 'Pencatatan lahan', 'Petugas Lapangan']),
            'photo' => null, // bisa diisi dengan path dummy jika perlu
            'id_kecamatan' => Kecamatan::query()->pluck('id_kecamatan')->random(),
            'remember_token' => Str::random(10),
        ];
    }
}
