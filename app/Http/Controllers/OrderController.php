<?php

namespace App\Http\Controllers; // <<<< PASTIKAN NAMESPACE INI BENAR

use Illuminate\Http\Request;
use App\Models\Order; // Pastikan ini di-import
use App\Models\User;  // Pastikan ini di-import

class OrderController extends Controller // <<<< PASTIKAN NAMA KELAS INI BENAR
{
    // Ini adalah metode yang kita bahas sebelumnya
    public function adminAssignOrders()
    {
        try {
            $ordersToAssign = Order::whereIn('status', ['pending', 'awaiting_assignment'])
                                    ->orderBy('created_at', 'asc')
                                    ->paginate(10);

            $technicians = User::where('role', 'teknisi')->get(['id', 'name']);

            return view('admin.assign_orders.manage-assignments', compact('ordersToAssign', 'technicians'));
        } catch (\Exception $e) {
            \Log::error('Error in OrderController@adminAssignOrders: ' . $e->getMessage());
            abort(500, 'Terjadi kesalahan saat memuat halaman penugasan. Cek log server.');
        }
    }

    // Metode lain seperti indexForTechnician, dll.
    public function indexForTechnician()
    {
        // ... (logika indexForTechnician)
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);
        return view('teknisi.work-orders', compact('orders'));
    }

    // ... (metode edit, update, destroy jika ada)
}