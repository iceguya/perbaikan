<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    /**
     * Menampilkan daftar pembayaran untuk Admin.
     */
    public function index()
    {
        $payments = Payment::with('serviceRequest')->latest()->paginate(15);
        return view('admin.payments.index', compact('payments'));
    }

    /**
     * Menampilkan halaman pembayaran untuk User.
     */
    public function createForUser(ServiceRequest $serviceRequest)
    {
        // Pastikan hanya request yang menunggu pembayaran yang bisa diakses
        if ($serviceRequest->status !== 'pending_payment') {
            abort(404);
        }
        return view('user.payments.create', compact('serviceRequest'));
    }

    /**
     * Menyimpan data pembayaran dari User.
     */
    // File: app/Http/Controllers/PaymentController.php

    public function storeFromUser(Request $request, ServiceRequest $serviceRequest)
    {
        // Validasi input
        $validated = $request->validate([
            'amount' => 'required|numeric',
            'payment_method' => 'required|string',
            'proof_of_payment' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Proses penyimpanan file
        $path = $request->file('proof_of_payment')->store('proofs', 'public');

        // Buat record pembayaran
        $newPayment = Payment::create([
            'service_request_id' => $serviceRequest->id,
            'amount' => $validated['amount'],
            'payment_method' => $validated['payment_method'],
            'proof_of_payment_path' => $path,
            'status' => 'pending',
            'payment_date' => now(),
        ]);

        // dd($newPayment); // <-- TAMPILKAN HASIL DARI DATABASE

        // Baris redirect di bawah ini tidak akan dieksekusi
        return redirect()->route('user.requests.index')->with('success', 'Bukti pembayaran Anda telah berhasil diunggah...');
    }

    /**
     * Menyetujui pembayaran oleh Admin.
     */
    public function approve(Payment $payment)
    {
        // 1. Ubah status pembayaran menjadi 'completed'
        $payment->status = 'completed';
        $payment->save();

        // 2. Cari service request terkait dan ubah statusnya juga
        $serviceRequest = $payment->serviceRequest;
        if ($serviceRequest) {
            $serviceRequest->status = 'completed';
            $serviceRequest->save();
        }

        return redirect()->route('admin.payments.index')->with('success', '...');
    }
}