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
                                  ->paginate(10); 

        return view('user.requests.index', ['requests' => $requests]);
    }

    /**
     * Menampilkan formulir untuk membuat permintaan servis baru.
     */
    public function create()
    {
        return view('user.requests.create');
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

        $validated['user_id'] = Auth::id();

        ServiceRequest::create($validated);

        // --- PERBAIKAN DI BARIS INI ---
        return redirect()->route('user.requests.index')->with('success', 'Permintaan Anda telah berhasil dikirim!');
    }

    public function updateStatusByTechnician(Request $request, ServiceRequest $serviceRequest)
    {
        $validated = $request->validate([
            'status' => [
                'required',
                'string',
                Rule::in(['in_progress', 'pending_payment']), 
            ],
        ]);
        
        if (Auth::id() !== $serviceRequest->assigned_to_id) {
            return response()->json(['message' => 'Anda tidak berhak mengubah permintaan ini.'], 403);
        }

        $serviceRequest->status = $validated['status'];
        $serviceRequest->save();

        return response()->json([
            'message' => 'Status permintaan berhasil diperbarui.',
            'service_request' => $serviceRequest,
        ]);
    }
}