<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardApiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\OrderAssignmentController;
use App\Http\Controllers\Technician\WorkOrderController;
use App\Http\Controllers\ServiceRequestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini Anda dapat mendaftarkan rute web untuk aplikasi Anda. Rute-rute ini
| dimuat oleh RouteServiceProvider dan semuanya akan ditugaskan ke
| grup middleware "web". Buat sesuatu yang hebat!
|
*/

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Otomatis redirect ke dashboard sesuai role setelah login
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

    // ===================================================================
    // GRUP ROUTE UNTUK ADMIN
    // ===================================================================
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', function () { return view('dashboard.admin'); })->name('dashboard');
        
        // Manajemen Order
        Route::get('/orders', [OrderAssignmentController::class, 'index'])->name('orders.index');
        Route::patch('/orders/{serviceRequest}/approve', [OrderAssignmentController::class, 'approve'])->name('orders.approve');
        Route::post('/orders/{serviceRequest}/assign', [OrderAssignmentController::class, 'assign'])->name('orders.assign');
        Route::patch('/orders/{serviceRequest}/complete', [OrderAssignmentController::class, 'complete'])->name('orders.complete');

        // Manajemen Pengguna
        Route::get('/users', [UserController::class, 'index'])->name('users.index'); // Nama asli: admin.users.index
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

        // Manajemen Pembayaran
        Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');

        // Rute baru untuk approve pembayaran
        Route::patch('/payments/{payment}/approve', [PaymentController::class, 'approve'])->name('payments.approve');
    });

    // ===================================================================
    // GRUP ROUTE UNTUK TEKNISI
    // ===================================================================
    Route::middleware(['role:teknisi'])->prefix('teknisi')->name('teknisi.')->group(function () {
        Route::get('/', function () { return view('dashboard.teknisi'); })->name('dashboard');
        
        // Rute untuk teknisi menandai pekerjaan selesai
        Route::patch('/work-orders/{serviceRequest}/complete', [WorkOrderController::class, 'complete'])->name('work-orders.complete');
    });

    // ===================================================================
    // GRUP ROUTE UNTUK USER BIASA
    // ===================================================================
    Route::middleware(['role:user'])->prefix('user')->name('user.')->group(function () {
        Route::get('/', function () { return view('dashboard.user'); })->name('dashboard');
        
        // Rute untuk membuat dan melihat permintaan servis
        Route::get('/requests', [ServiceRequestController::class, 'index'])->name('requests.index');
        Route::get('/requests/create', [ServiceRequestController::class, 'create'])->name('requests.create');
        Route::post('/requests', [ServiceRequestController::class, 'store'])->name('requests.store');

        Route::get('/requests/{serviceRequest}/pay', [PaymentController::class, 'createForUser'])->name('payments.create');
        Route::post('/requests/{serviceRequest}/pay', [PaymentController::class, 'storeFromUser'])->name('payments.store');
    });

});


// ===================================================================
// GRUP ROUTE UNTUK SEMUA API
// ===================================================================
Route::middleware('auth')->prefix('api')->name('api.')->group(function() {
    Route::get('/order-stats', [DashboardApiController::class, 'getOrderStats'])->name('order-stats');
    Route::get('/revenue-recap', [DashboardApiController::class, 'getRevenueRecap'])->name('revenue-recap');
    Route::get('/user-stats', [DashboardApiController::class, 'getUserStats'])->name('user-stats');
    Route::get('/activity-log', [DashboardApiController::class, 'getActivityLog'])->name('activity-log');

    // API untuk dashboard admin melihat order yang perlu diassign
    Route::get('/technician-orders-view', [DashboardApiController::class, 'getTechnicianOrders'])->name('technician-orders-view');
    
    // API KHUSUS untuk teknisi mengambil data pekerjaannya
    Route::get('/teknisi/orders', [DashboardApiController::class, 'getTechnicianSpecificOrders'])->name('teknisi.orders');
});


// Import route bawaan Breeze (login, register, dll)
require __DIR__.'/auth.php';