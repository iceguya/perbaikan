<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  // import Auth facade

class DashboardController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();  // gunakan Auth facade

        if (!$user) {
            return redirect('/login');
        }

        // contoh cek role, bisa kamu modifikasi sesuai kebutuhan
        if ($user->role === 'admin') {
            return view('dashboard.admin');
        } elseif ($user->role === 'teknisi') {
            return view('dashboard.teknisi');
        } elseif ($user->role === 'user') {
            return view('dashboard.user');
        } else {
            abort(403, 'Role tidak dikenali');
        }
    }

    
}
