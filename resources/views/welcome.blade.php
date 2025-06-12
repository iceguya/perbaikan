<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hirawr Store</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2j+om7RzJFWrVfB+b5QyK/aa4ZLGw/HjP4Sg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* CSS Anda bisa diletakkan di sini, atau lebih baik lagi, di dalam resources/css/app.css */
        .slide-card-wrapper {
            display: flex;
            overflow-x: hidden;
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .slide-card-wrapper::-webkit-scrollbar {
            display: none;
        }
        .slide-card {
            flex: 0 0 auto;
            scroll-snap-align: start;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }
        .social-icon-circle {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.4);
            color: white;
            font-size: 24px;
            transition: all 0.3s ease;
        }
        .social-icon-circle:hover {
            border-color: white;
            color: #add8e6;
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
        .footer-logo-lighten {
            filter: brightness(2);
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">

    <nav class="bg-blue-800 p-4 fixed w-full z-10 top-0 shadow-lg dark:bg-gray-900">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#home" class="flex-shrink-0">
                {{-- Menggunakan asset() untuk memanggil gambar dari folder public --}}
                <img src="{{ asset('images/logo.png') }}" alt="Hirawr Logo" class="h-10 w-auto">
            </a>
            <div class="hidden md:flex space-x-8">
                <a href="#home" class="text-blue-200 hover:text-white transition duration-300">Home</a>
                <a href="#jasa" class="text-blue-200 hover:text-white transition duration-300">Jasa</a>
                <a href="#testimoni" class="text-blue-200 hover:text-white transition duration-300">Testimoni</a>
                <a href="#contact" class="text-blue-200 hover:text-white transition duration-300">Contact Us</a>
            </div>

            <div class="flex items-center space-x-4">
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
            {{-- Tombol hamburger untuk mobile bisa ditambahkan logikanya dengan AlpineJS nanti --}}
        </div>
    </nav>
    
    {{-- Konten halaman Anda (home, jasa, testimoni, dst.) --}}
    {{-- (Salin dan tempel semua section Anda dari #home hingga #contact di sini) --}}
    <main>
        <section id="home" class="relative bg-gradient-to-br from-blue-600 to-indigo-800 pt-32 pb-24 lg:pt-40 lg:pb-32 overflow-hidden dark:from-gray-900 dark:to-gray-800">
            {{-- ... Konten Home ... --}}
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="lg:grid lg:grid-cols-12 lg:gap-8 lg:items-center">
                    <div class="lg:col-span-7 text-center lg:text-left animate-fade-in">
                        <img src="{{ asset('images/logo.png') }}" alt="Hirawr Store Logo" class="h-20 sm:h-24 lg:h-32 w-auto mx-auto lg:mx-0 mb-4">
                        <h1 class="text-4xl font-extrabold text-white sm:text-5xl lg:mt-6 xl:text-6xl tracking-tight">
                            <span class="block text-blue-200 dark:text-blue-300">Kebutuhan Elektronik Anda!</span>
                        </h1>
                        <p class="mt-3 text-base text-blue-100 sm:mt-5 sm:text-xl lg:text-lg xl:text-xl dark:text-gray-300">
                            Temukan beragam pilihan barang elektronik berkualitas tinggi dan layanan perbaikan terbaik. Cepat, andal, dan terpercaya.
                        </p>
                    </div>
                    <div class="mt-12 lg:mt-0 lg:col-span-5 lg:flex lg:justify-center lg:items-center animate-fade-in" style="animation-delay: 0.2s;">
                        <img src="{{ asset('images/teknisi_Hirawr.jpg') }}" alt="Teknisi sedang memperbaiki laptop" class="w-64 h-64 sm:w-80 sm:h-80 lg:w-96 lg:h-96 object-cover rounded-full shadow-2xl border-4 border-white dark:border-gray-700">
                    </div>
                </div>
            </div>
        </section>
        
        {{-- ... dan section lainnya ... --}}
    </main>
    
    <footer class="bg-gray-900 text-white py-16 dark:bg-black">
        {{-- ... Konten Footer ... --}}
    </footer>

    <script>
        // ... JavaScript Anda ...
    </script>
</body>
</html>