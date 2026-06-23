<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-Keuangan Siswa | Kelola Uang Saku dengan Bijak</title>

    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

    <style>
        .gradient-text {
            background: linear-gradient(135deg, #0d9488 0%, #0891b2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        @keyframes gentle-float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        .animate-float {
            animation: gentle-float 6s ease-in-out infinite;
        }
        .btn-glow {
            box-shadow: 0 10px 25px -5px rgba(13, 148, 136, 0.4);
        }
        .btn-glow:hover {
            box-shadow: 0 20px 30px -5px rgba(13, 148, 136, 0.6);
        }
        .bg-pattern {
            background-image: radial-gradient(rgba(13, 148, 136, 0.1) 1px, transparent 1px);
            background-size: 30px 30px;
        }
    </style>
</head>
<body class="font-sans antialiased bg-white dark:bg-gray-950 text-gray-900 dark:text-white overflow-x-hidden overflow-y-hidden">

    <!-- NAVBAR (sama seperti sebelumnya) -->
    <nav class="sticky top-0 z-50 backdrop-blur-lg bg-white/70 dark:bg-gray-950/70 border-b border-gray-200/50 dark:border-gray-800/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 md:h-20">
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-teal-500 to-cyan-600 rounded-xl flex items-center justify-center text-white shadow-lg">
                        <i class="fas fa-wallet text-lg"></i>
                    </div>
                    <span class="text-xl md:text-2xl font-extrabold tracking-tight gradient-text">e-Keuangan Siswa</span>
                </div>               

                <!-- Action Buttons -->
                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ route('dashboard') }}" class="px-5 py-2.5 bg-teal-600 text-white rounded-xl hover:bg-teal-700 transition shadow-md hover:shadow-lg font-semibold text-sm">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="hidden sm:inline-block px-5 py-2.5 text-teal-600 dark:text-teal-400 font-semibold hover:text-teal-700 dark:hover:text-teal-300 transition">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="px-5 py-2.5 bg-teal-600 text-white rounded-xl hover:bg-teal-700 transition shadow-md hover:shadow-lg font-semibold text-sm">
                            Daftar Gratis
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION (diperbaiki) -->
    <section class="relative overflow-hidden flex items-center min-h-[calc(100vh-5rem)] bg-gradient-to-br from-teal-50 via-white to-cyan-50 dark:from-gray-950 dark:via-gray-900 dark:to-gray-950 py-6">
        <!-- Pattern overlay -->
        <div class="absolute inset-0 bg-pattern opacity-50"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Grid 2 kolom, dengan teks di kiri dan card di kanan -->
            <div class="flex flex-col lg:flex-row items-center justify-between gap-8 lg:gap-10">
                <!-- Left Content - Teks -->
                <div class="w-full lg:w-1/2 text-center lg:text-left space-y-6 md:space-y-8">
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight">
                        Kelola Uang Saku 
                        <span class="block gradient-text">dengan Bijak & Mudah</span>
                    </h1>
                    <p class="text-lg sm:text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto lg:mx-0">
                        Catat pemasukan dan pengeluaran, pantau saldo, serta raih target keuanganmu. 
                        Dirancang khusus untuk siswa agar lebih disiplin dalam mengatur uang.
                    </p>
                    
                    <!-- CTA Buttons -->
                    <div class="flex flex-wrap gap-4 justify-center lg:justify-start">
                        <a href="{{ route('register') }}" class="group px-8 py-4 bg-teal-600 text-white font-semibold rounded-xl btn-glow transition-all duration-300 hover:scale-105 flex items-center gap-2">
                            Mulai Sekarang 
                            <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                        </a>
                        <a href="{{ route('login') }}" class="px-8 py-4 border-2 border-teal-600 text-teal-600 dark:text-teal-400 font-semibold rounded-xl hover:bg-teal-50 dark:hover:bg-gray-800 transition-all duration-300">
                            Masuk
                        </a>
                    </div>

                    <!-- Benefit Badges -->
                    <div class="flex flex-wrap gap-6 pt-4 text-gray-500 dark:text-gray-400 justify-center lg:justify-start">
                        <div class="flex items-center gap-2 bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm px-4 py-2 rounded-full">
                            <i class="fas fa-check-circle text-teal-500"></i>
                            <span class="font-medium">Gratis Selamanya</span>
                        </div>
                        <div class="flex items-center gap-2 bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm px-4 py-2 rounded-full">
                            <i class="fas fa-check-circle text-teal-500"></i>
                            <span class="font-medium">Mudah Digunakan</span>
                        </div>
                    </div>
                </div>

                <!-- Right Content - Card (sekarang di kanan) -->
                <div class="w-full lg:w-1/2 flex justify-center animate-float">
                    <div class="relative w-full max-w-md lg:max-w-full">
                        <!-- Card mockup -->
                        <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden border border-gray-100 dark:border-gray-700">
                            <div class="p-6 sm:p-8">
                                <div class="flex items-center justify-between mb-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-teal-100 dark:bg-teal-900/30 rounded-full flex items-center justify-center">
                                            <i class="fas fa-wallet text-teal-600"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Saldo Saat Ini</p>
                                            <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp 250.000</p>
                                        </div>
                                    </div>
                                    <span class="px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-sm rounded-full">+12%</span>
                                </div>
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-red-100 dark:bg-red-900/30 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-utensils text-red-500 text-sm"></i>
                                            </div>
                                            <span class="text-gray-700 dark:text-gray-300">Makan siang</span>
                                        </div>
                                        <span class="font-semibold text-gray-900 dark:text-white">-Rp 15.000</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-book text-blue-500 text-sm"></i>
                                            </div>
                                            <span class="text-gray-700 dark:text-gray-300">Beli buku</span>
                                        </div>
                                        <span class="font-semibold text-gray-900 dark:text-white">-Rp 45.000</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-gift text-green-500 text-sm"></i>
                                            </div>
                                            <span class="text-gray-700 dark:text-gray-300">Uang saku</span>
                                        </div>
                                        <span class="font-semibold text-gray-900 dark:text-white">+Rp 50.000</span>
                                    </div>
                                </div>
                                <button class="w-full mt-6 py-3 bg-teal-600 text-white rounded-xl font-semibold hover:bg-teal-700 transition shadow-md">
                                    Tambah Transaksi
                                </button>
                            </div>
                        </div>
                        <!-- Decorative blur elements -->
                        <div class="absolute -top-6 -right-6 w-32 h-32 bg-teal-200 dark:bg-teal-900/20 rounded-full blur-3xl -z-10"></div>
                        <div class="absolute -bottom-8 -left-8 w-40 h-40 bg-cyan-200 dark:bg-cyan-900/20 rounded-full blur-3xl -z-10"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sisanya bisa ditambahkan (features, footer, dll) sesuai kebutuhan -->

</body>
</html>