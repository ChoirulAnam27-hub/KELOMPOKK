<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Futsal Booking Pro</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800|outfit:500,600,700,800&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, .font-heading { font-family: 'Outfit', sans-serif; }
        .glass-panel {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .bg-gradient-mesh {
            background-color: #0f172a;
            background-image: 
                radial-gradient(at 0% 0%, hsla(253,16%,7%,1) 0, transparent 50%), 
                radial-gradient(at 50% 0%, hsla(225,39%,30%,1) 0, transparent 50%), 
                radial-gradient(at 100% 0%, hsla(339,49%,30%,1) 0, transparent 50%);
        }
    </style>
</head>
<body class="antialiased bg-gradient-mesh text-slate-100 min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav class="fixed w-full z-50 glass-panel border-b border-slate-700/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <div class="flex-shrink-0">
                    <a href="/" class="flex items-center gap-2 group">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center shadow-lg shadow-blue-500/30 group-hover:shadow-blue-500/50 transition-all duration-300">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </div>
                        <span class="font-heading font-bold text-2xl tracking-tight text-white">Futsal<span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-500">Pro</span></span>
                    </a>
                </div>
                <div class="hidden md:block">
                    <div class="ml-4 flex items-center space-x-6">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ route('bookings.index') }}" class="text-sm font-medium text-slate-300 hover:text-white transition-colors duration-200 flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                    Riwayat Booking
                                </a>
                                <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-slate-300 hover:text-white transition-colors duration-200">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-medium text-slate-300 hover:text-white transition-colors duration-200">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-full text-sm font-medium bg-white text-slate-900 hover:bg-slate-100 hover:scale-105 transition-all duration-200 shadow-[0_0_20px_rgba(255,255,255,0.2)]">Register</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="flex-grow pt-32 pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-20 animate-fade-in-up">
                <h1 class="text-5xl md:text-7xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-white via-blue-100 to-slate-400 mb-6 font-heading tracking-tight drop-shadow-sm">
                    JustBoking Futsal Semarang
                </h1>
                <p class="mt-4 text-xl text-slate-400 font-light leading-relaxed">
                    Booking lapangan futsal premium di Semarang kini cuma hitungan detik. Pilih tempat favoritmu, amankan jadwal, dan tunjukkan skill terbaikmu hari ini.
                </p>
                <div class="mt-10 flex justify-center gap-4">
                    <a href="#courts" class="px-8 py-4 rounded-full font-semibold text-white bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-500 hover:to-purple-500 hover:shadow-[0_0_30px_rgba(59,130,246,0.5)] transform hover:-translate-y-1 transition-all duration-300">
                        Lihat Lapangan
                    </a>
                </div>
            </div>

            <!-- Courts List -->
            <div id="courts" class="mt-16 scroll-mt-24">
                <div class="flex items-center justify-between mb-10">
                    <h2 class="text-3xl font-bold font-heading text-white flex items-center gap-3">
                        <span class="w-2 h-8 rounded-full bg-blue-500 inline-block"></span>
                        Daftar Lapangan
                    </h2>
                </div>
                
                @if($courts->isEmpty())
                    <div class="glass-panel p-12 text-center rounded-3xl">
                        <div class="w-20 h-20 mx-auto bg-slate-800 rounded-full flex items-center justify-center mb-6 border border-slate-700">
                            <svg class="w-10 h-10 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-semibold text-white mb-2">Belum ada lapangan</h3>
                        <p class="text-slate-400">Silakan hubungi admin untuk menambahkan daftar lapangan futsal.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($courts as $court)
                            <div class="glass-panel rounded-3xl overflow-hidden group hover:-translate-y-2 hover:shadow-[0_20px_40px_rgba(0,0,0,0.4)] hover:border-blue-500/30 transition-all duration-500 flex flex-col">
                                <div class="relative h-56 w-full bg-slate-800 overflow-hidden">
                                    @if($court->photo)
                                        <img src="{{ Storage::url($court->photo) }}" alt="{{ $court->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    @else
                                        <div class="w-full h-full flex flex-col items-center justify-center text-slate-600 bg-gradient-to-br from-slate-800 to-slate-900">
                                            <svg class="w-16 h-16 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            <span class="text-sm font-medium tracking-wider uppercase opacity-75">No Image</span>
                                        </div>
                                    @endif
                                    <div class="absolute top-4 right-4 bg-slate-900/80 backdrop-blur-md px-3 py-1.5 rounded-full border border-white/10">
                                        <p class="text-sm font-bold text-white tracking-wide">Rp {{ number_format($court->price_per_hour, 0, ',', '.') }}<span class="text-slate-400 text-xs font-normal">/jam</span></p>
                                    </div>
                                </div>
                                <div class="p-8 flex flex-col flex-grow">
                                    <div class="flex-grow">
                                        <div class="flex items-center gap-2 mb-3">
                                            <span class="px-2.5 py-1 text-xs font-semibold uppercase tracking-wider text-blue-300 bg-blue-500/10 border border-blue-500/20 rounded-md">
                                                {{ $court->floor_type }}
                                            </span>
                                        </div>
                                        <h3 class="text-2xl font-bold text-white mb-2 font-heading group-hover:text-blue-400 transition-colors">{{ $court->name }}</h3>
                                    </div>
                                    <div class="mt-8">
                                        <a href="{{ route('bookings.create', $court->id) }}" class="block w-full py-3.5 px-4 bg-white/5 hover:bg-white/10 border border-white/10 hover:border-blue-500/50 rounded-xl text-center font-medium text-white transition-all duration-300 group-hover:shadow-[0_0_15px_rgba(59,130,246,0.2)]">
                                            Booking Sekarang
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="border-t border-slate-800 mt-auto py-8 text-center text-slate-500 text-sm">
        <p>&copy; {{ date('Y') }} Futsal Booking Pro. All rights reserved.</p>
    </footer>

    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
    </style>
</body>
</html>
