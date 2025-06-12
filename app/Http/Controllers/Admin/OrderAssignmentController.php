<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RequestModel; // Ganti dengan model permintaan Anda
use App\Models\User; // Model User untuk teknisi
use Illuminate\Http\Request;

class OrderAssignController extends Controller
{
    public function index()
    {
        // Ambil permintaan yang perlu ditugaskan (sesuaikan kondisi Anda)
        $requestsToAssign = RequestModel::where('status', 'pending') // Contoh kondisi
                                        ->orWhere('status', 'new')
                                        ->with('user', 'assignedToUser') // eager load relasi user dan assignedToUser
                                        ->paginate(10); // Atau gunakan get() jika tidak perlu paginasi

        // Ambil daftar teknisi (sesuaikan peran teknisi Anda)
        // Misalnya, user dengan peran 'technician'
        $technicians = User::whereHas('roles', function($query) {
                            $query->where('name', 'technician');
                        })->get();

        return view('admin.orders.assign-order', compact('requestsToAssign', 'technicians'));
    }

    // ... method lainnya untuk assign order
}