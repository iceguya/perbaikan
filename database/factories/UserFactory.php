<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash; // Mungkin Anda butuhkan ini jika password diatur di sini

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'), // Pastikan Hash di-import jika tidak ada ini
            'remember_token' => Str::random(10),
            'role' => fake()->randomElement(['user']), // Default role
        ];
    } // <--- PASTIKAN KURUNG KURAWAL PENUTUP INI ADA di sini

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    // Metode 'states' yang Anda tambahkan
    public function admin(): static // <--- Ini adalah baris 13 dari error Anda
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'admin',
        ]);
    }

    public function teknisi(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'teknisi',
        ]);
    }
}