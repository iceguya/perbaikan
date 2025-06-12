<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hirawr Store</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2j+om7RzJFWrVfB+b5QyK/aa4ZLGw/HjP4Sg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Untuk slidecard testimoni */
        .slide-card-wrapper {
            display: flex;
            overflow-x: hidden; /* Mengganti auto menjadi hidden agar scroll dilakukan via JS */
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch; /* For smoother scrolling on iOS */
            /* Hide scrollbar for a cleaner look */
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
        .slide-card-wrapper::-webkit-scrollbar {
            display: none; /* Chrome, Safari, Opera */
        }
        .slide-card {
            flex: 0 0 auto;
            width: 100%; /* Setiap kartu mengambil 100% lebar container parent (slide-card-wrapper) */
            scroll-snap-align: start;
        }
        /* Tambahan untuk animasi sederhana jika diinginkan, seperti fade-in */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }

        /* Custom style for social media icons */
        .social-icon-circle {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 48px; /* Ukuran lingkaran */
            height: 48px; /* Ukuran lingkaran */
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.4); /* Border putih transparan */
            color: white; /* Pastikan ikon berwarna putih */
            font-size: 24px; /* Ukuran ikon */
            transition: all 0.3s ease;
        }
        .social-icon-circle:hover {
            border-color: white;
            color: #add8e6; /* Warna biru muda saat hover */
            transform: scale(1.1);
        }
        .dark .social-icon-circle {
             border: 1px solid rgba(255, 255, 255, 0.3);
             color: #e0e0e0;
        }
        .dark .social-icon-circle:hover {
            border-color: white;
            color: #ffffff;
        }
        /* New: Style for logo in footer if it needs to be lightened */
        .footer-logo-lighten {
            filter: brightness(2); /* Mencerahkan gambar 200% */
            /* Atau coba invert jika logo didominasi warna gelap: filter: invert(1); */
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">

    <nav class="bg-blue-800 p-4 fixed w-full z-10 top-0 shadow-lg dark:bg-gray-900">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#home" class="flex-shrink-0">
                <img src="{{ asset('images/logo.png') }}" alt="Hirawr Logo" class="h-10 w-auto">
            </a>
            <div class="hidden md:flex space-x-8">
                <a href="#home" class="text-blue-200 hover:text-white transition duration-300">Home</a>
                <a href="#jasa" class="text-blue-200 hover:text-white transition duration-300">Jasa</a>
                <a href="#testimoni" class="text-blue-200 hover:text-white transition duration-300">Testimoni</a>
                <a href="#contact" class="text-blue-200 hover:text-white transition duration-300">Contact Us</a>
            </div>

            <div class="flex space-x-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="bg-blue-600 text-white px-5 py-2 rounded-full hover:bg-blue-700 transition duration-300 shadow-md">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="bg-white text-blue-800 px-5 py-2 rounded-full hover:bg-gray-100 transition duration-300 shadow-md dark:bg-gray-700 dark:text-blue-200 dark:hover:bg-gray-600">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-blue-600 text-white px-5 py-2 rounded-full hover:bg-blue-700 transition duration-300 shadow-md">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
            <button class="md:hidden text-white focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </nav>

    <section id="home" class="relative bg-gradient-to-br from-blue-600 to-indigo-800 pt-16 pb-24 lg:pt-24 lg:pb-32 overflow-hidden dark:from-gray-900 dark:to-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="lg:grid lg:grid-cols-12 lg:gap-8 lg:items-center">
                <div class="lg:col-span-7 text-center lg:text-left animate-fade-in">
                    <h1 class="text-4xl font-extrabold text-white sm:text-5xl lg:mt-6 xl:text-6xl tracking-tight">
                        <img src="{{ asset('images/logo.png') }}" alt="Hirawr Store Logo" class="h-20 sm:h-24 lg:h-32 w-auto mx-auto lg:mx-0 mb-4">
                        <span class="block text-blue-200 dark:text-blue-300">Kebutuhan Elektronik Anda!</span>
                    </h1>
                    <p class="mt-3 text-base text-blue-100 sm:mt-5 sm:text-xl lg:text-lg xl:text-xl dark:text-gray-300">
                        Temukan beragam pilihan barang elektronik berkualitas tinggi dan layanan perbaikan terbaik. Cepat, andal, dan terpercaya.
                    </p>
                </div>
                <div class="mt-12 lg:mt-0 lg:col-span-5 lg:flex lg:justify-center lg:items-center animate-fade-in" style="animation-delay: 0.2s;">
                    <img src="{{ asset('images/teknisi_Hirawr.jpg') }}" 
                         alt="Teknisi sedang memperbaiki laptop" 
                         class="w-64 h-64 sm:w-80 sm:h-80 lg:w-96 lg:h-96 object-cover rounded-full shadow-2xl border-4 border-white dark:border-gray-700">
                </div>
            </div>
        </div>
    </section>

    ---

    <section id="jasa" class="py-20 bg-gray-50 dark:bg-gray-800">
        <div class="container mx-auto px-4">
            <h2 class="text-5xl font-bold text-center mb-16 text-blue-800 dark:text-blue-300">Jasa Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 dark:bg-gray-700 dark:text-gray-100 flex flex-col items-center text-center">
                    <div class="text-blue-600 mb-4 text-5xl dark:text-blue-300">
                        <i class="fas fa-laptop"></i> </div>
                    <h3 class="text-3xl font-semibold mb-4 text-blue-700 dark:text-blue-200">Laptop</h3>
                    <p class="text-gray-700 leading-relaxed dark:text-gray-200">Menyediakan berbagai jenis laptop terbaru dan berkualitas tinggi untuk kebutuhan belajar, bekerja, atau gaming, dengan garansi dan dukungan teknis terbaik.</p>
                </div>
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 dark:bg-gray-700 dark:text-gray-100 flex flex-col items-center text-center">
                    <div class="text-blue-600 mb-4 text-5xl dark:text-blue-300">
                        <i class="fas fa-desktop"></i> </div>
                    <h3 class="text-3xl font-semibold mb-4 text-blue-700 dark:text-blue-200">Komputer</h3>
                    <p class="text-gray-700 leading-relaxed dark:text-gray-200">Merakit dan menyediakan komputer desktop dengan spesifikasi sesuai permintaan, baik untuk personal maupun bisnis, dengan performa optimal.</p>
                </div>
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 dark:bg-gray-700 dark:text-gray-100 flex flex-col items-center text-center">
                    <div class="text-blue-600 mb-4 text-5xl dark:text-blue-300">
                        <i class="fas fa-mobile-alt"></i> </div>
                    <h3 class="text-3xl font-semibold mb-4 text-blue-700 dark:text-blue-200">Smartphone</h3>
                    <p class="text-gray-700 leading-relaxed dark:text-gray-200">Pilihan smartphone dari berbagai merek terkemuka dengan fitur-es inovatif, kamera menawan, dan daya tahan baterai superior.</p>
                </div>
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 dark:bg-gray-700 dark:text-gray-100 flex flex-col items-center text-center">
                    <div class="text-blue-600 mb-4 text-5xl dark:text-blue-300">
                        <i class="fas fa-tv"></i> </div>
                    <h3 class="text-3xl font-semibold mb-4 text-blue-700 dark:text-blue-200">Televisi</h3>
                    <p class="text-gray-700 leading-relaxed dark:text-gray-200">Menawarkan berbagai ukuran dan jenis televisi dengan kualitas gambar terbaik, mulai dari Smart TV hingga 4K UHD, untuk pengalaman hiburan di rumah.</p>
                </div>
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 dark:bg-gray-700 dark:text-gray-100 flex flex-col items-center text-center">
                    <div class="text-blue-600 mb-4 text-5xl dark:text-blue-300">
                        <i class="fas fa-blender"></i> </div>
                    <h3 class="text-3xl font-semibold mb-4 text-blue-700 dark:text-blue-200">Peralatan Dapur</h3>
                    <p class="text-gray-700 leading-relaxed dark:text-gray-200">Melengkapi dapur Anda dengan peralatan modern dan fungsional, dari blender canggih hingga oven pintar, untuk memudahkan aktivitas memasak.</p>
                </div>
                   <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 flex items-center justify-center dark:bg-gray-700">
                    <a href="#" class="text-blue-700 text-xl font-semibold hover:text-blue-900 flex items-center dark:text-blue-200 dark:hover:text-blue-50">Coming Soon <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.5 12h-15m11.5 5l4-5-4-5"></path></svg></a>
                </div>
            </div>
        </div>
    </section>

    ---

    <section id="testimoni" class="py-20 bg-blue-800 text-white dark:bg-gray-900">
        <div class="container mx-auto px-4">
            <h2 class="text-5xl font-bold text-center mb-16">Kata Mereka Tentang Kami</h2>
            <div class="slide-card-wrapper relative">
                <div class="flex">
                    <div class="slide-card bg-blue-700 p-10 rounded-xl shadow-xl mx-4 flex-shrink-0 w-full md:w-1/2 lg:w-1/3 dark:bg-gray-700">
                        <p class="text-xl italic mb-6 leading-relaxed dark:text-gray-100">"Pelayanan Hirawr sangat memuaskan! Laptop saya jadi seperti baru lagi dan pengerjaannya sangat cepat. Sangat direkomendasikan untuk siapa pun yang butuh jasa perbaikan elektronik."</p>
                        <p class="font-bold text-lg">- Budi Santoso</p>
                        <p class="text-base text-blue-200 dark:text-gray-300">Pengusaha Muda</p>
                    </div>
                    <div class="slide-card bg-blue-700 p-10 rounded-xl shadow-xl mx-4 flex-shrink-0 w-full md:w-1/2 lg:w-1/3 dark:bg-gray-700">
                        <p class="text-xl italic mb-6 leading-relaxed dark:text-gray-100">"Saya sangat terbantu dengan pilihan smartphonenya, lengkap dan harga bersaing! Stafnya juga sangat ramah dan membantu saya memilih yang terbaik sesuai kebutuhan."</p>
                        <p class="font-bold text-lg">- Siti Aminah</p>
                        <p class="text-base text-blue-200 dark:text-gray-300">Mahasiswa</p>
                    </div>
                    <div class="slide-card bg-blue-700 p-10 rounded-xl shadow-xl mx-4 flex-shrink-0 w-full md:w-1/2 lg:w-1/3 dark:bg-gray-700">
                        <p class="text-xl italic mb-6 leading-relaxed dark:text-gray-100">"Produk peralatan dapurnya berkualitas, istri saya sangat suka! Sekarang masak jadi lebih mudah dan menyenangkan. Pengiriman juga cepat dan aman."</p>
                        <p class="font-bold text-lg">- Joko Susilo</p>
                        <p class="text-base text-blue-200 dark:text-gray-300">Kepala Keluarga</p>
                    </div>
                     <div class="slide-card bg-blue-700 p-10 rounded-xl shadow-xl mx-4 flex-shrink-0 w-full md:w-1/2 lg:w-1/3 dark:bg-gray-700">
                        <p class="text-xl italic mb-6 leading-relaxed dark:text-gray-100">"Pengalaman belanja di Hirawr Store sangat menyenangkan, recommended! Dari awal sampai akhir, prosesnya mulus dan barang yang saya terima sesuai ekspektasi."</p>
                        <p class="font-bold text-lg">- Dian Permata</p>
                        <p class="text-base text-blue-200 dark:text-gray-300">Influencer</p>
                    </div>
                     <div class="slide-card bg-blue-700 p-10 rounded-xl shadow-xl mx-4 flex-shrink-0 w-full md:w-1/2 lg:w-1/3 dark:bg-gray-700">
                        <p class="text-xl italic mb-6 leading-relaxed dark:text-gray-100">"Saya membeli televisi baru di sini dan kualitasnya luar biasa. Layanan purna jual juga sangat responsif. Pasti akan kembali belanja di Hirawr Store!"</p>
                        <p class="font-bold text-lg">- Rio Fahrezi</p>
                        <p class="text-base text-blue-200 dark:text-gray-300">Pegawai Swasta</p>
                    </div>
                </div>
            </div>
            <div class="flex justify-center mt-12">
                <button class="bg-blue-600 text-white px-8 py-4 rounded-full mx-3 hover:bg-blue-700 transition duration-300 shadow-lg dark:bg-blue-700 dark:hover:bg-blue-600" onclick="scrollTestimoni(-1)">← Sebelumnya</button>
                <button class="bg-blue-600 text-white px-8 py-4 rounded-full mx-3 hover:bg-blue-700 transition duration-300 shadow-lg dark:bg-blue-700 dark:hover:bg-blue-600" onclick="scrollTestimoni(1)">Selanjutnya →</button>
            </div>
        </div>
    </section>

    ---

    <section id="contact" class="py-20 bg-gray-50 dark:bg-gray-800">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-5xl font-bold mb-16 text-blue-800 dark:text-blue-300">Lokasi Kami</h2>
            <div class="w-full rounded-xl overflow-hidden shadow-lg h-96 lg:h-[500px]">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.3683325639645!2d105.248018!3d-5.360645000000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40c550198b512f%3A0x9d4ad778e40fcd4d!2sKosT%20Linda!5e0!3m2!1sid!2sid!4v1749693550072!5m2!1sid!2sid"
                    width="100%"
                    height="100%"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    title="Lokasi Hirawr Store di Google Maps">
                </iframe>
            </div>
        </div>
    </section>


    <footer class="bg-gray-900 text-white py-16 dark:bg-black">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center">
                <div class="mb-10 lg:mb-0">
                    <img src="{{ asset('images/logo.png') }}" alt="Hirawr Logo Footer" class="h-16 w-auto mb-6">
                    <div class="flex space-x-4">
                        <a href="https://www.instagram.com/hirawr.store?igsh=enViMmRwa2hmbTI3" target="_blank" rel="noopener noreferrer" aria-label="Instagram" class="social-icon-circle">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="http://wa.me/082160718811" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp" class="social-icon-circle">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>

                <div class="text-left lg:text-right">
                    <ul class="flex flex-col md:flex-row md:space-x-8 space-y-4 md:space-y-0 text-sm font-semibold text-gray-300">
                        <li><a href="#home" class="hover:text-white transition duration-200">Home</a></li>
                        <li><a href="#jasa" class="hover:text-white transition duration-200">Jasa</a></li>
                        <li><a href="#testimoni" class="hover:text-white transition duration-200">Testimoni</a></li>
                        <li><a href="#contact" class="hover:text-white transition duration-200">Contact Us</a></li>
                        <li><a href="mailto:info@subakara295@gmail.com" class="hover:text-white transition duration-200">Email Us</a></li>
                        <li><span class="cursor-default">Jl. Kencana, Kp. Baru, Kec. Kedaton, Kota Bandar Lampung, Lampung 35141</span></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-12 pt-8 text-center text-sm text-gray-500">
                <p>© 2025 Hirawr Store. All rights reserved.</p>
                <p class="text-xs mt-2">Dibuat dengan <span class="text-red-400">♥</span> di Bandar Lampung</p>
            </div>
        </div>
    </footer>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        const slideCardWrapper = document.querySelector('.slide-card-wrapper');
        const slideCards = document.querySelectorAll('.slide-card');

        function scrollTestimoni(direction) {
            if (slideCards.length === 0) return;

            const singleCardWidth = slideCards[0].offsetWidth + (parseFloat(getComputedStyle(slideCards[0]).marginLeft) * 2);
            const cardsInView = Math.round(slideCardWrapper.offsetWidth / Math.max(1, singleCardWidth));

            slideCardWrapper.scrollBy({
                left: direction * singleCardWidth * cardsInView,
                behavior: 'smooth'
            });
        }
    </script>
</body>
</html>