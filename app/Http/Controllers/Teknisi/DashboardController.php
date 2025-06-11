<?php
namespace App\Http\Controllers\Teknisi;
use App\Http\Controllers\Controller;
class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.teknisi'); // Mengarah ke resources/views/dashboard/teknisi.blade.php
    }
}