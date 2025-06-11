<x-app-layout>
    {{-- Kita tidak menggunakan slot header agar hero section bisa full-width --}}

    <div class="bg-gray-100 dark:bg-gray-900">
        {{-- Hero Section dengan Search --}}
        <div class="relative bg-gradient-to-br from-blue-600 to-indigo-800 pt-16 pb-24 lg:pt-24 lg:pb-32 overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="lg:grid lg:grid-cols-12 lg:gap-8 lg:items-center">
                    <div class="lg:col-span-7 text-center lg:text-left">
                        <h1 class="text-4xl font-extrabold text-white sm:text-5xl lg:mt-6 xl:text-6xl tracking-tight">
                            <span>Butuh Perbaikan</span>
                            <span class="block text-blue-200">Alat Elektronik?</span>
                        </h1>
                        <p class="mt-3 text-base text-blue-100 sm:mt-5 sm:text-xl lg:text-lg xl:text-xl">
                            Temukan teknisi profesional untuk semua kebutuhan servis perangkat Anda. Cepat, andal, dan terpercaya.
                        </p>
                        <div class="mt-10 max-w-lg mx-auto sm:max-w-none sm:flex sm:justify-center lg:justify-start">
                            <div class="flex items-center w-full">
                            </div>
                        </div>
                    </div>
                    <div class="mt-12 lg:mt-0 lg:col-span-5 lg:flex lg:justify-center">
                        <img class="max-w-full h-auto rounded-lg shadow-2xl lg:max-h-[400px]" src="https://images.unsplash.com/photo-1598439213716-fe5cdf259140?q=80&w=1000&auto=format&fit=crop" alt="Teknisi sedang memperbaiki laptop">
                    </div>
                </div>
            </div>
        </div>

        {{-- Layanan Berdasarkan Kategori Section --}}
        <div class="py-16 bg-white dark:bg-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white text-center mb-12">Layanan Berdasarkan Kategori Alat</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                    {{-- Kategori Card: Smartphone --}}
                    <a href="#" class="category-card">
                        <div class="icon-container bg-green-100 text-green-600">
                            <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Smartphone</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Layanan Tersedia</p>
                    </a>
                    {{-- Kategori Card: Laptop --}}
                    <a href="#" class="category-card">
                        <div class="icon-container bg-blue-100 text-blue-600">
                             <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Laptop</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Layanan Tersedia</p>
                    </a>
                    {{-- Kategori Card: PC --}}
                     <a href="#" class="category-card">
                        <div class="icon-container bg-gray-200 text-gray-600">
                             <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11l7-7 7 7M5 19l7-7 7 7" /></svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">PC / Komputer</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Layanan Tersedia</p>
                    </a>
                     {{-- Kategori Card: TV --}}
                    <a href="#" class="category-card">
                        <div class="icon-container bg-red-100 text-red-600">
                             <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V7a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2z" /></svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Televisi</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Layanan Tersedia</p>
                    </a>
                     {{-- Kategori Card: Dapur --}}
                    <a href="#" class="category-card">
                        <div class="icon-container bg-yellow-100 text-yellow-600">
                            <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9.83a2 2 0 00-1.42.59L6 14m11-3h-2" /></svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Peralatan Dapur</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Layanan Tersedia</p>
                    </a>
                </div>
            </div>
        </div>

        {{-- Layanan Unggulan Section --}}
        <div class="py-16 bg-gray-50 dark:bg-gray-900">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center mb-12">
                    <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white">Layanan Unggulan</h2>
                    <a href="#" class="text-indigo-600 hover:text-indigo-500 font-medium">Lihat Semua &rarr;</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    {{-- Contoh Kartu Layanan 1 --}}
                    <div class="service-card">
                        <div class="flex items-center mb-4">
                            <div class="service-card-icon bg-blue-100 text-blue-600">
                                <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-1.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25A2.25 2.25 0 015.25 3h13.5A2.25 2.25 0 0121 5.25z" /></svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Instal Ulang Windows</h3>
                                <p class="text-gray-600 dark:text-gray-400">Laptop & PC</p>
                            </div>
                        </div>
                        <p class="text-gray-700 dark:text-gray-300 mb-4 text-sm">
                            Sistem operasi laptop atau PC Anda kembali baru, bersih dari virus dan berjalan optimal.
                        </p>
                        <div class="flex justify-between items-center">
                            <span class="service-tag">Garansi 1 Bulan</span>
                            <span class="text-lg font-bold text-gray-900 dark:text-white">Rp 150.000</span>
                        </div>
                    </div>
                     {{-- Contoh Kartu Layanan 2 --}}
                    <div class="service-card">
                        <div class="flex items-center mb-4">
                            <div class="service-card-icon bg-green-100 text-green-600">
                               <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" /></svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Ganti LCD Smartphone</h3>
                                <p class="text-gray-600 dark:text-gray-400">Semua Merek</p>
                            </div>
                        </div>
                        <p class="text-gray-700 dark:text-gray-300 mb-4 text-sm">
                           Layar retak atau rusak? Ganti dengan LCD kualitas original. Pengerjaan bisa ditunggu.
                        </p>
                        <div class="flex justify-between items-center">
                            <span class="service-tag">Bisa Ditunggu</span>
                            <span class="text-lg font-bold text-gray-900 dark:text-white">Mulai Rp 350.000</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <footer class="bg-gray-800 py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-white text-center">
                 &copy; {{ date('Y') }} Servis Elektronik. All rights reserved.
            </div>
        </footer>
    </div>
</x-app-layout>