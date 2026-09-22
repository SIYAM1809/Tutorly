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
        <!-- Left: Brand Logo & Sidebar Toggle -->
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

            <!-- Hamburger Button -->
            <button @click="sidebarOpen = !sidebarOpen" class="text-[#9c9fa6] hover:text-[#b66dff] p-1.5 rounded-lg hover:bg-slate-50 transition-colors" title="Toggle Navigation">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            <!-- Global Live Search (Relatable & Connected) -->
            <div class="hidden md:block flex-1 max-w-md">
                @livewire('search.global-search')
            </div>
        </div>

        <!-- Right: Utility Actions & User Profile -->
        <div class="flex items-center gap-2 sm:gap-3">
            
            <!-- Campus / Branch Indicator Badge -->
            <div class="hidden lg:flex items-center gap-1.5 px-3 py-1 rounded-full bg-purple-50 border border-purple-200/70 text-[11px] font-semibold text-[#b66dff]">
                <span class="h-2 w-2 rounded-full bg-[#00d25b]"></span>
                <span>{{ auth()->user()->branch->name ?? 'All Campuses' }}</span>
            </div>

            <div class="h-6 w-px bg-[#ebedf2] hidden lg:block"></div>

            <!-- Fullscreen Classroom Mode Toggle -->
            <button onclick="document.fullscreenElement ? document.exitFullscreen() : document.documentElement.requestFullscreen()" class="p-2 text-[#9c9fa6] hover:text-[#b66dff] rounded-lg hover:bg-slate-50 transition-colors hidden sm:block" title="Classroom Fullscreen Mode">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                </svg>
            </button>

            <!-- Real-Time Reverb Notification Bell -->
            @livewire('navigation.notification-bell')

            <!-- User Profile Dropdown -->
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

                <!-- Relatable Dropdown Menu -->
                <div x-show="userDropdown" x-cloak x-transition class="absolute right-0 mt-2 w-56 bg-white border border-[#ebedf2] rounded-2xl shadow-xl py-2 text-xs z-50">
                    <div class="px-4 py-2 border-b border-[#ebedf2]">
                        <p class="font-bold text-[#343a40]">{{ auth()->user()->name ?? 'Administrator' }}</p>
                        <p class="text-[10px] text-[#9c9fa6]">{{ auth()->user()->email ?? 'admin@coachsync.app' }}</p>
                        <span class="inline-block mt-1 text-[9px] uppercase font-bold text-[#b66dff] bg-purple-50 px-2 py-0.5 rounded">
                            {{ auth()->user()->branch->name ?? 'Head Office' }}
                        </span>
                    </div>
                    @hasanyrole('super_admin|branch_admin')
                    <a href="{{ route('students.index') }}" class="flex items-center gap-2 px-4 py-2 text-[#495057] hover:bg-purple-50 hover:text-[#b66dff]">
                        <span>👥</span> Student Directory
                    </a>
                    <a href="{{ route('fees.index') }}" class="flex items-center gap-2 px-4 py-2 text-[#495057] hover:bg-purple-50 hover:text-[#b66dff]">
                        <span>💳</span> Tuition Invoices & Billing
                    </a>
                    <a href="{{ route('attendance.index') }}" class="flex items-center gap-2 px-4 py-2 text-[#495057] hover:bg-purple-50 hover:text-[#b66dff]">
                        <span>📋</span> Live Attendance Board
                    </a>
                    @endhasanyrole
                    <a href="{{ route('profile.show') }}" class="flex items-center gap-2 px-4 py-2 text-[#495057] hover:bg-purple-50 hover:text-[#b66dff] font-medium">
                        <span>⚙️</span> Profile & Security
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

            <!-- Standalone Sign Out Button -->
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

    <!-- BODY WRAPPER: SIDEBAR + CONTENT -->
    <div class="flex min-h-[calc(100vh-4rem)]">

        <!-- VERTICAL LEFT SIDEBAR -->
        <aside 
            x-show="sidebarOpen" 
            x-transition:enter="transition ease-out duration-200" 
            x-transition:enter-start="-translate-x-full" 
            x-transition:enter-end="translate-x-0"
            class="w-64 bg-white border-r border-[#ebedf2] flex-shrink-0 flex flex-col justify-between py-6 z-30"
        >
            <div class="space-y-6">
                {{-- User Mini-Profile Card --}}
                <div class="px-6 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="relative">
                            <div class="h-10 w-10 rounded-full bg-gradient-to-tr from-[#b66dff] to-[#6c5ce7] text-white font-bold flex items-center justify-center text-sm shadow-sm">
                                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 2)) }}
                            </div>
                            <span class="absolute bottom-0 right-0 h-2.5 w-2.5 rounded-full bg-[#00d25b] border-2 border-white"></span>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-[#343a40]">{{ auth()->user()->name ?? 'User' }}</h4>
                            @php
                                $roleLabel = match(true) {
                                    auth()->user()->hasRole('super_admin')  => ['Super Admin',   'bg-purple-100 text-purple-700'],
                                    auth()->user()->hasRole('branch_admin') => ['Branch Admin',  'bg-blue-100 text-blue-700'],
                                    auth()->user()->hasRole('teacher')      => ['Teacher',        'bg-green-100 text-green-700'],
                                    auth()->user()->hasRole('student')      => ['Student',        'bg-amber-100 text-amber-700'],
                                    auth()->user()->hasRole('parent')       => ['Parent',         'bg-pink-100 text-pink-700'],
                                    default                                 => ['User',            'bg-slate-100 text-slate-600'],
                                };
                            @endphp
                            <span class="text-[9px] font-bold px-1.5 py-0.5 rounded {{ $roleLabel[1] }}">{{ $roleLabel[0] }}</span>
                        </div>
                    </div>
                    <span class="p-1 rounded-full bg-[#00d25b]/10 text-[#00d25b]" title="Active & Verified">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </span>
                </div>

                {{-- Role-Based Navigation Menu --}}
                <nav class="space-y-1 px-3">

                    {{-- Dashboard (all roles) --}}
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

                    {{-- ─── ADMIN & BRANCH ADMIN SECTION ─── --}}
                    @hasanyrole('super_admin|branch_admin')

                        <p class="px-4 pt-3 pb-1 text-[9px] font-black uppercase tracking-widest text-[#ced4da]">Management</p>

                        <a href="{{ route('students.index') }}" class="flex items-center justify-between px-4 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('students.index') ? 'text-[#b66dff] bg-purple-50/80 font-bold border-r-4 border-[#b66dff]' : 'text-[#495057] hover:text-[#b66dff] hover:bg-slate-50' }}">
                            <div class="flex items-center gap-3">
                                <span class="{{ request()->routeIs('students.index') ? 'text-[#b66dff]' : 'text-[#9c9fa6]' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                </span>
                                <span>Students</span>
                            </div>
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
                        </a>

                        {{-- Public Site Link (Admin only) --}}
                        @hasrole('super_admin')
                            <p class="px-4 pt-3 pb-1 text-[9px] font-black uppercase tracking-widest text-[#ced4da]">Institute</p>
                            <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-xs font-semibold text-[#495057] hover:text-[#b66dff] hover:bg-slate-50 transition-all">
                                <span class="text-[#9c9fa6]">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                                    </svg>
                                </span>
                                <span>Public Homepage ↗</span>
                            </a>
                        @endhasrole

                    @endhasanyrole

                    {{-- ─── TEACHER SECTION ─── --}}
                    @hasrole('teacher')

                        <p class="px-4 pt-3 pb-1 text-[9px] font-black uppercase tracking-widest text-[#ced4da]">Classroom</p>

                        <a href="{{ route('attendance.index') }}" class="flex items-center justify-between px-4 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('attendance.index') ? 'text-[#b66dff] bg-purple-50/80 font-bold border-r-4 border-[#b66dff]' : 'text-[#495057] hover:text-[#b66dff] hover:bg-slate-50' }}">
                            <div class="flex items-center gap-3">
                                <span class="{{ request()->routeIs('attendance.index') ? 'text-[#b66dff]' : 'text-[#9c9fa6]' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                    </svg>
                                </span>
                                <span>Mark Attendance</span>
                            </div>
                            <span class="text-[10px] bg-green-100 text-green-700 font-bold px-1.5 rounded">Today</span>
                        </a>

                        <a href="{{ route('batches.index') }}" class="flex items-center justify-between px-4 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('batches.index') ? 'text-[#b66dff] bg-purple-50/80 font-bold border-r-4 border-[#b66dff]' : 'text-[#495057] hover:text-[#b66dff] hover:bg-slate-50' }}">
                            <div class="flex items-center gap-3">
                                <span class="{{ request()->routeIs('batches.index') ? 'text-[#b66dff]' : 'text-[#9c9fa6]' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                    </svg>
                                </span>
                                <span>My Batches</span>
                            </div>
                        </a>

                        <a href="{{ route('exams.index') }}" class="flex items-center justify-between px-4 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('exams.index') ? 'text-[#b66dff] bg-purple-50/80 font-bold border-r-4 border-[#b66dff]' : 'text-[#495057] hover:text-[#b66dff] hover:bg-slate-50' }}">
                            <div class="flex items-center gap-3">
                                <span class="{{ request()->routeIs('exams.index') ? 'text-[#b66dff]' : 'text-[#9c9fa6]' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </span>
                                <span>Exams</span>
                            </div>
                        </a>

                    @endhasrole

                    {{-- ─── STUDENT SECTION ─── --}}
                    @hasrole('student')

                        <p class="px-4 pt-3 pb-1 text-[9px] font-black uppercase tracking-widest text-[#ced4da]">My Portal</p>

                        <a href="{{ route('student.batches') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('student.batches') ? 'text-[#b66dff] bg-purple-50/80 font-bold border-r-4 border-[#b66dff]' : 'text-[#495057] hover:text-[#b66dff] hover:bg-slate-50' }}">
                            <span class="{{ request()->routeIs('student.batches') ? 'text-[#b66dff]' : 'text-[#9c9fa6]' }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </span>
                            <span>My Batches</span>
                        </a>

                        <a href="{{ route('student.attendance') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('student.attendance') ? 'text-[#b66dff] bg-purple-50/80 font-bold border-r-4 border-[#b66dff]' : 'text-[#495057] hover:text-[#b66dff] hover:bg-slate-50' }}">
                            <span class="{{ request()->routeIs('student.attendance') ? 'text-[#b66dff]' : 'text-[#9c9fa6]' }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </span>
                            <span>My Attendance</span>
                        </a>

                        <a href="{{ route('student.exams') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('student.exams') ? 'text-[#b66dff] bg-purple-50/80 font-bold border-r-4 border-[#b66dff]' : 'text-[#495057] hover:text-[#b66dff] hover:bg-slate-50' }}">
                            <span class="{{ request()->routeIs('student.exams') ? 'text-[#b66dff]' : 'text-[#9c9fa6]' }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </span>
                            <span>My Exams</span>
                        </a>

                        <a href="{{ route('student.fees') }}" class="flex items-center justify-between px-4 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('student.fees') ? 'text-[#b66dff] bg-purple-50/80 font-bold border-r-4 border-[#b66dff]' : 'text-[#495057] hover:text-[#b66dff] hover:bg-slate-50' }}">
                            <div class="flex items-center gap-3">
                                <span class="{{ request()->routeIs('student.fees') ? 'text-[#b66dff]' : 'text-[#9c9fa6]' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                    </svg>
                                </span>
                                <span>Pay Fees</span>
                            </div>
                        </a>

                    @endhasrole

                    {{-- ─── PARENT / GUARDIAN SECTION ─── --}}
                    @hasrole('parent')
                        <p class="px-4 pt-3 pb-1 text-[9px] font-black uppercase tracking-widest text-[#ced4da]">Parent Portal</p>

                        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('dashboard') ? 'text-[#b66dff] bg-purple-50/80 font-bold border-r-4 border-[#b66dff]' : 'text-[#495057] hover:text-[#b66dff] hover:bg-slate-50' }}">
                            <span class="{{ request()->routeIs('dashboard') ? 'text-[#b66dff]' : 'text-[#9c9fa6]' }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </span>
                            <span>Student Progress</span>
                        </a>

                        @if(auth()->user()->child?->fees()->where('status', '!=', 'paid')->first())
                            @php $dueFee = auth()->user()->child->fees()->where('status', '!=', 'paid')->first(); @endphp
                            <a href="{{ route('payment.pay', $dueFee) }}" class="flex items-center justify-between px-4 py-2.5 rounded-xl text-xs font-semibold text-[#fe7096] bg-rose-50/50 hover:bg-rose-50 transition-all">
                                <div class="flex items-center gap-3">
                                    <span>💳</span>
                                    <span>Pay Due Fees</span>
                                </div>
                                <span class="text-[10px] font-bold bg-rose-200 text-rose-700 px-1.5 py-0.5 rounded">Due</span>
                            </a>
                        @endif
                    @endhasrole

                </nav>
            </div>

            {{-- Sidebar Footer --}}
            <div class="px-6 pt-6 border-t border-[#ebedf2]">
                <div class="p-4 rounded-2xl bg-gradient-to-br from-purple-500/10 to-indigo-500/10 border border-purple-200/50 text-center space-y-1.5">
                    <span class="text-xl">🎓</span>
                    <h5 class="text-xs font-bold text-[#343a40]">Tutorly Academy OS</h5>
                    <p class="text-[10px] text-[#9c9fa6]">{{ auth()->user()->branch?->name ?? 'Multi-Branch Active' }}</p>
                </div>
            </div>
        </aside>

        <!-- MAIN VIEW CANVAS -->
        <main class="flex-1 p-6 sm:p-8 max-w-full overflow-x-hidden">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
</body>
</html>
