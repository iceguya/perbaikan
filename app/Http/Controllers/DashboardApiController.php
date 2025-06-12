<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order; // Pastikan model Order di-import
use App\Models\Payment; // Pastikan model Payment di-import
use Illuminate\Support\Facades\Log; // Import Log facade
// use App\Models\ActivityLog; // Jika Anda punya model ActivityLog, import di sini

class DashboardApiController extends Controller
{
    /**
     * Mengambil statistik pesanan.
     */
    public function getOrderStats()
    {
        try {
            $today = now()->today();
            $startOfMonth = now()->startOfMonth();

            $todayOrders = Order::whereDate('created_at', $today)->count();
            $monthOrders = Order::whereMonth('created_at', $startOfMonth)->count();
            $pendingOrders = Order::where('status', 'pending')->count();
            $completedOrders = Order::where('status', 'completed')->count();

            return response()->json([
                'todayOrders' => $todayOrders,
                'monthOrders' => $monthOrders,
                'pendingOrders' => $pendingOrders,
                'completedOrders' => $completedOrders,
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching order stats: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch order stats'], 500);
        }
    }

    /**
     * Mengambil rekap pemasukan.
     */
    public function getRevenueRecap()
    {
        try {
            $today = now()->today();
            $startOfMonth = now()->startOfMonth();

            // Hitung pendapatan (total amount dari pembayaran yang selesai)
            $todayRevenue = Payment::whereDate('payment_date', $today)
                                   ->where('status', 'completed')
                                   ->sum('amount');

            $monthRevenue = Payment::whereMonth('payment_date', $startOfMonth)
                                   ->where('status', 'completed')
                                   ->sum('amount');

            // Hitung keuntungan bersih (ini asumsi, sesuaikan dengan logika bisnis Anda)
            // Contoh sederhana: Keuntungan bersih adalah 30% dari pendapatan
            $todayProfit = $todayRevenue * 0.30;
            $monthProfit = $monthRevenue * 0.30;

            return response()->json([
                'todayRevenue' => $todayRevenue,
                'monthRevenue' => $monthRevenue,
                'todayProfit' => $todayProfit,
                'monthProfit' => $monthProfit,
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching revenue recap: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch revenue recap'], 500);
        }
    }

    /**
     * Mengambil daftar pesanan untuk penugasan teknisi.
     */
    public function getTechnicianOrders()
    {
        try {
            // Mengambil pesanan yang masih pending atau baru ditugaskan (belum selesai)
            $orders = Order::whereIn('status', ['pending', 'assigned', 'awaiting_assignment'])
                            ->latest()
                            ->limit(5)
                            ->get(['id', 'status']);

            return response()->json($orders);
        } catch (\Exception $e) {
            Log::error('Error fetching technician orders: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch technician orders'], 500);
        }
    }

    /**
     * Mengambil statistik pengguna.
     */
    public function getUserStats()
    {
        try {
            $totalUsers = User::count();
            // Asumsi kolom 'last_login_at' ada di tabel users, atau kamu bisa pakai 'created_at'
            $activeUsersToday = User::whereDate('last_login_at', now()->today())->count();
            // Jika 'last_login_at' tidak ada dan kamu tidak ingin menambahkannya, gunakan ini:
            // $activeUsersToday = User::whereDate('created_at', now()->today())->count();

            return response()->json([
                'totalUsers' => $totalUsers,
                'activeUsersToday' => $activeUsersToday,
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching user stats: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch user stats'], 500);
        }
    }

    /**
     * Mengambil log aktivitas terbaru.
     */
    public function getActivityLog()
    {
        try {
            // Ini adalah bagian yang paling mungkin menyebabkan error jika model atau tabel 'ActivityLog' tidak ada.
            // Jika Anda tidak memiliki sistem log aktivitas khusus, ini mungkin perlu disesuaikan.
            // Contoh sederhana: Mengambil log dari user yang baru terdaftar atau order yang baru dibuat.
            // Jika Anda memiliki model ActivityLog, import di atas: use App\Models\ActivityLog;
            // $logs = ActivityLog::latest()->limit(5)->get(['description', 'created_at']);

            // Alternatif jika tidak ada model ActivityLog khusus:
            $logs = [
                ['description' => 'User Admin Utama login.', 'created_at' => now()->subMinutes(5)->toDateTimeString()],
                ['description' => 'Pesanan #'. Order::latest()->first()?->id . ' baru dibuat.', 'created_at' => now()->subMinutes(10)->toDateTimeString()],
                ['description' => 'Pembayaran #'. Payment::latest()->first()?->id . ' berhasil.', 'created_at' => now()->subMinutes(15)->toDateTimeString()],
                ['description' => 'User Teknisi A login.', 'created_at' => now()->subMinutes(20)->toDateTimeString()],
                ['description' => 'Pengguna baru terdaftar: ' . User::latest()->first()?->name . '.', 'created_at' => now()->subMinutes(25)->toDateTimeString()],
            ];

            // Filter agar hanya menampilkan 5 log terbaru
            $logs = array_slice($logs, 0, 5);


            // Jika Anda punya model ActivityLog, gunakan ini:
            // $logs = ActivityLog::latest()->limit(5)->get(['description']);
            // Pastikan kolom 'description' ada.

            return response()->json($logs);
        } catch (\Exception $e) {
            Log::error('Error fetching activity log: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch activity log'], 500);
        }
    }

    public function getTechnicianSpecificOrders(Request $request)
{
    try {
        $user = $request->user();

        if ($user->role !== 'teknisi') {
            return response()->json(['message' => 'Akses ditolak.'], 403);
        }

        // Ganti Model dari Order ke ServiceRequest dan sesuaikan nama kolom
        $orders = ServiceRequest::where('assigned_to_id', $user->id) // Kolom yang benar adalah 'assigned_to_id'
                       ->whereIn('status', ['assigned', 'in_progress']) // Hanya tampilkan yang relevan
                       ->with('user') // Ambil data user pembuat request
                       ->orderBy('created_at', 'desc')
                       ->get();

        $formattedOrders = $orders->map(function ($order) {
            $statusMapping = [
                'assigned' => 'in-process', // Map 'assigned' dari backend ke 'in-process' untuk display di frontend
                'in_progress' => 'in-process',
            ];

            return [
                'id' => 'REQ-'.$order->id,
                'description' => $order->description,
                'status' => $statusMapping[$order->status] ?? $order->status,
                'details' => 'Dari: ' . ($order->user->name ?? 'N/A') . ' | Perangkat: ' . $order->device_type,
            ];
        });

        return response()->json($formattedOrders);

    } catch (\Exception $e) {
        \Log::error('Error fetching technician specific orders: ' . $e->getMessage());
        return response()->json(['error' => 'Gagal memuat pesanan teknisi.'], 500);
    }
}

}