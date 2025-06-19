<?php

namespace App\Http\Controllers; // <<<< PASTIKAN NAMESPACE INI BENAR

use Illuminate\Http\Request;
use App\Models\Order; // Pastikan ini di-import
use App\Models\User; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule; // Pastikan ini di-import

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

    public function getTechnicianOrders(Request $request)
    {
        // Mendapatkan user (teknisi) yang sedang login melalui API
        $technician = Auth::user();

        // Mengambil data pesanan dari database
        $orders = Order::where('technician_id', $technician->id)
                        ->whereIn('status', ['pending', 'in-process']) // Hanya ambil status yang relevan untuk teknisi
                        ->orderBy('created_at', 'desc')
                        ->get();

        return response()->json($orders);
    }

    /**
     * Memperbarui status dari sebuah pesanan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order  // Menggunakan Route-Model Binding
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request, Order $order)
    {
        // 1. Validasi input dari frontend
        $validated = $request->validate([
            'status' => [
                'required',
                'string',
                Rule::in(['in-process', 'pending_payment', 'completed']), // Daftar status yang diizinkan untuk diubah
            ],
        ]);
        
        // 2. Cek otorisasi (opsional, tapi sangat disarankan)
        // Pastikan teknisi yang mengubah status adalah teknisi yang ditugaskan untuk pesanan tsb.
        if (Auth::id() !== $order->technician_id) {
            return response()->json(['message' => 'Anda tidak diizinkan untuk mengubah pesanan ini.'], 403);
        }

        // 3. Update status pesanan di database
        $order->status = $validated['status'];
        $order->save();

        // Anda dapat menambahkan event atau notifikasi untuk admin di sini jika perlu

        // 4. Kirim respons sukses kembali ke frontend
        return response()->json([
            'message' => 'Status pesanan berhasil diperbarui.',
            'order' => $order,
        ]);
    }
    // ... (metode edit, update, destroy jika ada)
}