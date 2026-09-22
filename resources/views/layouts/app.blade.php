<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Tutorly') }} — Multi-Branch Coaching Platform</title>

    <!-- Google Fonts: Inter & Ubuntu -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }
        .purple-gradient-card {
            position: relative;
            overflow: hidden;
        }
        .purple-gradient-card::after {
            content: '';
            position: absolute;
            right: -20px;
            bottom: -30px;
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.15);
            pointer-events: none;
        }
        .purple-gradient-card::before {
            content: '';
            position: absolute;
            right: 40px;
            bottom: -40px;
            width: 110px;
            height: 110px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.12);
            pointer-events: none;
        }
    </style>
</head>
<body class="bg-[#f2edf3] text-[#343a40] min-h-screen antialiased selection:bg-[#b66dff] selection:text-white" x-data="{ sidebarOpen: true, userDropdown: false }">

    <!-- TOP NAVBAR -->
    <header class="sticky top-0 z-40 bg-white border-b border-[#ebedf2] h-16 flex items-center justify-between px-4 sm:px-6 shadow-xs">
        <div class="flex items-center gap-4 sm:gap-6 flex-1 max-w-xl">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 flex-shrink-0">
                <div class="h-8 w-8 rounded-lg bg-gradient-to-tr from-[#b66dff] to-[#6c5ce7] flex items-center justify-center text-white font-black text-sm shadow-md shadow-purple-500/20">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                </div>
                <div class="flex items-center gap-1.5">
                    <span class="font-extrabold text-xl tracking-tight text-[#b66dff] font-['Ubuntu',sans-serif]">Tutorly</span>
                    <span class="text-[9px] uppercase font-bold tracking-wider px-1.5 py-0.5 rounded bg-purple-50 text-purple-600 border border-purple-200/60 hidden sm:inline">Coaching OS</span>
                </div>
            </a>

            <button @click="sidebarOpen = !sidebarOpen" class="text-[#9c9fa6] hover:text-[#b66dff] p-1.5 rounded-lg hover:bg-slate-50 transition-colors" title="Toggle Navigation">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            <div class="hidden md:block flex-1 max-w-md">
                @livewire('search.global-search')
            </div>
        </div>

        <div class="flex items-center gap-2 sm:gap-3">
            <div class="hidden lg:flex items-center gap-1.5 px-3 py-1 rounded-full bg-purple-50 border border-purple-200/70 text-[11px] font-semibold text-[#b66dff]">
                <span class="h-2 w-2 rounded-full bg-[#00d25b]"></span>
                <span>{{ auth()->user()->branch->name ?? 'All Campuses' }}</span>
            </div>

            <div class="h-6 w-px bg-[#ebedf2] hidden lg:block"></div>

            <button onclick="document.fullscreenElement ? document.exitFullscreen() : document.documentElement.requestFullscreen()" class="p-2 text-[#9c9fa6] hover:text-[#b66dff] rounded-lg hover:bg-slate-50 transition-colors hidden sm:block" title="Classroom Fullscreen Mode">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                </svg>
            </button>

            @livewire('navigation.notification-bell')

            <div class="relative ml-1" @click.away="userDropdown = false">
                <button @click="userDropdown = !userDropdown" class="flex items-center gap-2 py-1 px-1.5 rounded-lg hover:bg-slate-50 transition-colors">
                    <div class="relative">
                        <div class="h-8 w-8 rounded-full bg-gradient-to-tr from-[#b66dff] to-[#6c5ce7] text-white font-bold flex items-center justify-center text-xs shadow-xs">
                            {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 2)) }}
                        </div>
                        <span class="absolute bottom-0 right-0 h-2.5 w-2.5 rounded-full bg-[#00d25b] border-2 border-white"></span>
                    </div>
                    <div class="hidden sm:flex items-center gap-1">
                        <span class="text-xs font-semibold text-[#343a40]">{{ auth()->user()->name ?? 'Administrator' }}</span>
                        <svg class="w-3.5 h-3.5 text-[#9c9fa6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </button>

                <div x-show="userDropdown" x-cloak x-transition class="absolute right-0 mt-2 w-56 bg-white border border-[#ebedf2] rounded-2xl shadow-xl py-2 text-xs z-50">
                    <div class="px-4 py-2 border-b border-[#ebedf2]">
                        <p class="font-bold text-[#343a40]">{{ auth()->user()->name ?? 'Administrator' }}</p>
                        <p class="text-[10px] text-[#9c9fa6]">{{ auth()->user()->email ?? 'admin@coachsync.app' }}</p>
                        <span class="inline-block mt-1 text-[9px] uppercase font-bold text-[#b66dff] bg-purple-50 px-2 py-0.5 rounded">
                            {{ auth()->user()->branch->name ?? 'Head Office' }}
                        </span>
                    </div>
                    <a href="{{ route('students.index') }}" class="flex items-center gap-2 px-4 py-2 text-[#495057] hover:bg-purple-50 hover:text-[#b66dff]">
                        <span>👥</span> Student Directory
                    </a>
                    <a href="{{ route('fees.index') }}" class="flex items-center gap-2 px-4 py-2 text-[#495057] hover:bg-purple-50 hover:text-[#b66dff]">
                        <span>💳</span> Tuition Invoices & Billing
                    </a>
                    <a href="{{ route('attendance.index') }}" class="flex items-center gap-2 px-4 py-2 text-[#495057] hover:bg-purple-50 hover:text-[#b66dff]">
                        <span>📋</span> Live Attendance Board
                    </a>
                    <div class="border-t border-[#ebedf2] my-1"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-rose-500 hover:bg-rose-50 font-semibold flex items-center gap-2">
                            <span>🚪</span> Sign out
                        </button>
                    </form>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="inline ml-1">
                @csrf
                <button type="submit" class="p-2 text-[#9c9fa6] hover:text-rose-500 rounded-lg hover:bg-rose-50 transition-colors" title="Sign out">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                </button>
            </form>
        </div>
    </header>

    <div class="flex min-h-[calc(100vh-4rem)]">
        <aside 
            x-show="sidebarOpen" 
            x-transition:enter="transition ease-out duration-200" 
            x-transition:enter-start="-translate-x-full" 
            x-transition:enter-end="translate-x-0"
            class="w-64 bg-white border-r border-[#ebedf2] flex-shrink-0 flex flex-col justify-between py-6 z-30"
        >
            <div class="space-y-6">
                <div class="px-6 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="relative">
                            <div class="h-10 w-10 rounded-full bg-gradient-to-tr from-[#b66dff] to-[#6c5ce7] text-white font-bold flex items-center justify-center text-sm shadow-sm">
                                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 2)) }}
                            </div>
                            <span class="absolute bottom-0 right-0 h-2.5 w-2.5 rounded-full bg-[#00d25b] border-2 border-white"></span>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-[#343a40]">{{ auth()->user()->name ?? 'Administrator' }}</h4>
                            <p class="text-[10px] text-[#9c9fa6]">{{ auth()->user()->branch->name ?? 'All Branches' }}</p>
                        </div>
                    </div>
                    <span class="p-1 rounded-full bg-[#00d25b]/10 text-[#00d25b]" title="Active & Verified">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </span>
                </div>

                <nav class="space-y-1 px-3">
                    <a href="{{ route('dashboard') }}" class="flex items-center justify-between px-4 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('dashboard') ? 'text-[#b66dff] bg-purple-50/80 font-bold border-r-4 border-[#b66dff]' : 'text-[#495057] hover:text-[#b66dff] hover:bg-slate-50' }}">
                        <div class="flex items-center gap-3">
                            <span class="{{ request()->routeIs('dashboard') ? 'text-[#b66dff]' : 'text-[#9c9fa6]' }}">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                                </svg>
                            </span>
                            <span>Dashboard</span>
                        </div>
                        <span class="text-[10px] text-purple-400">●</span>
                    </a>

                    <a href="{{ route('students.index') }}" class="flex items-center justify-between px-4 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('students.index') ? 'text-[#b66dff] bg-purple-50/80 font-bold border-r-4 border-[#b66dff]' : 'text-[#495057] hover:text-[#b66dff] hover:bg-slate-50' }}">
                        <div class="flex items-center gap-3">
                            <span class="{{ request()->routeIs('students.index') ? 'text-[#b66dff]' : 'text-[#9c9fa6]' }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </span>
                            <span>Students</span>
                        </div>
                        <span class="text-[#ced4da] text-[10px]">&lt;</span>
                    </a>

                    <a href="{{ route('batches.index') }}" class="flex items-center justify-between px-4 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('batches.index') ? 'text-[#b66dff] bg-purple-50/80 font-bold border-r-4 border-[#b66dff]' : 'text-[#495057] hover:text-[#b66dff] hover:bg-slate-50' }}">
                        <div class="flex items-center gap-3">
                            <span class="{{ request()->routeIs('batches.index') ? 'text-[#b66dff]' : 'text-[#9c9fa6]' }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                            </span>
                            <span>Batches</span>
                        </div>
                        <span class="text-[#ced4da] text-[10px]">&lt;</span>
                    </a>

                    <a href="{{ route('attendance.index') }}" class="flex items-center justify-between px-4 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('attendance.index') ? 'text-[#b66dff] bg-purple-50/80 font-bold border-r-4 border-[#b66dff]' : 'text-[#495057] hover:text-[#b66dff] hover:bg-slate-50' }}">
                        <div class="flex items-center gap-3">
                            <span class="{{ request()->routeIs('attendance.index') ? 'text-[#b66dff]' : 'text-[#9c9fa6]' }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                </svg>
                            </span>
                            <span>Attendance Board</span>
                        </div>
                        <span class="text-[#ced4da] text-[10px]">&lt;</span>
                    </a>

                    <a href="{{ route('fees.index') }}" class="flex items-center justify-between px-4 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('fees.index') ? 'text-[#b66dff] bg-purple-50/80 font-bold border-r-4 border-[#b66dff]' : 'text-[#495057] hover:text-[#b66dff] hover:bg-slate-50' }}">
                        <div class="flex items-center gap-3">
                            <span class="{{ request()->routeIs('fees.index') ? 'text-[#b66dff]' : 'text-[#9c9fa6]' }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </span>
                            <span>Fees & Payments</span>
                        </div>
                        <span class="text-[#ced4da] text-[10px]">&lt;</span>
                    </a>

                    <a href="{{ route('exams.index') }}" class="flex items-center justify-between px-4 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('exams.index') ? 'text-[#b66dff] bg-purple-50/80 font-bold border-r-4 border-[#b66dff]' : 'text-[#495057] hover:text-[#b66dff] hover:bg-slate-50' }}">
                        <div class="flex items-center gap-3">
                            <span class="{{ request()->routeIs('exams.index') ? 'text-[#b66dff]' : 'text-[#9c9fa6]' }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </span>
                            <span>Exams & Certs</span>
                        </div>
                        <span class="text-[#ced4da] text-[10px]">&lt;</span>
                    </a>
                </nav>
            </div>

            <div class="px-6 pt-6 border-t border-[#ebedf2]">
                <div class="p-4 rounded-2xl bg-gradient-to-br from-purple-500/10 to-indigo-500/10 border border-purple-200/50 text-center space-y-1.5">
                    <span class="text-xl">🎓</span>
                    <h5 class="text-xs font-bold text-[#343a40]">Tutorly Academy OS</h5>
                    <p class="text-[10px] text-[#9c9fa6]">{{ auth()->user()->branch->name ?? 'Multi-Branch Active' }}</p>
                </div>
            </div>
        </aside>

        <main class="flex-1 p-6 sm:p-8 max-w-full overflow-x-hidden">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
</body>
</html>
