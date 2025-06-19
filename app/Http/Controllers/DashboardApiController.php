<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ServiceRequest; // Ganti Order dengan ServiceRequest
use App\Models\Payment;
use Illuminate\Support\Facades\Log;

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

            // Menggunakan model ServiceRequest
            $todayOrders = ServiceRequest::whereDate('created_at', $today)->count();
            $monthOrders = ServiceRequest::whereMonth('created_at', $startOfMonth)->count();
            $pendingOrders = ServiceRequest::where('status', 'submitted')->count();
            $completedOrders = ServiceRequest::where('status', 'completed')->count();

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

            $todayRevenue = Payment::whereDate('payment_date', now()->today())
                               ->where('status', 'completed') // <-- HANYA MENGAMBIL YANG COMPLETED
                               ->sum('amount');

        $monthRevenue = Payment::whereMonth('payment_date', now()->startOfMonth())
                               ->where('status', 'completed') // <-- HANYA MENGAMBIL YANG COMPLETED
                               ->sum('amount');

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
     * Mengambil daftar pesanan untuk penugasan (Untuk Dashboard Admin).
     */
    public function getTechnicianOrders()
    {
        try {
            // Menggunakan ServiceRequest dan status baru
            $orders = ServiceRequest::whereIn('status', ['submitted', 'approved'])
                            ->latest()
                            ->limit(5)
                            ->get(['id', 'status']);

            return response()->json($orders);
        } catch (\Exception $e) {
            Log::error('Error fetching admin orders view: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch admin orders view'], 500);
        }
    }

    /**
     * Mengambil statistik pengguna.
     */
    public function getUserStats()
    {
        try {
            $totalUsers = User::count();
            $activeUsersToday = User::whereDate('last_login_at', now()->today())->count();

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
            // Menggunakan data dari ServiceRequest
            $latestRequest = ServiceRequest::with('user')->latest()->first();
            $latestPayment = Payment::latest()->first();
            $latestUser = User::latest()->first();

            $logs = [];
            if ($latestRequest) {
                $logs[] = ['description' => 'Permintaan #' . $latestRequest->id . ' baru dibuat oleh ' . ($latestRequest->user->name ?? 'user') . '.', 'created_at' => $latestRequest->created_at->toDateTimeString()];
            }
            if ($latestPayment) {
                $logs[] = ['description' => 'Pembayaran #' . $latestPayment->id . ' berhasil.', 'created_at' => $latestPayment->created_at->toDateTimeString()];
            }
            if ($latestUser) {
                $logs[] = ['description' => 'Pengguna baru terdaftar: ' . $latestUser->name . '.', 'created_at' => $latestUser->created_at->toDateTimeString()];
            }
            
            // Urutkan berdasarkan waktu dan ambil 5 teratas
            usort($logs, fn($a, $b) => strtotime($b['created_at']) - strtotime($a['created_at']));
            $logs = array_slice($logs, 0, 5);
            
            return response()->json($logs);
        } catch (\Exception $e) {
            Log::error('Error fetching activity log: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch activity log'], 500);
        }
    }

    /**
     * Mengambil daftar pesanan SPESIFIK untuk teknisi yang sedang login.
     */
    public function getTechnicianSpecificOrders(Request $request)
    {
        try {
            $user = $request->user();

            if ($user->role !== 'teknisi') {
                return response()->json(['message' => 'Akses ditolak.'], 403);
            }

            $orders = ServiceRequest::where('assigned_to_id', $user->id)
                           ->whereIn('status', ['assigned', 'in_progress'])
                           ->with('user')
                           ->orderBy('created_at', 'desc')
                           ->get();

            $formattedOrders = $orders->map(function ($order) {
                $statusMapping = [
                    'assigned' => 'in-process',
                    'in_progress' => 'in-process',
                ];

                return [
                    'id' => 'REQ-'.$order->id,
                    'description' => $order->description,
                    'status' => $statusMapping[$order->status] ?? $order->status,
                    'details' => 'Dari: ' . ($order->user ? $order->user->name : 'User Dihapus') . ' | Perangkat: ' . $order->device_type,
                ];
            });

            return response()->json($formattedOrders);

        } catch (\Exception $e) {
            Log::error('Error fetching technician specific orders: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal memuat pesanan teknisi.'], 500);
        }
    }
}