<?php

namespace App\Http\Controllers\Technician;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use App\Models\User; // <-- Tambahkan ini
use App\Notifications\WorkOrderCompleted; // <-- Tambahkan ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification; // <-- Tambahkan ini

class WorkOrderController extends Controller
{
    // ... method index() ...

    /**
     * Memperbarui status work order.
     */
    public function updateStatus(Request $request, ServiceRequest $serviceRequest)
    {
        if ($serviceRequest->assigned_to_id !== Auth::id()) {
            abort(403, 'Anda tidak berhak mengubah status permintaan ini.');
        }

        $validated = $request->validate([
            'status' => 'required|string|in:in_progress,completed',
        ]);

        $serviceRequest->update(['status' => $validated['status']]);

        // === BAGIAN BARU: Kirim notifikasi jika statusnya 'completed' ===
        if ($validated['status'] === 'completed') {
            $admins = User::where('role', 'admin')->get();
            Notification::send($admins, new WorkOrderCompleted($serviceRequest));
        }
        // === AKHIR BAGIAN BARU ===

        return redirect()->route('teknisi.work-orders.index')->with('success', 'Status Work Order #' . $serviceRequest->id . ' berhasil diperbarui.');
    }
}