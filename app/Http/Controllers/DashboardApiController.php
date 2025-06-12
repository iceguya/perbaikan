<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order; // Pastikan model Order di-import
use App\Models\Payment; 
use App\Models\UserRequest;// Pastikan model Payment di-import
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
            // Ambil service requests yang belum ditugaskan atau masih pending
            $requests = UserRequest::whereIn('status', ['pending', 'new', 'submitted']) // <<< AMBIL DARI UserRequest
                                ->with('user') // Eager load user yang mengajukan
                                ->latest()
                                ->limit(5)
                                ->get([
                                    'id',
                                    'description',
                                    'status',
                                    'user_id', // Penting untuk relasi user
                                ]);

            $formattedRequests = $requests->map(function ($requestItem) {
                $userName = $requestItem->user ? $requestItem->user->name : 'Pengguna Tidak Dikenal';
                return [
                    'id' => $requestItem->id,
                    'description' => $requestItem->description,
                    'status' => $requestItem->status,
                    'requested_by' => $userName, // Menambahkan info pemohon
                ];
            });

            return response()->json($formattedRequests);

        } catch (\Exception $e) {
            \Log::error('Error fetching admin pending requests: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch pending requests.'], 500);
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
                return response()->json(['message' => 'Akses ditolak. Hanya teknisi yang bisa melihat pesanan ini.'], 403);
            }

            // Ambil service requests yang ditugaskan kepada teknisi ini
            $requests = UserRequest::where('assigned_to_user_id', $user->id) // <<< AMBIL DARI UserRequest
                           ->whereNotIn('status', ['completed', 'canceled', 'rejected'])
                           ->orderBy('created_at', 'desc')
                           ->get([
                               'id',
                               'description',
                               'status',
                               'device_type', // Contoh: tampilkan jenis alat
                           ]);

            $formattedRequests = $requests->map(function ($requestItem) {
                $statusMapping = [
                    'pending' => 'pending',
                    'new' => 'pending',
                    'submitted' => 'pending',
                    'assigned' => 'in-process',
                    'in_progress' => 'in-process',
                    'completed' => 'completed',
                ];

                return [
                    'id' => $requestItem->id,
                    'description' => $requestItem->description,
                    'status' => $statusMapping[$requestItem->status] ?? $requestItem->status,
                    'details' => 'Jenis Alat: ' . ($requestItem->device_type ?? 'N/A'),
                ];
            });

            return response()->json($formattedRequests);

        } catch (\Exception $e) {
            \Log::error('Error fetching technician specific requests: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch technician requests.'], 500);
        } catch (\Exception $e) {
        \Log::error('Error fetching technician specific orders: ' . $e->getMessage());
        return response()->json(['error' => 'Gagal memuat pesanan teknisi.'], 500);
    }
}
    use App\Models\UserRequest; // Sesuaikan dengan nama model Anda

public function store(Request $request)
{
    $validatedData = $request->validate([
        'device_type' => 'nullable|string|max:255',
        'brand' => 'nullable|string|max:255',
        'model_number' => 'nullable|string|max:255',
        'description' => 'required|string|min:10',
        // ... validasi kolom lain
    ]);

    $requestData = array_merge($validatedData, [
        'user_id' => auth()->id(),
        'status' => 'pending', // <<< PASTIKAN STATUS DEFAULT INI DIISI DI SINI
        // Atau 'status' => 'new_request' atau 'submitted'
    ]);

    UserRequest::create($requestData); // Simpan ke tabel 'service_requests'

    return redirect()->route('user.requests.index')->with('success', 'Permintaan Anda berhasil diajukan!');
}


}