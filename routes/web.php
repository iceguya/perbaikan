<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// USE STATEMENTS
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\Teknisi\DashboardController as TeknisiDashboardController;
use App\Http\Controllers\User\RequestController; // <-- INI YANG PERLU DITAMBAHKAN

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Otomatis redirect ke dashboard sesuai role
Route::get('/dashboard', function () {
    $user = Auth::user();

    if (!$user) {
        return redirect('/login');
    }

    return match ($user->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'teknisi' => redirect()->route('teknisi.dashboard'),
        'user' => redirect()->route('user.dashboard'),
        default => abort(403, 'Role tidak dikenali.'),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

// Grup route untuk pengguna yang sudah login
Route::middleware('auth')->group(function () {

    // Route bawaan Breeze untuk edit profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // == BAGIAN ADMIN ==
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        // Contoh: Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    });

    // == BAGIAN TEKNISI ==
    Route::middleware(['role:teknisi'])->prefix('teknisi')->name('teknisi.')->group(function () {
        Route::get('/', [TeknisiDashboardController::class, 'index'])->name('dashboard');
    });

    // == BAGIAN USER ==
    // Middleware 'auth' tidak perlu ditulis lagi karena sudah ada di grup induk
    Route::middleware(['role:user'])->prefix('user')->name('user.')->group(function () {
        Route::get('/', [UserDashboardController::class, 'index'])->name('dashboard');

        // Rute untuk fitur Request Service
        Route::get('requests', [RequestController::class, 'index'])->name('requests.index');
        Route::get('requests/create', [RequestController::class, 'create'])->name('requests.create');
        Route::post('requests', [RequestController::class, 'store'])->name('requests.store');
    });
});

// Import route bawaan Breeze (login, register, dll)
require __DIR__.'/auth.php';