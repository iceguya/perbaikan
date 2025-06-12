<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserRequest; // Sesuaikan dengan nama model Anda

class RequestController extends Controller
{
    // ... (metode index, create)

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'device_type' => 'nullable|string|max:255',
            'brand' => 'nullable|string|max:255',
            'model_number' => 'nullable|string|max:255',
            'description' => 'required|string|min:10',
        ]);

        $requestData = array_merge($validatedData, [
            'user_id' => auth()->id(),
            'status' => 'pending', // <<< PASTIKAN STATUS DEFAULT INI DIISI (misal: 'pending', 'new', 'submitted')
            'assigned_to_user_id' => null, // Pastikan awalnya null
        ]);

        UserRequest::create($requestData); // Simpan ke tabel 'service_requests'

        return redirect()->route('user.requests.index')->with('success', 'Permintaan Anda berhasil diajukan!');
    }
}