<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardApiController; // Import controller API
use App\Http\Controllers\UserController;       // Import controller User
use App\Http\Controllers\User\RequestController;
use App\Http\Controllers\OrderController;

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

    // Dashboard dan fitur khusus Admin
    // Pastikan 'admin.dashboard' mengarah ke view dashboard yang sebenarnya Anda gunakan
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin', function () {
            // Ini akan me-render dashboard admin yang sudah kamu buat sebelumnya
            // Jika dashboard admin adalah layout utama, maka bisa langsung return view
            return view('dashboard.admin');
            Route::get('/assign-orders', [OrderController::class, 'adminAssignOrders'])->name('admin.assign_orders.index'); // Ganti 'dashboard.admin' jika nama view Anda 'admin.dashboard'
        })->name('admin.dashboard');

        // Route untuk Manajemen Pembayaran (hanya bisa diakses Admin)
        Route::get('/manage-payments', [PaymentController::class, 'index'])->name('payments.index');

        // Route untuk Manajemen Pengguna (hanya bisa diakses Admin)
        Route::get('/manage-users', [UserController::class, 'index'])->name('users.index'); // <-- Ini yang ditambahkan
        Route::get('/manage-users/{user}/edit', [UserController::class, 'edit'])->name('users.edit'); // Tampilkan form edit
        Route::put('/manage-users/{user}', [UserController::class, 'update'])->name('users.update'); // Proses update data
        Route::delete('/manage-users/{user}', [UserController::class, 'destroy'])->name('users.destroy'); // Proses hapus data
        // Anda bisa menambahkan rute admin lain di sini
        // Contoh: Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders');
    });

    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin', function () {
            return view('dashboard.admin');
        })->name('admin.dashboard');
    
        // ... route admin lainnya
        
        // RUTE BARU UNTUK MANAJEMEN ORDER
        Route::get('/admin/assign-orders', [App\Http\Controllers\Admin\OrderAssignmentController::class, 'index'])->name('admin.orders.index');
        Route::patch('/admin/orders/{serviceRequest}/approve', [App\Http\Controllers\Admin\OrderAssignmentController::class, 'approve'])->name('admin.orders.approve');
        Route::post('/admin/orders/{serviceRequest}/assign', [App\Http\Controllers\Admin\OrderAssignmentController::class, 'assign'])->name('admin.orders.assign');
    });

    // Dashboard dan fitur khusus Teknisi
    Route::middleware(['role:teknisi'])->group(function () {
        Route::get('/teknisi', function () {
            // Ganti 'dashboard.teknisi' jika nama view Anda berbeda
            return view('dashboard.teknisi', ['role' => 'Teknisi']);
        })->name('teknisi.dashboard');
        // Tambahkan rute teknisi lainnya di sini
        Route::get('/api/teknisi-orders', [DashboardApiController::class, 'getTechnicianSpecificOrders'])->name('api.teknisi.orders');
    });

    // Dashboard dan fitur khusus User
    Route::middleware(['role:user'])->group(function () {
        Route::get('/user', function () {
            return view('dashboard.user', ['role' => 'User']);
        })->name('user.dashboard');
        
        // Rute untuk Submit dan My Requests
        Route::get('/my-requests', [App\Http\Controllers\ServiceRequestController::class, 'index'])->name('requests.index');
        Route::get('/requests/create', [App\Http\Controllers\ServiceRequestController::class, 'create'])->name('requests.create');
        Route::post('/requests', [App\Http\Controllers\ServiceRequestController::class, 'store'])->name('requests.store');
    });

    // =========================================================================
    // API Dashboard (TEMPATKAN DI SINI JIKA MAU DIAUTENTIKASI DULU)
    // Jika API ini hanya untuk data dashboard yang diakses dari frontend yang sudah login,
    // maka letakkan di dalam middleware 'auth' seperti ini.
    // Pastikan juga Anda sudah mengimpor DashboardApiController di atas.
    // =========================================================================
    Route::get('/api/order-stats', [DashboardApiController::class, 'getOrderStats']);
    Route::get('/api/revenue-recap', [DashboardApiController::class, 'getRevenueRecap']);
    Route::get('/api/technician-orders', [DashboardApiController::class, 'getTechnicianOrders']);
    Route::get('/api/user-stats', [DashboardApiController::class, 'getUserStats']); // Data statistik user untuk dashboard
    Route::get('/api/activity-log', [DashboardApiController::class, 'getActivityLog']);
    Route::get('/assign-orders', [OrderController::class, 'adminAssignOrders'])->name('admin.assign_orders.index');
    Route::get('/work-orders', [OrderController::class, 'indexForTechnician'])->name('teknisi.work_orders.index');
// ...

    Route::middleware(['role:teknisi'])->group(function () {
        Route::get('/api/teknisi-orders', [DashboardApiController::class, 'getTechnicianSpecificOrders'])->name('api.teknisi.orders');
    });
});


// Import route bawaan Breeze (login, register, dll)
require __DIR__.'/auth.php';