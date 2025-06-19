<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use App\Models\User;
use Illuminate\Http\Request;

class OrderAssignmentController extends Controller
{
    /**
     * Menampilkan halaman untuk menugaskan order.
     */
    public function index()
    {
        // Ambil semua request yang butuh perhatian
        $requests = ServiceRequest::whereIn('status', ['submitted', 'approved', 'assigned', 'pending_payment'])
                            ->with(['user', 'technician']) // Eager load relasi untuk efisiensi
                            ->latest()
                            ->paginate(10);

        // Ambil semua user yang memiliki role 'teknisi'
        $technicians = User::where('role', 'teknisi')->orderBy('name')->get();

        return view('admin.orders.assign-order', compact('requests', 'technicians'));
    }

    /**
     * Menyetujui sebuah permintaan servis.
     */
    public function approve(ServiceRequest $serviceRequest)
    {
        $serviceRequest->update(['status' => 'approved']);
        return redirect()->route('admin.orders.index')->with('success', "Permintaan #{$serviceRequest->id} telah disetujui.");
    }

    /**
     * Menugaskan teknisi ke sebuah permintaan servis.
     */
    public function assign(Request $request, ServiceRequest $serviceRequest)
    {
        $validated = $request->validate([
            'technician_id' => 'required|exists:users,id',
        ]);

        $technician = User::find($validated['technician_id']);
        if (!$technician || $technician->role !== 'teknisi') {
            return back()->with('error', 'User yang dipilih bukan teknisi.');
        }

        $serviceRequest->update([
            'assigned_to_id' => $validated['technician_id'],
            'status' => 'assigned',
        ]);     

        return redirect()->route('admin.orders.index')->with('success', "Permintaan #{$serviceRequest->id} telah ditugaskan ke {$technician->name}.");
    }

    /**
     * Menyelesaikan pesanan (setelah teknisi selesai bekerja).
     */
    public function complete(ServiceRequest $serviceRequest)
    {
        // Ubah status final menjadi 'completed'
        $serviceRequest->status = 'completed';
        $serviceRequest->save();

        // Di sini Anda bisa menambahkan logika pembuatan invoice, notifikasi ke user, dll.

        return redirect()->route('admin.orders.index')->with('success', 'Pesanan #' . $serviceRequest->id . ' telah berhasil diselesaikan dan ditutup.');
    }
}