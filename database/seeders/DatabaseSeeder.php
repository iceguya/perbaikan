<?php

namespace Database\Seeders;

use App\Models\User;
use App\Http\Controllers\DashboardController;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Models\Order;

=======
use App\Models\UserRequest; 
>>>>>>> 6b6f83cddd511ecdb28869c42b1e42e2b6739f7b

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */public function run(): void
{
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

<<<<<<< HEAD
    User::create([
        'name' => 'User',
        'email' => 'user@mail.com',
        'password' => Hash::make('password'),
        'role' => 'user',
    ]);
}
=======
        // 2. Buat User Tambahan Menggunakan Factory (untuk mengisi halaman manajemen user)
        // Pastikan Anda sudah mengatur UserFactory.php dengan 'admin()', 'teknisi()', 'user()' states
        User::factory(10)->create([
            'role' => 'user',
            'email_verified_at' => now(),
        ]);
        User::factory(5)->teknisi()->create([
            'email_verified_at' => now(),
        ]);
        User::factory(2)->admin()->create([
            'email_verified_at' => now(),
        ]);


        // --- PENTING: BAGIAN INI ---

        // 3. Buat Data Order (Pesanan)
        // Order harus dibuat SEBELUM PaymentsTableSeeder dipanggil
        // Ada dua cara:
        // A. Panggil OrderSeeder terpisah jika Anda memilikinya:
        // $this->call(OrderSeeder::class);

        // B. Atau, buat data Order langsung di sini menggunakan OrderFactory:
        // Pastikan Anda sudah memiliki App\Models\Order dan database/factories/OrderFactory.php
        Order::factory(30)->create(); // Membuat 30 order acak untuk dummy data

        // 4. Panggil PaymentsTableSeeder
        // Ini akan menggunakan order yang baru saja dibuat
        $this->call(PaymentsTableSeeder::class);
    }
>>>>>>> 6b6f83cddd511ecdb28869c42b1e42e2b6739f7b
}