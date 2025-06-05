<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

//Grup route untuk pengguna yang sudah login
Route::middleware('auth')->group(function () {

    //   Route bawaan Breeze untuk edit profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //  Dashboard khusus Admin
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin', function () {
            return view('dashboard.admin', ['role' => 'Admin']);
        })->name('admin.dashboard');
    });

    //   Dashboard khusus Teknisi
    Route::middleware(['role:teknisi'])->group(function () {
        Route::get('/teknisi', function () {
            return view('dashboard.teknisi', ['role' => 'Teknisi']);
        })->name('teknisi.dashboard');
    });

    //   Dashboard khusus User
    Route::middleware(['role:user'])->group(function () {
        Route::get('/user', function () {
            return view('dashboard.user', ['role' => 'User']);
        })->name('user.dashboard');
    });
});

//   Import route bawaan Breeze (login, register, dll)
require __DIR__.'/auth.php';

