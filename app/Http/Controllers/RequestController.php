<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserRequest; // Pastikan model Request Anda di-import dengan nama yang benar, misal UserRequest

class RequestController extends Controller
{
    /**
     * Display a listing of the requests.
     */
    public function index()
    {
        // Ambil permintaan yang dibuat oleh user yang sedang login
        // Asumsi model User memiliki relasi 'requests' ke model UserRequest
        $requests = auth()->user()->requests()->latest()->paginate(10);

        return view('user.requests.index', compact('requests')); // Ini akan me-render daftar permintaan
    }

    /**
     * Show the form for creating a new request.
     */
    public function create()
    {
        return view('user.requests.create'); // Ini akan me-render form 'buat permintaan'
    }

    // Anda juga akan membutuhkan method 'store' untuk menyimpan data request
    /*
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            // Tambahkan validasi lain sesuai kolom tabel permintaan Anda
        ]);

        auth()->user()->requests()->create($validatedData); // Asumsi user memiliki relasi 'requests'

        return redirect()->route('user.requests.index')->with('success', 'Permintaan Anda berhasil diajukan!');
    }
    */
}