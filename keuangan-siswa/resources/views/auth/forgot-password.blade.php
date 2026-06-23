@extends('layouts.guest')

@section('content')
<div class="min-h-screen w-screen bg-white dark:bg-gray-900 flex overflow-hidden">
    <!-- Left side - Info Panel (gradasi) -->
    <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-teal-600 via-cyan-600 to-blue-600 text-white flex-col justify-center px-4 sm:px-8 lg:px-12 py-8 sm:py-12 lg:py-16 relative overflow-hidden">
        <!-- Decorative circles -->
        <div class="absolute top-0 left-0 w-64 h-64 bg-white/10 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-white/5 rounded-full translate-x-1/3 translate-y-1/3"></div>
        
        <!-- Floating icons - ukuran responsif -->
        <div class="absolute top-20 left-20 text-white/10 animate-pulse">
            <i class="fa-solid fa-key text-5xl sm:text-6xl lg:text-7xl xl:text-8xl"></i>
        </div>
        <div class="absolute bottom-20 right-20 text-white/10 animate-pulse animation-delay-2000">
            <i class="fa-solid fa-shield-halved text-4xl sm:text-5xl lg:text-6xl xl:text-7xl"></i>
        </div>
        
        <div class="relative z-10 w-full">
            <div class="flex items-center gap-4 mb-6 sm:mb-8">
                <div class="w-12 h-12 sm:w-14 sm:h-14 lg:w-16 lg:h-16 bg-white/20 backdrop-blur-lg rounded-2xl flex items-center justify-center border-2 border-white/30">
                    <i class="fa-solid fa-calculator text-2xl sm:text-3xl lg:text-4xl text-yellow-300"></i>
                </div>
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold break-words">e-Keuangan Siswa</h1>
            </div>
            
            <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold mb-4 break-words">Lupa Password?</h2>
            <p class="text-white/90 mb-8 leading-relaxed text-sm sm:text-base break-words">
                Tenang, kami akan bantu mereset password Anda. Masukkan email terdaftar dan kami kirimkan instruksi.
            </p>
            
            <!-- Info tambahan -->
            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                <p class="text-sm break-words">Link reset akan dikirim ke email Anda. Periksa kotak masuk atau spam.</p>
            </div>
        </div>
    </div>
    
    <!-- Right side - Form Panel -->
    <div class="w-full lg:w-1/2 flex items-center justify-center px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
        <div class="w-full max-w-md">
            <!-- Logo mobile -->
            <div class="lg:hidden text-center mb-6">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-teal-600 to-cyan-600 text-white rounded-2xl mb-3">
                    <i class="fa-solid fa-calculator text-2xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white break-words">e-Keuangan Siswa</h2>
                <p class="text-sm text-gray-600 dark:text-gray-400">Reset password</p>
            </div>
            
            <div class="text-center mb-6">
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white break-words">Lupa Password?</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Masukkan email untuk reset password</p>
            </div>
            
            @if (session('status'))
                <div class="mb-4 p-3 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 rounded-lg text-sm">
                    <i class="fa-regular fa-circle-check mr-2"></i>{{ session('status') }}
                </div>
            @endif
            
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300 rounded-lg text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                @csrf
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <i class="fa-regular fa-envelope"></i>
                        </span>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                               class="w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none transition dark:bg-gray-700 dark:text-white"
                               placeholder="nama@email.com">
                    </div>
                </div>
                
                <button type="submit" class="w-full bg-gradient-to-r from-teal-600 to-cyan-600 text-white py-2.5 px-4 rounded-lg font-semibold hover:shadow-lg transition-all hover:scale-[1.02]">
                    <i class="fa-regular fa-paper-plane mr-2"></i>Kirim Link Reset
                </button>
                
                <div class="text-center mt-4">
                    <a href="{{ route('login') }}" class="text-sm text-teal-600 dark:text-teal-400 hover:underline">
                        <i class="fa-solid fa-arrow-left mr-1"></i>Kembali ke Login
                    </a>
                    <p class="text-xs text-gray-500 dark:text-gray-500 mt-4">
                        <i class="fa-regular fa-copyright mr-1"></i> {{ date('Y') }} e-Keuangan Siswa
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection