<?php

// app/Http/Controllers/ServiceRequestController.php
namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ServiceRequestController extends Controller
{
    /**
     * Menampilkan daftar permintaan servis milik user yang sedang login.
     */
    public function index()
    {
        $requests = ServiceRequest::where('user_id', Auth::id())
                                  ->latest()
                                  ->paginate(10); // Menampilkan 10 item per halaman

        return view('requests.index', ['requests' => $requests]);
    }

    /**
     * Menampilkan formulir untuk membuat permintaan servis baru.
     */
    public function create()
    {
        return view('requests.create');
    }

    /**
     * Menyimpan permintaan servis baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'device_type' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'model_number' => 'nullable|string|max:255',
            'description' => 'required|string|min:20',
        ]);

        // Tambahkan user_id dari user yang sedang login
        $validated['user_id'] = Auth::id();

        ServiceRequest::create($validated);

        return redirect()->route('requests.index')->with('success', 'Permintaan Anda telah berhasil dikirim!');
    }

    public function updateStatusByTechnician(Request $request, ServiceRequest $serviceRequest)
    {
        // 1. Validasi input dari frontend
        $validated = $request->validate([
            'status' => [
                'required',
                'string',
                // Status yang diizinkan untuk diubah oleh teknisi
                Rule::in(['in_progress', 'pending_payment']), 
            ],
        ]);
        
        // 2. Otorisasi: Pastikan user yang login adalah teknisi yang ditugaskan
        if (Auth::id() !== $serviceRequest->assigned_to_id) {
            return response()->json(['message' => 'Anda tidak berhak mengubah permintaan ini.'], 403);
        }

        // 3. Update status di database
        $serviceRequest->status = $validated['status'];
        $serviceRequest->save();

        // 4. Beri respons sukses
        return response()->json([
            'message' => 'Status permintaan berhasil diperbarui.',
            'service_request' => $serviceRequest,
        ]);
        dd(Auth::id(), $serviceRequest->assigned_to_id); 
    }
}