<?php

namespace Database\Seeders;

use App\Models\User;
use App\Http\Controllers\DashboardController;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;


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

    User::create([
        'name' => 'User',
        'email' => 'user@mail.com',
        'password' => Hash::make('password'),
        'role' => 'user',
    ]);
}
}