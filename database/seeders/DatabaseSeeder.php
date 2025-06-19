<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Order; // Pastikan model Order di-import
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Kosongkan tabel users dulu agar tidak error duplikat
        User::query()->delete();

        // Buat akun admin dan teknisi secara manual
        User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Teknisi',
            'email' => 'teknisi@mail.com',
            'password' => Hash::make('password'),
            'role' => 'teknisi',
        ]);

        // Buat user biasa menggunakan factory
        User::factory(10)->create([
            'role' => 'user',
            'email_verified_at' => now(),
        ]);

        // Buat teknisi acak dari factory dengan email unik
        User::factory(5)->create([
            'role' => 'teknisi',
            'email_verified_at' => now(),
        ]);

        // Buat admin tambahan dari factory dengan email unik
        User::factory(2)->create([
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Order dummy
        // Order::factory(10)->create();

        // Seeder tambahan (misal untuk payment)
        $this->call(PaymentsTableSeeder::class);
    }
}
