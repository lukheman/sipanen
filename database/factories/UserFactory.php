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
            'nama_petani' => $this->faker->name,
            // 'email' => $this->faker->unique()->safeEmail,
            // 'role' => $this->faker->randomElement(Role::values()),
            // 'password' => bcrypt('password123'),
            'telepon' => $this->faker->phoneNumber,
            // 'tanggal_lahir' => $this->faker->date(),
            'alamat' => $this->faker->streetAddress(),
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
