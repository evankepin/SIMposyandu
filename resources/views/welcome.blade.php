<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Posyandu Balita - Sistem Informasi</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=nunito:400,600,700,800&display=swap" rel="stylesheet" />
        
        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
        
        <!-- Custom Styles -->
        <style>
            /* Custom animations */
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
            }
            
            @keyframes bounce-gentle {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-5px); }
            }
            
            @keyframes pulse-soft {
                0%, 100% { opacity: 1; }
                50% { opacity: 0.7; }
            }
            
            @keyframes gradient-shift {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }
            
            .animate-float {
                animation: float 3s ease-in-out infinite;
            }
            
            .animate-bounce-gentle {
                animation: bounce-gentle 2s ease-in-out infinite;
            }
            
            .animate-pulse-soft {
                animation: pulse-soft 2s ease-in-out infinite;
            }
            
            .animate-gradient {
                background-size: 200% 200%;
                animation: gradient-shift 3s ease infinite;
            }
            
            .bg-pattern {
                background-image: 
                    radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.1) 0%, transparent 50%),
                    radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.1) 0%, transparent 50%),
                    radial-gradient(circle at 40% 40%, rgba(120, 200, 255, 0.1) 0%, transparent 50%);
            }
            
            .glass-effect {
                backdrop-filter: blur(10px);
                background: rgba(255, 255, 255, 0.25);
            }
            
            .card-hover {
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
            
            .card-hover:hover {
                transform: translateY(-10px) scale(1.02);
            }
            
            .text-gradient {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }
            
            .blob {
                border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
                animation: float 6s ease-in-out infinite;
            }
            
            /* Particle effects */
            .particle {
                position: absolute;
                border-radius: 50%;
                pointer-events: none;
            }
            
            .particle-1 { top: 10%; left: 10%; width: 4px; height: 4px; background: rgba(255, 182, 193, 0.6); animation: float 4s ease-in-out infinite; }
            .particle-2 { top: 20%; right: 15%; width: 6px; height: 6px; background: rgba(173, 216, 230, 0.6); animation: bounce-gentle 3s ease-in-out infinite; }
            .particle-3 { bottom: 30%; left: 20%; width: 5px; height: 5px; background: rgba(221, 160, 221, 0.6); animation: pulse-soft 2s ease-in-out infinite; }
            .particle-4 { bottom: 15%; right: 25%; width: 3px; height: 3px; background: rgba(255, 218, 185, 0.6); animation: float 5s ease-in-out infinite; }
        </style>
    </head>
    <body class="antialiased bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 bg-pattern selection:bg-pink-500 selection:text-white font-['Nunito']">
        <!-- Particles -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none">
            <div class="particle particle-1"></div>
            <div class="particle particle-2"></div>
            <div class="particle particle-3"></div>
            <div class="particle particle-4"></div>
        </div>

        <!-- Background decorative elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-pink-300 to-rose-400 blob opacity-30"></div>
            <div class="absolute top-1/4 -left-8 w-24 h-24 bg-gradient-to-br from-blue-300 to-indigo-400 blob opacity-30"></div>
            <div class="absolute bottom-1/4 right-1/4 w-20 h-20 bg-gradient-to-br from-purple-300 to-pink-400 blob opacity-30"></div>
            <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-gradient-to-br from-green-300 to-teal-400 blob opacity-20"></div>
        </div>

        <div class="relative min-h-screen">
            <!-- Laravel Authentication Navigation -->
            @if (Route::has('login'))
                <nav class="fixed top-0 right-0 p-6 z-50">
                    @auth
                        <a href="{{ url('/home') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-pink-500 to-rose-600 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Dashboard
                        </a>
                    @else
                        <div class="flex gap-4">
                            <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                </svg>
                                Masuk
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-teal-600 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                    </svg>
                                    Daftar
                                </a>
                            @endif
                        </div>
                    @endauth
                </nav>
            @endif

            <div class="container mx-auto px-6 py-12">
                <!-- Hero Section -->
                <div class="text-center mb-16 pt-20">
                    <div class="flex justify-center mb-8">
                        <div class="relative">
                            <div class="w-32 h-32 bg-gradient-to-br from-pink-400 via-purple-500 to-blue-600 rounded-3xl flex items-center justify-center shadow-2xl transform rotate-3 animate-float">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </div>
                            <div class="absolute -top-3 -right-3 w-8 h-8 bg-gradient-to-r from-yellow-400 to-orange-400 rounded-full animate-bounce-gentle"></div>
                            <div class="absolute -bottom-2 -left-2 w-6 h-6 bg-gradient-to-r from-green-400 to-emerald-400 rounded-full animate-pulse-soft"></div>
                        </div>
                    </div>
                    
                    <h1 class="text-6xl font-bold text-gray-800 mb-6">
                        <span class="text-gradient">Posyandu Balita</span>
                    </h1>
                    <p class="text-2xl text-gray-600 max-w-2xl mx-auto leading-relaxed mb-8">
                        Sistem Informasi Kesehatan Anak untuk Tumbuh Kembang Optimal
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-8 py-4 bg-gradient-to-r from-pink-500 to-rose-500 text-white font-bold rounded-full shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 animate-gradient text-center">
                                Mulai Sekarang
                            </a>
                        @endif
                        <a href="#features" class="px-8 py-4 bg-white text-gray-700 font-semibold rounded-full shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 border border-gray-200 text-center">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>

                <!-- Features Grid -->
                <div id="features" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                    <!-- Data Balita Card -->
                    <div class="card-hover bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl p-8 border border-white/20">
                        <div class="flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl mb-6 mx-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">Data Balita</h3>
                        <p class="text-gray-600 text-center leading-relaxed">
                            Kelola data lengkap balita dengan mudah. Catat informasi personal, riwayat kesehatan, dan perkembangan anak.
                        </p>
                    </div>

                    <!-- Monitoring Kesehatan Card -->
                    <div class="card-hover bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl p-8 border border-white/20">
                        <div class="flex items-center justify-center w-16 h-16 bg-gradient-to-br from-green-400 to-emerald-600 rounded-2xl mb-6 mx-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">Riwayat Imunisasi</h3>
                        <p class="text-gray-600 text-center leading-relaxed">
                            Pantau tumbuh kembang balita pemantauan berat badan, tinggi badan dan pemberian imunisasi serta vitamin.
                        </p>
                    </div>

                    <!-- Jadwal Imunisasi Card -->
                    <div class="card-hover bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl p-8 border border-white/20">
                        <div class="flex items-center justify-center w-16 h-16 bg-gradient-to-br from-purple-400 to-purple-600 rounded-2xl mb-6 mx-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m-7 4a9 9 0 1118 0 9 9 0 01-18 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">Jadwal Imunisasi</h3>
                        <p class="text-gray-600 text-center leading-relaxed">
                            Cek jadwal imunisasi terbaru untuk balita Anda. Pastikan setiap vaksinasi tercatat dengan baik dan tepat waktu.
                        </p>
                    </div>
