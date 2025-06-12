<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Order; // Tidak lagi digunakan di sini jika menampilkan requests
use App\Models\User;
use App\Models\UserRequest; // <<< IMPORT MODEL UserRequest (sesuaikan nama)

class OrderController extends Controller
{
    /**
     * Menampilkan daftar semua service requests untuk teknisi (Work Orders).
     */
    public function indexForTechnician()
    {
        $requests = UserRequest::with(['user', 'assignedToUser']) // Eager load pemohon dan teknisi yang ditugaskan
                            ->orderBy('created_at', 'desc')
                            ->paginate(10); // Paginasi

        // Ubah variabel yang dikirimkan ke view
        return view('teknisi.work-orders', compact('requests'));
    }

    public function assignOrder()
{
    // ... kode Anda untuk mengambil data requestsToAssign
    // Pastikan Anda mendapatkan data ini dari database atau sumber lain
    // Jika tidak ada data yang ditemukan, pastikan $requestsToAssign tetap didefinisikan sebagai array kosong
    $requestsToAssign = []; // Inisialisasi awal, atau ambil dari database
    // Contoh mengambil dari database:
    // $requestsToAssign = RequestModel::where('status', 'pending_assignment')->get();

    // Pastikan Anda melewatkan variabel ini ke view
    return view('admin.orders.assign-order', compact('requestsToAssign'));
    // ATAU
    // return view('admin.orders.assign-order')->with('requestsToAssign', $requestsToAssign);
}

    // ... (metode adminAssignOrders, assign)
}