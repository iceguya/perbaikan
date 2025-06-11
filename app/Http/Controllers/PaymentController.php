<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = \App\Models\Payment::with('order')->latest()->paginate(15);
        return view('admin.payments.index', compact('payments')); // Pastikan nama ini cocok
    }
}