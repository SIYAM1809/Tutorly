<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Tutorly') }} — Multi-Branch Coaching Platform</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen flex flex-col font-sans antialiased">

    <!-- Header Navigation -->
    <header class="sticky top-0 z-40 bg-slate-900/80 backdrop-blur-xl border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between gap-4">
            <!-- Brand Logo & Branch Indicator -->
            <div class="flex items-center gap-4">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 group">
                    <div class="h-9 w-9 rounded-xl bg-gradient-to-tr from-indigo-600 to-cyan-500 flex items-center justify-center font-black text-white text-lg shadow-lg shadow-indigo-600/30 group-hover:scale-105 transition-transform">
                        TL
                    </div>
                    <div>
                        <span class="font-extrabold text-lg tracking-tight text-white group-hover:text-indigo-400 transition-colors">Tutorly</span>
                        <span class="block text-[9px] font-semibold text-slate-400 uppercase tracking-widest">Multi-Branch SaaS</span>
                    </div>
                </a>

                @if(auth()->user()?->branch)
                <div class="hidden md:flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-800/80 border border-slate-700/60 text-[11px] font-medium text-indigo-300">
                    <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>{{ auth()->user()->branch->name ?? 'All Branches' }}</span>
                </div>
                @endif
            </div>

            <!-- Global Search Bar -->
            <div class="hidden sm:block flex-1 max-w-md mx-4">
                @livewire('search.global-search')
            </div>

            <!-- Actions: Notifications, Language, Profile -->
            <div class="flex items-center gap-3">
                @livewire('navigation.language-switcher')
                @livewire('navigation.notification-bell')

                <div class="h-8 w-px bg-slate-800"></div>

                <!-- User -->
                <div class="flex items-center gap-2">
                    <div class="h-8 w-8 rounded-full bg-indigo-600 text-white font-bold flex items-center justify-center text-xs">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 2)) }}
                    </div>
                    <span class="hidden lg:inline text-xs font-semibold text-slate-200">{{ auth()->user()->name ?? 'Admin' }}</span>
                </div>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-xs text-slate-400 hover:text-red-400 transition-colors px-2 py-1 rounded-lg hover:bg-slate-800">
                        Sign out
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Sub Navigation Bar -->
    <nav class="bg-slate-900/40 border-b border-slate-800/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center gap-6 overflow-x-auto text-xs font-semibold py-2.5">
            <a href="{{ route('dashboard') }}" class="px-3 py-1.5 rounded-lg text-slate-300 hover:text-white hover:bg-slate-800 transition-all flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('students.index') }}" class="px-3 py-1.5 rounded-lg text-slate-300 hover:text-white hover:bg-slate-800 transition-all flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <span>Students</span>
            </a>
            <a href="#" class="px-3 py-1.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-all">Batches</a>
            <a href="#" class="px-3 py-1.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-all">Attendance Board</a>
            <a href="#" class="px-3 py-1.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-all">Fees & Payments</a>
            <a href="#" class="px-3 py-1.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-all">Exams & Certificates</a>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900/60 border-t border-slate-800 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-4">
            <div>
                © {{ date('Y') }} <strong>Tutorly</strong>. Powered by Laravel 11, Livewire 3 & Gemini AI.
            </div>
            <div class="flex items-center gap-4">
                <span class="inline-flex items-center gap-1"><span class="h-2 w-2 rounded-full bg-emerald-400"></span> Reverb WebSocket Active</span>
                <span>•</span>
                <span>SSLCommerz Sandbox</span>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
