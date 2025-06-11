<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.user'); // Mengarah ke resources/views/dashboard/user.blade.php
    }
}