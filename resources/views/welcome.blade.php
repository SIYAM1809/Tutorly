<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tutorly® — Multi-Branch Coaching Management Platform</title>

    <!-- Google Fonts: Playfair Display for editorial typography & Inter for clean UI -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        .font-editorial {
            font-family: 'Playfair Display', Georgia, serif;
        }
        .font-ui {
            font-family: 'Inter', system-ui, sans-serif;
        }
        .hero-bg-gradient {
            background: linear-gradient(180deg, #EAE5DF 0%, #DCD6CE 45%, #C2B8AA 75%, #473E35 100%);
        }
        .glass-warm {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.7);
        }
        .terracotta-card {
            background: #8A6E59;
            color: #FAF8F5;
        }
    </style>
</head>
<body class="font-ui antialiased text-[#2B2621] selection:bg-[#2B2621] selection:text-[#FAF8F5] bg-[#EAE5DF] min-h-screen">

    <!-- HERO SECTION WRAPPER -->
    <div class="relative overflow-hidden hero-bg-gradient min-h-screen flex flex-col justify-between">

        <!-- ATMOSPHERIC MOUNTAIN & TERRAIN SILHOUETTE (Matches reference luxury style) -->
        <div class="absolute inset-0 pointer-events-none opacity-40 mix-blend-multiply">
            <svg class="absolute bottom-0 left-0 w-full h-[600px] object-cover" viewBox="0 0 1440 600" fill="none" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 380L140 310L290 350L450 260L620 330L780 240L960 320L1120 230L1290 300L1440 260V600H0V380Z" fill="#8F8274" fill-opacity="0.3"/>
                <path d="M0 430L180 340L360 390L540 310L720 370L900 300L1080 360L1260 320L1440 370V600H0V430Z" fill="#6B5F52" fill-opacity="0.45"/>
                <path d="M0 480C240 450 480 470 720 460C960 450 1200 480 1440 470V600H0V480Z" fill="#3D342C" fill-opacity="0.85"/>
            </svg>
        </div>

        <!-- 1. NAVIGATION BAR -->
        <header class="relative z-30 w-full max-w-7xl mx-auto px-6 sm:px-8 pt-6">
            <div class="flex items-center justify-between">
                <!-- Brand Logo -->
                <a href="/" class="flex items-center gap-2.5 group">
                    <div class="w-8 h-8 rounded-full bg-[#2B2621] text-[#FAF8F5] flex items-center justify-center font-bold text-xs shadow-md transition-transform group-hover:scale-105">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                        </svg>
                    </div>
                    <span class="font-editorial tracking-wider text-xl font-black uppercase text-[#2B2621]">TUTORLY</span>
                </a>

                <!-- Focused Navigation Links (Only actual project features) -->
                <nav class="hidden md:flex items-center gap-8 text-xs font-semibold tracking-wider text-[#4A423B] uppercase">
                    <a href="#attendance" class="hover:text-[#2B2621] transition-colors">Live Attendance</a>
                    <a href="#ai-insights" class="hover:text-[#2B2621] transition-colors">Gemini AI Radar</a>
                    <a href="#parent-whatsapp" class="hover:text-[#2B2621] transition-colors">WhatsApp Alerts</a>
                    <a href="#roles" class="hover:text-[#2B2621] transition-colors">Roles & Actors</a>
                </nav>

                <!-- Language & Sign In CTA -->
                <div class="flex items-center gap-5">
                    <span class="text-xs font-semibold text-[#5A524A] tracking-wider uppercase hidden sm:inline-block">ENG / বাংলা</span>
                    
                    @auth
                        <a href="{{ route('dashboard') }}" class="px-6 py-2.5 rounded-full bg-[#2B2621] text-[#FAF8F5] text-xs font-bold uppercase tracking-wider hover:bg-[#433B34] transition-all shadow-md hover:shadow-lg hover:-translate-y-0.5">
                            Open Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-2.5 rounded-full bg-[#2B2621] text-[#FAF8F5] text-xs font-bold uppercase tracking-wider hover:bg-[#433B34] transition-all shadow-md hover:shadow-lg hover:-translate-y-0.5">
                            Sign In
                        </a>
                    @endauth
                </div>
            </div>
        </header>

        <!-- 2. HERO MAIN AREA -->
        <main class="relative z-20 w-full max-w-7xl mx-auto px-6 sm:px-8 py-10 lg:py-14 grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center flex-1">
            
            <!-- LEFT: EDITORIAL HEADLINE -->
            <div class="lg:col-span-6 space-y-6">
                
                <h1 class="font-editorial text-5xl sm:text-6xl md:text-7xl lg:text-[5.1rem] leading-[0.95] tracking-tight text-[#2B2621] font-normal uppercase">
                    THE<br>
                    SMARTER<br>
                    COACHING HUB<span class="text-2xl align-top ml-1 font-sans">®</span>
                </h1>

                <p class="text-sm sm:text-base font-medium text-[#5A5147] tracking-wide max-w-lg leading-relaxed">
                    / Live WebSocket Attendance · Google Gemini AI Student Insights · Automated Parent WhatsApp Alerts · Multi-Branch Tenant Scoping /
                </p>

                <!-- Action CTA & Demo Anchor -->
                <div class="pt-2 flex items-center gap-4">
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-3.5 rounded-full bg-[#2B2621] text-[#FAF8F5] text-xs font-bold uppercase tracking-widest hover:bg-[#433B34] hover:shadow-xl hover:scale-105 transition-all duration-200">
                        START NOW
                    </a>
                    
                    <a href="#attendance" class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#2B2621] hover:text-[#5A5147] transition-colors">
                        <span class="w-7 h-7 rounded-full border border-[#2B2621]/30 flex items-center justify-center">
                            <svg class="w-3 h-3 translate-x-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </span>
                        <span>See How It Works</span>
                    </a>
                </div>
            </div>

            <!-- RIGHT: LIVE INTERACTIVE PREVIEW CARD -->
            <div class="lg:col-span-6 relative">
                
                <!-- Main Curved Glass Card -->
                <div class="glass-warm rounded-[2.5rem] p-6 sm:p-8 shadow-2xl relative overflow-hidden border border-white/80 transition-all">
                    
                    <!-- Feature Pill Chips -->
                    <div class="flex flex-wrap items-center gap-2 mb-6">
                        <span class="px-3.5 py-1 rounded-full bg-[#FAF8F5] text-[10px] font-bold uppercase tracking-widest text-[#4A423B] border border-black/5 shadow-sm">
                            ⚡ Reverb Live
                        </span>
                        <span class="px-3.5 py-1 rounded-full bg-[#FAF8F5] text-[10px] font-bold uppercase tracking-widest text-[#4A423B] border border-black/5 shadow-sm">
                            🤖 Gemini 2.5
                        </span>
                        <span class="px-3.5 py-1 rounded-full bg-[#2B2621] text-[10px] font-bold uppercase tracking-widest text-[#FAF8F5] shadow-sm">
                            🏢 Multi-Branch
                        </span>
                    </div>

                    <!-- Card Header -->
                    <div class="space-y-1 mb-5">
                        <h2 class="font-editorial text-2xl sm:text-3xl font-bold text-[#2B2621]">
                            Real-time sync & intelligent metrics
                        </h2>
                        <p class="text-xs text-[#6B6157] font-medium">
                            From 1-tap classroom attendance to automated WhatsApp parent alerts.
                        </p>
                    </div>

                    <!-- Embedded Dark UI Preview (Live Attendance + AI Radar) -->
                    <div class="relative rounded-2xl bg-[#25201B] p-5 text-[#FAF8F5] shadow-xl overflow-hidden border border-[#473E35]">
                        
                        <!-- Header inside preview -->
                        <div class="flex items-center justify-between border-b border-white/10 pb-3 mb-4">
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-ping"></span>
                                <span class="text-xs font-bold tracking-wide uppercase">Dhaka Main Branch · Science Batch 2026</span>
                            </div>
                            <span class="text-[9px] font-semibold text-emerald-400 bg-emerald-950/90 border border-emerald-500/30 px-2 py-0.5 rounded-full uppercase">
                                WebSocket Connected
                            </span>
                        </div>

                        <!-- Real Seeded Student Attendance Status -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5 mb-4">
                            <div class="p-2.5 rounded-xl bg-white/5 border border-white/10 flex items-center justify-between">
                                <div>
                                    <p class="text-[11px] font-bold">Aarif Hasan</p>
                                    <p class="text-[9px] text-emerald-300">Present (09:00 AM)</p>
                                </div>
                                <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                            </div>
                            <div class="p-2.5 rounded-xl bg-white/5 border border-white/10 flex items-center justify-between">
                                <div>
                                    <p class="text-[11px] font-bold">Nusrat Jahan</p>
                                    <p class="text-[9px] text-emerald-300">Present (09:02 AM)</p>
                                </div>
                                <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                            </div>
                            <div class="p-2.5 rounded-xl bg-red-950/50 border border-red-500/40 flex items-center justify-between">
                                <div>
                                    <p class="text-[11px] font-bold text-red-200">Fahim Ahmed</p>
                                    <p class="text-[9px] text-red-400">Absent · SMS Alert</p>
                                </div>
                                <span class="w-2 h-2 rounded-full bg-red-400"></span>
                            </div>
                        </div>

                        <!-- Grounded Gemini AI Remark Pill -->
                        <div class="p-3 rounded-xl bg-[#8A6E59]/30 border border-[#8A6E59]/50 flex items-start gap-2.5">
                            <div class="w-5 h-5 rounded-md bg-[#FAF8F5] text-[#2B2621] flex-shrink-0 flex items-center justify-center text-[10px] font-black">
                                AI
                            </div>
                            <div class="text-[11px] leading-relaxed">
                                <span class="font-bold text-amber-200">Gemini Risk Alert:</span>
                                <span class="text-white/90"> Fahim Ahmed has missed 2 classes & has pending tuition fees. WhatsApp check-in drafted for guardian.</span>
                            </div>
                        </div>
                    </div>

                    <!-- Floating Interactive Overlay Badge (Like reference 'ROOMTOUR' overlay) -->
                    <a href="{{ route('login') }}" class="absolute top-6 right-6 sm:top-8 sm:right-8 bg-[#FAF8F5]/95 backdrop-blur-md rounded-2xl p-2.5 shadow-xl border border-black/5 flex items-center gap-3 hover:scale-105 transition-transform cursor-pointer">
                        <div class="w-8 h-8 rounded-full bg-[#8A6E59] text-white flex items-center justify-center shadow-sm">
                            <svg class="w-4 h-4 translate-x-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                        <div class="pr-2">
                            <span class="block text-[9px] font-extrabold uppercase tracking-widest text-[#73685D]">TRY DEMO</span>
                            <span class="block text-[11px] font-bold text-[#2B2621]">Live System</span>
                        </div>
                    </a>

                </div>
            </div>

        </main>

        <!-- 3. BOTTOM MODULAR CARDS (Matches reference layout directly) -->
        <footer class="relative z-20 w-full max-w-7xl mx-auto px-6 sm:px-8 pb-10">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-end">
                
                <!-- Bottom Left Card: Terracotta Feature Box -->
                <div class="md:col-span-4 terracotta-card rounded-3xl p-6 shadow-xl relative overflow-hidden group hover:-translate-y-1 transition-all">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-[10px] font-bold uppercase tracking-widest opacity-85">AI Analytics Engine</span>
                        <span class="w-6 h-6 rounded-full bg-white/20 flex items-center justify-center text-xs font-bold">✨</span>
                    </div>
                    <h3 class="font-editorial text-2xl font-bold leading-tight mb-2">
                        Predictive student risk radar
                    </h3>
                    <p class="text-xs text-[#FAF8F5]/85 font-normal leading-relaxed mb-4">
                        Analyzes attendance drop trends, quiz marks & payment velocity to help tutors intervene early.
                    </p>
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-[10px] font-bold uppercase tracking-wider text-amber-200 hover:text-white transition-colors">
                        <span>Access AI Insights</span>
                        <span>→</span>
                    </a>
                </div>

                <!-- Bottom Center: Roles & Scope Proof -->
                <div class="md:col-span-4 flex flex-col items-center justify-center text-center text-[#FAF8F5] py-4">
                    <!-- Avatar Stack -->
                    <div class="flex items-center -space-x-2 mb-2">
                        <div class="w-9 h-9 rounded-full border-2 border-[#FAF8F5] bg-[#8A6E59] flex items-center justify-center text-[10px] font-bold" title="Super Admin">SA</div>
                        <div class="w-9 h-9 rounded-full border-2 border-[#FAF8F5] bg-[#473E35] flex items-center justify-center text-[10px] font-bold" title="Branch Admin">BA</div>
                        <div class="w-9 h-9 rounded-full border-2 border-[#FAF8F5] bg-[#2B2621] flex items-center justify-center text-[10px] font-bold" title="Teacher">TC</div>
                        <div class="w-9 h-9 rounded-full border-2 border-[#FAF8F5] bg-emerald-700 flex items-center justify-center text-[10px] font-bold" title="Parent/Student">ST</div>
                    </div>
                    <!-- Large Italics Serif Number -->
                    <div class="font-editorial italic text-3xl sm:text-4xl font-bold tracking-tight text-[#FAF8F5]">
                        5 Core Roles
                    </div>
                    <p class="text-xs uppercase tracking-widest text-[#FAF8F5]/80 font-medium">
                        Super Admin · Branch Managers · Tutors · Students · Parents
                    </p>
                </div>

                <!-- Bottom Right: Direct Mission Statement -->
                <div class="md:col-span-4 text-left md:text-right text-[#FAF8F5] space-y-2 py-4">
                    <h3 class="font-editorial text-xl sm:text-2xl uppercase font-bold tracking-wide leading-tight">
                        REAL-TIME ATTENDANCE. ZERO SPREADSHEETS. INSTANT PARENT TRUST.
                    </h3>
                    <div>
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-widest text-amber-300 hover:text-white transition-colors">
                            <span>SIGN IN TO DASHBOARD</span>
                            <span>→</span>
                        </a>
                    </div>
                </div>

            </div>
        </footer>

    </div>

    <!-- 4. CORE MODULES SECTION (Strictly relevant to Tutorly's features) -->
    <section id="attendance" class="py-24 bg-[#FAF8F5] border-t border-[#D9D2C9]">
        <div class="max-w-7xl mx-auto px-6 sm:px-8">
            
            <div class="text-center max-w-2xl mx-auto mb-16 space-y-3">
                <span class="text-xs font-bold uppercase tracking-widest text-[#8A6E59]">Core Architecture</span>
                <h2 class="font-editorial text-4xl sm:text-5xl font-bold text-[#2B2621]">
                    Built for Modern Coaching Centers
                </h2>
                <p class="text-sm text-[#6B6157]">
                    A specialized platform solving the exact daily challenges of multi-branch coaching academies.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <!-- 1. Live Attendance -->
                <div class="bg-white p-7 rounded-3xl border border-[#E5DFD7] shadow-sm hover:shadow-xl transition-all space-y-3">
                    <div class="w-10 h-10 rounded-2xl bg-[#EAE5DF] flex items-center justify-center text-lg text-[#2B2621]">
                        📋
                    </div>
                    <h3 class="font-editorial text-xl font-bold text-[#2B2621]">Live Attendance Board</h3>
                    <p class="text-xs text-[#6B6157] leading-relaxed">
                        1-tap attendance on mobile or tablet. Laravel Reverb WebSockets broadcast changes immediately to branch admins without page reloads.
                    </p>
                    <div class="text-[11px] font-bold text-[#8A6E59] uppercase tracking-wider">Zero-Delay Sync →</div>
                </div>

                <!-- 2. Gemini AI Insights -->
                <div id="ai-insights" class="bg-white p-7 rounded-3xl border border-[#E5DFD7] shadow-sm hover:shadow-xl transition-all space-y-3">
                    <div class="w-10 h-10 rounded-2xl bg-[#8A6E59]/20 flex items-center justify-center text-lg text-[#8A6E59]">
                        🤖
                    </div>
                    <h3 class="font-editorial text-xl font-bold text-[#2B2621]">AI Risk Radar & Remarks</h3>
                    <p class="text-xs text-[#6B6157] leading-relaxed">
                        Google Gemini analyzes attendance drops and quiz grades to flag at-risk learners and auto-draft report card remarks for teachers.
                    </p>
                    <div class="text-[11px] font-bold text-[#8A6E59] uppercase tracking-wider">Gemini 2.5 →</div>
                </div>

                <!-- 3. WhatsApp Alerts & Parent Q&A -->
                <div id="parent-whatsapp" class="bg-white p-7 rounded-3xl border border-[#E5DFD7] shadow-sm hover:shadow-xl transition-all space-y-3">
                    <div class="w-10 h-10 rounded-2xl bg-[#473E35]/15 flex items-center justify-center text-lg text-[#473E35]">
                        💬
                    </div>
                    <h3 class="font-editorial text-xl font-bold text-[#2B2621]">WhatsApp & Parent Q&A</h3>
                    <p class="text-xs text-[#6B6157] leading-relaxed">
                        Automated WhatsApp messages sent on absence or fee dues. Includes an AI-powered natural language Q&A assistant for parents.
                    </p>
                    <div class="text-[11px] font-bold text-[#8A6E59] uppercase tracking-wider">Automated Alerts →</div>
                </div>

                <!-- 4. Multi-Branch & Fees -->
                <div class="bg-white p-7 rounded-3xl border border-[#E5DFD7] shadow-sm hover:shadow-xl transition-all space-y-3">
                    <div class="w-10 h-10 rounded-2xl bg-[#8A6E59]/15 flex items-center justify-center text-lg text-[#8A6E59]">
                        🏢
                    </div>
                    <h3 class="font-editorial text-xl font-bold text-[#2B2621]">Multi-Branch & Payments</h3>
                    <p class="text-xs text-[#6B6157] leading-relaxed">
                        Strict tenant isolation across branches, SSLCommerz sandbox payments, and instant downloadable PDF tuition receipts.
                    </p>
                    <div class="text-[11px] font-bold text-[#8A6E59] uppercase tracking-wider">Tenant Scoping →</div>
                </div>

            </div>
        </div>
    </section>

    <!-- 5. ACTOR & ROLE BREAKDOWN (Direct answer to who uses the platform) -->
    <section id="roles" class="py-20 bg-[#EAE5DF] border-t border-[#D9D2C9]">
        <div class="max-w-7xl mx-auto px-6 sm:px-8">
            
            <div class="text-center max-w-2xl mx-auto mb-14 space-y-2">
                <span class="text-xs font-bold uppercase tracking-widest text-[#8A6E59]">Role-Based Access</span>
                <h2 class="font-editorial text-3xl sm:text-4xl font-bold text-[#2B2621]">
                    Tailored for Every Stakeholder
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                
                <!-- Super Admin -->
                <div class="p-6 rounded-2xl bg-white/70 border border-black/5 shadow-sm space-y-2">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-[#8A6E59]">Central Leadership</span>
                    <h4 class="font-bold text-base text-[#2B2621]">Super Admin</h4>
                    <p class="text-xs text-[#6B6157] leading-relaxed">Full cross-branch analytics, revenue reports, manager appointments, and system-wide configurations.</p>
                </div>

                <!-- Branch Admin -->
                <div class="p-6 rounded-2xl bg-white/70 border border-black/5 shadow-sm space-y-2">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-[#8A6E59]">Branch Manager</span>
                    <h4 class="font-bold text-base text-[#2B2621]">Branch Admin</h4>
                    <p class="text-xs text-[#6B6157] leading-relaxed">Manages batches, student enrollments, fee collections, exam results, and local branch attendance.</p>
                </div>

                <!-- Teacher -->
                <div class="p-6 rounded-2xl bg-white/70 border border-black/5 shadow-sm space-y-2">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-[#8A6E59]">Instructors</span>
                    <h4 class="font-bold text-base text-[#2B2621]">Teacher / Tutor</h4>
                    <p class="text-xs text-[#6B6157] leading-relaxed">Fast 1-tap live attendance board, view at-risk student flags, and generate AI draft report card remarks.</p>
                </div>

                <!-- Parent & Student -->
                <div class="p-6 rounded-2xl bg-white/70 border border-black/5 shadow-sm space-y-2">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-[#8A6E59]">Family Portal</span>
                    <h4 class="font-bold text-base text-[#2B2621]">Parent & Student</h4>
                    <p class="text-xs text-[#6B6157] leading-relaxed">Automated WhatsApp attendance notices, online fee payments with PDF receipts, and AI query assistant.</p>
                </div>

            </div>
        </div>
    </section>

    <!-- 6. DEMO CREDENTIALS CALLOUT & CTA FOOTER -->
    <section class="py-16 bg-[#2B2621] text-[#FAF8F5]">
        <div class="max-w-7xl mx-auto px-6 sm:px-8">
            
            <div class="bg-[#3D352D] rounded-3xl p-8 sm:p-10 border border-[#5A4F43] flex flex-col lg:flex-row items-center justify-between gap-8">
                
                <div class="space-y-3 text-center lg:text-left">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-amber-300">Quick Evaluation</span>
                    <h3 class="font-editorial text-3xl sm:text-4xl font-bold">
                        Try Tutorly with Seeded Demo Accounts
                    </h3>
                    <div class="flex flex-wrap gap-4 text-xs text-slate-300 pt-1 justify-center lg:justify-start">
                        <div class="bg-black/30 px-3.5 py-1.5 rounded-lg border border-white/10">
                            <span class="font-bold text-white">Super Admin:</span> superadmin@coachsync.app / password
                        </div>
                        <div class="bg-black/30 px-3.5 py-1.5 rounded-lg border border-white/10">
                            <span class="font-bold text-white">Branch Admin:</span> admin.dhaka@coachsync.app / password
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4 flex-shrink-0">
                    <a href="{{ route('login') }}" class="px-8 py-3.5 rounded-full bg-[#FAF8F5] text-[#2B2621] text-xs font-bold uppercase tracking-widest hover:bg-amber-100 transition-all shadow-lg hover:scale-105">
                        Launch System
                    </a>
                </div>

            </div>

            <div class="mt-8 text-center text-xs text-[#FAF8F5]/60 font-medium">
                © {{ date('Y') }} Tutorly Multi-Branch Platform · Built with Laravel 11, Livewire 3, Reverb WebSockets & Google Gemini AI.
            </div>

        </div>
    </section>

    @livewireScripts
</body>
</html>
