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
        // Ambil semua request yang butuh perhatian (baru disubmit atau sudah diapprove)
        // Di dalam method index() di OrderAssignmentController.php
    $requests = ServiceRequest::whereIn('status', ['submitted', 'approved', 'pending_payment']) // <-- TAMBAHKAN INI
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
        // Ubah status menjadi 'approved'
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

        // Pastikan user yang dipilih adalah teknisi (keamanan tambahan)
        $technician = User::find($validated['technician_id']);
        if (!$technician || $technician->role !== 'teknisi') {
            return back()->with('error', 'User yang dipilih bukan teknisi.');
        }

        // Update request dengan ID teknisi dan ubah status menjadi 'assigned'
        $serviceRequest->update([
            'assigned_to_id' => $validated['technician_id'],
            'status' => 'assigned',
        ]);     

        return redirect()->route('admin.orders.index')->with('success', "Permintaan #{$serviceRequest->id} telah ditugaskan ke {$technician->name}.");
    }

    public function complete(ServiceRequest $serviceRequest)
{
    // Ubah status menjadi 'completed'
    $serviceRequest->status = 'completed';
    $serviceRequest->save();

    // Tambahkan logika lain jika perlu, misalnya membuat invoice, dll.

    return redirect()->route('admin.orders.index')->with('success', 'Pesanan #' . $serviceRequest->id . ' telah berhasil diselesaikan.');
}
}