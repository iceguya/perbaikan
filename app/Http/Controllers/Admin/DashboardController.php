<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.admin'); // Mengarah ke resources/views/dashboard/admin.blade.php
    }
}