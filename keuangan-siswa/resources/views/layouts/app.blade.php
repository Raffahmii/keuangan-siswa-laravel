<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>e-Keuangan Siswa - @yield('title', 'Dashboard')</title>

    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Tailwind & Vite -->
    @vite('resources/css/app.css')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    @stack('styles')

    <!-- Dark Mode Script -->
    <script>
        // Set theme on page load
        (function() {
            const storedTheme = localStorage.getItem('theme');
            if (storedTheme === 'dark' || (!storedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();

        // Toggle function
        window.toggleDarkMode = function() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        };
    </script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 font-sans antialiased transition-colors duration-300">

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar dengan gradasi yang lebih hidup -->
        <aside class="w-72 bg-gradient-to-br from-teal-600 via-cyan-600 to-blue-600 dark:from-slate-800 dark:via-slate-900 dark:to-gray-900 text-white flex flex-col shadow-2xl transition-all duration-300">
            <div class="p-6 border-b border-white/20">
                <h2 class="text-2xl font-bold flex items-center gap-2">
                    <i class="fas fa-wallet"></i> 
                    <span>e-Keuangan Siswa</span>
                </h2>
                <p class="text-sm text-white/70 mt-1">Kelola uang saku dengan bijak</p>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 hover:scale-105 hover:bg-white/20 {{ request()->routeIs('dashboard') ? 'bg-white/20 shadow-lg scale-105' : '' }}">
                    <i class="fas fa-home w-5"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('categories.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 hover:scale-105 hover:bg-white/20 {{ request()->routeIs('categories.*') ? 'bg-white/20 shadow-lg scale-105' : '' }}">
                    <i class="fas fa-tags w-5"></i>
                    <span>Kategori</span>
                </a>
                <a href="{{ route('transactions.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 hover:scale-105 hover:bg-white/20 {{ request()->routeIs('transactions.*') ? 'bg-white/20 shadow-lg scale-105' : '' }}">
                    <i class="fas fa-exchange-alt w-5"></i>
                    <span>Transaksi</span>
                </a>
                <a href="{{ route('report') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 hover:scale-105 hover:bg-white/20 {{ request()->routeIs('report') ? 'bg-white/20 shadow-lg scale-105' : '' }}">
                    <i class="fas fa-chart-pie w-5"></i>
                    <span>Laporan</span>
                </a>
            </nav>

            <div class="p-4 border-t border-white/20">
                <form method="POST" action="{{ route('logout') }}" id="logout-form" class="hidden">
                    @csrf
                </form>
                <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center gap-3 w-full px-4 py-3 text-left rounded-xl hover:bg-white/10 transition-all text-white/90 hover:scale-105">
                    <i class="fas fa-sign-out-alt w-5"></i>
                    <span>Keluar</span>
                </button>
            </div>
        </aside>

        <!-- Konten Utama -->
        <main class="flex-1 overflow-y-auto bg-gray-50 dark:bg-gray-800 transition-colors duration-300">
            <!-- Header dengan profile & dark mode toggle -->
            <header class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-md shadow-sm sticky top-0 z-10 border-b border-gray-200 dark:border-gray-700">
                <div class="px-8 py-3 flex items-center justify-between">
                    <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">@yield('header', 'Dashboard')</h1>
                    <div class="flex items-center gap-4">
                        <!-- Dark Mode Toggle -->
                        <button onclick="toggleDarkMode()" class="p-2 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-gray-600 transition-all duration-300 hover:scale-110">
                            <i class="fas fa-sun dark:hidden"></i>
                            <i class="fas fa-moon hidden dark:inline"></i>
                        </button>

                        <!-- Profile Dropdown -->
                        <div class="relative" x-data="{ open: false }" @click.away="open = false">
                            <button @click="open = !open" class="flex items-center gap-2 focus:outline-none group">
                                <span class="text-sm text-gray-700 dark:text-gray-300">{{ Auth::user()->name }}</span>
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-teal-500 to-cyan-600 dark:from-indigo-500 dark:to-purple-600 flex items-center justify-center text-white font-bold shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <i class="fas fa-chevron-down text-xs text-gray-500 dark:text-gray-400 transition-transform duration-300" :class="{ 'rotate-180': open }"></i>
                            </button>

                            <div x-show="open" class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-xl shadow-xl border border-gray-200 dark:border-gray-700 py-2 z-50 transition-all duration-300" style="display: none;">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-teal-50 dark:hover:bg-gray-700 flex items-center gap-2">
                                    <i class="fas fa-user w-4"></i> Profil
                                </a>
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-teal-50 dark:hover:bg-gray-700 flex items-center gap-2">
                                    <i class="fas fa-cog w-4"></i> Pengaturan
                                </a>
                                <hr class="my-1 border-gray-200 dark:border-gray-700">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 flex items-center gap-2">
                                        <i class="fas fa-sign-out-alt w-4"></i> Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="p-8">
                {{ $slot }}
            </div>
        </main>
    </div>

    <!-- Alpine.js untuk dropdown -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('scripts')
</body>
</html>