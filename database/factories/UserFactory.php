<?php

namespace Database\Factories;

use App\Enums\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'nama' => $this->faker->name,
            // 'telepon' => $this->faker->phoneNumber,
            // 'tanggal_lahir' => $this->faker->date(),
            // 'alamat' => $this->faker->streetAddress(),
            // 'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
