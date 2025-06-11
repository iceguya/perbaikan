<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-gray-900 leading-tight">
            Dashboard Admin
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-b border-gray-200">
                <div class="p-6 text-gray-900 text-lg">
                    Anda login sebagai <strong class="text-blue-600">Admin</strong>.
                </div>
            </div>

            <div class="mt-10 mb-6 border-b pb-4 border-gray-200">
                <h3 class="text-2xl font-bold text-gray-800">Panel Admin</h3>
                <p class="text-gray-600 mt-2">Di sini Anda dapat mengelola pengaturan admin, melihat statistik penting, dan mengelola pesanan.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <div class="bg-white border rounded-lg p-6 shadow-md hover:shadow-lg transition-shadow duration-300">
                    <h4 class="text-xl font-bold mb-3 text-gray-800 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        Statistik Pemesanan
                    </h4>
                    <p class="text-gray-700 mb-1">Jumlah pesanan hari ini: <strong id="pesananHariIni" class="text-blue-600">Memuat...</strong></p>
                    <p class="text-gray-700 mb-1">Jumlah pesanan bulan ini: <strong id="pesananBulanIni" class="text-blue-600">Memuat...</strong></p>
                    <p class="text-gray-700 mb-1">Pesanan tertunda: <strong id="pesananTertunda" class="text-orange-500">Memuat...</strong></p>
                    <p class="text-gray-700">Pesanan selesai: <strong id="pesananSelesai" class="text-green-600">Memuat...</strong></p>
                </div>

                <div class="bg-white border rounded-lg p-6 shadow-md hover:shadow-lg transition-shadow duration-300">
                    <h4 class="text-xl font-bold mb-3 text-gray-800 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                        Penugasan Pemesanan ke Teknisi
                    </h4>
                    <p class="mb-4 text-gray-700">Daftar pesanan yang menunggu penugasan atau konfirmasi:</p>
                    <ul id="daftarPesananTeknisi" class="text-sm text-gray-700 list-disc pl-5 mb-4 space-y-1">
                        <li><span class="text-gray-500">Memuat pesanan...</span></li>
                    </ul>
                    <a href="/assign-orders" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md text-sm transition duration-200">
                        Lihat & Tugaskan Pesanan
                    </a>
                </div>

                <div class="bg-white border rounded-lg p-6 shadow-md hover:shadow-lg transition-shadow duration-300">
                    <h4 class="text-xl font-bold mb-3 text-gray-800 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0zm-4 4a2 2 0 100 4 2 2 0 000-4z"></path></svg>
                        Rekap Pemasukan
                    </h4>
                    <p class="text-gray-700 mb-1">Pendapatan hari ini: <strong id="pendapatanHariIni" class="text-green-700">Memuat...</strong></p>
                    <p class="text-gray-700 mb-1">Pendapatan bulan ini: <strong id="pendapatanBulanIni" class="text-green-700">Memuat...</strong></p>
                    <p class="text-gray-700 mb-1">Keuntungan bersih hari ini: <strong id="keuntunganHariIni" class="text-green-600">Memuat...</strong></p>
                    <p class="text-gray-700">Keuntungan bersih bulan ini: <strong id="keuntunganBulanIni" class="text-green-600">Memuat...</strong></p>
                </div>

                <div class="bg-white border rounded-lg p-6 shadow-md hover:shadow-lg transition-shadow duration-300">
                    <h4 class="text-xl font-bold mb-3 text-gray-800 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        Manajemen Pembayaran
                    </h4>
                    <p class="text-sm text-gray-700 mb-4">Kelola semua transaksi pembayaran, konfirmasi, dan riwayat.</p>
                    <a href="/manage-payments" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-md text-sm transition duration-200">
                        Lihat & Kelola Pembayaran
                    </a>
                </div>

                <div class="bg-white border rounded-lg p-6 shadow-md hover:shadow-lg transition-shadow duration-300">
                    <h4 class="text-xl font-bold mb-3 text-gray-800 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H2v-2a4 4 0 014-4h12.55M17 20v-2A3 3 0 007 16H2m4-2a1 1 0 011-1h1a1 1 0 011 1m-1 1v1m-1-1v1m-4-1a1 1 0 011-1h1a1 1 0 011 1m-1 1v1m-1-1v1m4 4a1 1 0 011-1h1a1 1 0 011 1m-1 1v1m-1-1v1m4 4a1 1 0 011-1h1a1 1 0 011 1m-1 1v1m-1-1v1"></path></svg>
                        Statistik Pengguna
                    </h4>
                    <p class="text-gray-700 mb-1">Total pengguna terdaftar: <strong id="totalPengguna" class="text-indigo-600">Memuat...</strong></p>
                    <p class="text-gray-700">Pengguna aktif hari ini: <strong id="penggunaAktifHariIni" class="text-indigo-600">Memuat...</strong></p>
                </div>

                <div class="bg-white border rounded-lg p-6 shadow-md hover:shadow-lg transition-shadow duration-300">
                    <h4 class="text-xl font-bold mb-3 text-gray-800 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        Log Aktivitas Terbaru
                    </h4>
                    <ul id="logAktivitas" class="text-sm text-gray-700 list-disc pl-5 space-y-1">
                        <li><span class="text-gray-500">Memuat log...</span></li>
                    </ul>
                </div>

                <div class="bg-white border rounded-lg p-6 shadow-md hover:shadow-lg transition-shadow duration-300">
                    <h4 class="text-xl font-bold mb-3 text-gray-800 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Pengaturan Sistem
                    </h4>
                    <p class="text-sm text-gray-700 mb-4">Kelola pengaturan aplikasi, notifikasi, dan preferensi umum.</p>
                    <a href="/system-settings" class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-md text-sm transition duration-200">
                        Konfigurasi Sistem
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi untuk mengambil data dari API
            async function fetchData(url) {
                try {
                    const response = await fetch(url);
                    if (!response.ok) {
                        // Jika ada masalah dengan respons HTTP (misalnya 404, 500)
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return await response.json();
                } catch (error) {
                    // Tangani error jaringan atau parsing JSON
                    console.error('Error fetching data from ' + url + ':', error);
                    return null; // Mengembalikan null jika ada kesalahan
                }
            }

            // Fungsi untuk format mata uang IDR
            function formatRupiah(amount) {
                if (amount === undefined || amount === null) return 'N/A';
                return `Rp ${amount.toLocaleString('id-ID')}`;
            }

            // --- Mengisi data untuk Statistik Pemesanan ---
            fetchData('/api/order-stats').then(data => {
                if (data) {
                    document.getElementById('pesananHariIni').innerText = data.todayOrders !== undefined ? data.todayOrders : 'N/A';
                    document.getElementById('pesananBulanIni').innerText = data.monthOrders !== undefined ? data.monthOrders : 'N/A';
                    document.getElementById('pesananTertunda').innerText = data.pendingOrders !== undefined ? data.pendingOrders : 'N/A';
                    document.getElementById('pesananSelesai').innerText = data.completedOrders !== undefined ? data.completedOrders : 'N/A';
                } else {
                    document.getElementById('pesananHariIni').innerText = 'Gagal memuat';
                    document.getElementById('pesananBulanIni').innerText = 'Gagal memuat';
                    document.getElementById('pesananTertunda').innerText = 'Gagal memuat';
                    document.getElementById('pesananSelesai').innerText = 'Gagal memuat';
                }
            });

            // --- Mengisi data untuk Rekap Pemasukan ---
            fetchData('/api/revenue-recap').then(data => {
                if (data) {
                    document.getElementById('pendapatanHariIni').innerText = formatRupiah(data.todayRevenue);
                    document.getElementById('pendapatanBulanIni').innerText = formatRupiah(data.monthRevenue);
                    document.getElementById('keuntunganHariIni').innerText = formatRupiah(data.todayProfit);
                    document.getElementById('keuntunganBulanIni').innerText = formatRupiah(data.monthProfit);
                } else {
                    document.getElementById('pendapatanHariIni').innerText = 'Gagal memuat';
                    document.getElementById('pendapatanBulanIni').innerText = 'Gagal memuat';
                    document.getElementById('keuntunganHariIni').innerText = 'Gagal memuat';
                    document.getElementById('keuntunganBulanIni').innerText = 'Gagal memuat';
                }
            });

            // --- Mengisi data untuk Penugasan Pemesanan ke Teknisi ---
            fetchData('/api/technician-orders').then(data => {
                const daftarPesananTeknisi = document.getElementById('daftarPesananTeknisi');
                daftarPesananTeknisi.innerHTML = ''; // Kosongkan placeholder
                if (data && data.length > 0) {
                    data.forEach(order => {
                        const li = document.createElement('li');
                        // Menambahkan warna berdasarkan status
                        let statusClass = '';
                        if (order.status === 'pending' || order.status === 'awaiting_assignment') {
                            statusClass = 'text-orange-500';
                        } else if (order.status === 'assigned') {
                            statusClass = 'text-blue-500';
                        } else {
                            statusClass = 'text-gray-700'; // Default
                        }
                        li.innerHTML = `Pesanan <strong>#${order.id}</strong> - <span class="${statusClass}">${order.status.replace(/_/g, ' ')}</span>`;
                        daftarPesananTeknisi.appendChild(li);
                    });
                } else {
                    const li = document.createElement('li');
                    li.innerText = 'Tidak ada pesanan yang perlu ditugaskan.';
                    daftarPesananTeknisi.appendChild(li);
                }
            });

            // --- Mengisi data untuk Statistik Pengguna ---
            fetchData('/api/user-stats').then(data => {
                if (data) {
                    document.getElementById('totalPengguna').innerText = data.totalUsers !== undefined ? data.totalUsers : 'N/A';
                    document.getElementById('penggunaAktifHariIni').innerText = data.activeUsersToday !== undefined ? data.activeUsersToday : 'N/A';
                } else {
                    document.getElementById('totalPengguna').innerText = 'Gagal memuat';
                    document.getElementById('penggunaAktifHariIni').innerText = 'Gagal memuat';
                }
            });

            // --- Mengisi data untuk Log Aktivitas ---
            fetchData('/api/activity-log').then(data => {
                const logAktivitas = document.getElementById('logAktivitas');
                logAktivitas.innerHTML = ''; // Kosongkan placeholder
                if (data && data.length > 0) {
                    data.forEach(log => {
                        const li = document.createElement('li');
                        li.innerText = log.description;
                        logAktivitas.appendChild(li);
                    });
                } else {
                    const li = document.createElement('li');
                    li.innerText = 'Tidak ada aktivitas terbaru.';
                    logAktivitas.appendChild(li);
                }
            });
        });
    </script>
</x-app-layout>