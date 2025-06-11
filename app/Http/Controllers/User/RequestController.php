<?php
// File: app/Http/Controllers/User/RequestController.php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest; // Pastikan model di-import
use Illuminate\Http\Request;

class RequestController extends Controller
{
    /**
     * Menampilkan halaman "My Requests" dengan data dari database.
     */
    public function index()
    {
        // Ambil semua request milik user yang sedang login, urutkan dari yang terbaru
        $requests = auth()->user()->serviceRequests()->latest()->get();
        
        // Kirim data variabel $requests ke view
        return view('user.requests.index', ['requests' => $requests]);
    }

    /**
     * Menampilkan form "Submit Request".
     */
    public function create()
    {
        return view('user.requests.create');
    }

    /**
     * Memvalidasi dan menyimpan data dari form ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'device_type' => 'required|string|max:100',
            'brand'       => 'required|string|max:100',
            'series'      => 'nullable|string|max:100',
            'complaint'   => 'required|string|min:20',
        ]);

        // Simpan data ke database menggunakan relasi
        auth()->user()->serviceRequests()->create([
            'device_type' => $validatedData['device_type'],
            'brand'       => $validatedData['brand'],
            'series_model'=> $validatedData['series'], // sesuaikan dengan nama kolom di migrasi
            'description' => $validatedData['complaint'],
            'status'      => 'pending', // Status awal saat dibuat
        ]);

        // Redirect ke halaman "My Requests" dengan pesan sukses
        return redirect()->route('user.requests.index')->with('status', 'Permintaan servis Anda telah berhasil dikirim!');
    }
}