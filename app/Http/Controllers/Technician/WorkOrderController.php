<?php

namespace App\Http\Controllers\Technician;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceRequest;
use Illuminate\Support\Facades\Auth;

class WorkOrderController extends Controller
{
    /**
     * Menandai sebuah Service Request sebagai selesai oleh teknisi.
     *
     * @param  \App\Models\ServiceRequest  $serviceRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function complete(ServiceRequest $serviceRequest)
    {
        // 1. Otorisasi: Pastikan teknisi yang login adalah yang ditugaskan
        if (Auth::id() !== $serviceRequest->assigned_to_id) {
            return redirect()->route('teknisi.dashboard')->with('error', 'Anda tidak berhak mengubah status permintaan ini.');
        }

        // 2. Ubah status menjadi 'pending_payment'
        // Ini menandakan pekerjaan teknis selesai dan sekarang menunggu proses dari admin (pembayaran).
        $serviceRequest->status = 'pending_payment';
        $serviceRequest->save();
        
        // Opsional: Anda bisa menambahkan event atau notifikasi ke Admin di sini.

        // 3. Redirect kembali ke dashboard teknisi dengan pesan sukses
        return redirect()->route('teknisi.dashboard')->with('success', "Permintaan #{$serviceRequest->id} telah ditandai selesai.");
    }
}