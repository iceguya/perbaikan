<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Service; // Jika Anda punya model Service, import di sini
// use App\Models\Category; // Jika Anda punya model Category, import di sini

class ServiceController extends Controller
{
    /**
     * Display a listing of services by category.
     *
     * @param string $categorySlug
     */
    public function showByCategory($categorySlug)
    {
        // Logika untuk mengambil layanan berdasarkan $categorySlug
        // Contoh: $services = Service::whereHas('category', function($query) use ($categorySlug) {
        //              $query->where('slug', $categorySlug);
        //         })->paginate(10);

        // Untuk sementara, kita bisa passing data dummy atau menampilkan pesan
        $services = collect([ // Dummy data
            (object)['id' => 1, 'name' => 'Perbaikan ' . ucfirst($categorySlug), 'description' => 'Layanan perbaikan ' . $categorySlug . ' terbaik.', 'price' => 'Rp 200.000'],
            (object)['id' => 2, 'name' => 'Maintenance ' . ucfirst($categorySlug), 'description' => 'Perawatan rutin untuk ' . $categorySlug . '.', 'price' => 'Rp 100.000']
        ]);
        // Pastikan Anda membuat model Service dan Category, serta migrasinya jika ingin data dinamis
        // Dan relasi di model Service ke Category.

        return view('user.services.category', compact('services', 'categorySlug'));
    }

    /**
     * Display a listing of all services (for "Lihat Semua").
     */
    public function index()
    {
        // Logika untuk mengambil semua layanan
        // Contoh: $services = Service::latest()->paginate(15);

        $services = collect([ // Dummy data
            (object)['id' => 1, 'name' => 'Instal Ulang Windows', 'category' => 'Laptop/PC', 'price' => 'Rp 150.000'],
            (object)['id' => 2, 'name' => 'Ganti LCD Smartphone', 'category' => 'Smartphone', 'price' => 'Mulai Rp 350.000'],
            (object)['id' => 3, 'name' => 'Perbaikan Hardware PC', 'category' => 'PC', 'price' => 'Mulai Rp 200.000'],
        ]);

        return view('user.services.index', compact('services'));
    }
}