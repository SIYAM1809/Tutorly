<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth" x-data="{ techModal: false }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tutorly Academy® — Premier Coaching & Smart Learning Hub</title>

    <!-- Google Fonts: Playfair Display for editorial luxury & Inter for crisp UI -->
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
        .editorial-grade {
            filter: contrast(1.06) brightness(0.96) saturate(0.85);
        }
        .terracotta-card {
            background: #8A6E59;
            color: #FAF8F5;
        }
    </style>
</head>
<body class="font-ui antialiased text-[#2B2621] selection:bg-[#2B2621] selection:text-[#FAF8F5] bg-[#EAE5DF] min-h-screen">

    <!-- 1. HERO SECTION WRAPPER -->
    <div class="relative overflow-hidden hero-bg-gradient min-h-screen flex flex-col justify-between">

        <!-- ATMOSPHERIC MOUNTAIN & TERRAIN SILHOUETTE (SVG Layer from reference design) -->
        <div class="absolute inset-0 pointer-events-none opacity-40 mix-blend-multiply">
            <svg class="absolute bottom-0 left-0 w-full h-[600px] object-cover" viewBox="0 0 1440 600" fill="none" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 380L140 310L290 350L450 260L620 330L780 240L960 320L1120 230L1290 300L1440 260V600H0V380Z" fill="#8F8274" fill-opacity="0.3"/>
                <path d="M0 430L180 340L360 390L540 310L720 370L900 300L1080 360L1260 320L1440 370V600H0V430Z" fill="#6B5F52" fill-opacity="0.45"/>
                <path d="M0 480C240 450 480 470 720 460C960 450 1200 480 1440 470V600H0V480Z" fill="#3D342C" fill-opacity="0.85"/>
            </svg>
        </div>

        <!-- NAVIGATION BAR -->
        <header class="relative z-30 w-full max-w-7xl mx-auto px-6 sm:px-8 pt-6">
            <div class="flex items-center justify-between">
                <!-- Academy Brand Logo -->
                <a href="/" class="flex items-center gap-2.5 group">
                    <div class="w-8 h-8 rounded-full bg-[#2B2621] text-[#FAF8F5] flex items-center justify-center font-bold text-xs shadow-md transition-transform group-hover:scale-105">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                        </svg>
                    </div>
                    <div>
                        <span class="font-editorial tracking-wider text-xl font-black uppercase text-[#2B2621] block leading-none">TUTORLY</span>
                        <span class="text-[8px] font-bold tracking-widest text-[#73685D] uppercase">Coaching Academy</span>
                    </div>
                </a>

                <!-- Clean Navigation Links -->
                <nav class="hidden md:flex items-center gap-8 text-xs font-semibold tracking-wider text-[#4A423B] uppercase">
                    <a href="#programs" class="hover:text-[#2B2621] transition-colors">Programs</a>
                    <a href="#why-us" class="hover:text-[#2B2621] transition-colors">Why Tutorly</a>
                    <a href="#branches" class="hover:text-[#2B2621] transition-colors">Campuses</a>
                    <!-- Recruiter Tech Showcase Trigger -->
                    <button @click="techModal = true" class="inline-flex items-center gap-1 text-[#8A6E59] hover:text-[#2B2621] font-bold transition-colors">
                        <span>⚡ Tech Stack & Architecture</span>
                    </button>
                </nav>

                <!-- Language & Portal Login -->
                <div class="flex items-center gap-4">
                    <span class="text-xs font-semibold text-[#5A524A] tracking-wider uppercase hidden sm:inline-block">ENG / বাংলা</span>
                    
                    @auth
                        <a href="{{ route('dashboard') }}" class="px-6 py-2.5 rounded-full bg-[#2B2621] text-[#FAF8F5] text-xs font-bold uppercase tracking-wider hover:bg-[#433B34] transition-all shadow-md hover:shadow-lg hover:-translate-y-0.5">
                            Portal Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-2.5 rounded-full bg-[#2B2621] text-[#FAF8F5] text-xs font-bold uppercase tracking-wider hover:bg-[#433B34] transition-all shadow-md hover:shadow-lg hover:-translate-y-0.5">
                            Portal Login
                        </a>
                    @endauth
                </div>
            </div>
        </header>

        <!-- HERO CONTENT -->
        <main class="relative z-20 w-full max-w-7xl mx-auto px-6 sm:px-8 py-10 lg:py-14 grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center flex-1">
            
            <!-- LEFT: COACHING HERO HEADLINE -->
            <div class="lg:col-span-6 space-y-6">
                
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-white/70 border border-black/5 text-[11px] font-semibold text-[#6E5D4F]">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>Admissions Open for HSC & SSC Batches (2026–2027)</span>
                </div>

                <h1 class="font-editorial text-5xl sm:text-6xl md:text-7xl lg:text-[4.8rem] leading-[0.95] tracking-tight text-[#2B2621] font-normal uppercase">
                    WHERE<br>
                    SCHOLARS<br>
                    EXCEL<span class="text-2xl align-top ml-1 font-sans">®</span>
                </h1>

                <p class="text-sm sm:text-base font-medium text-[#5A5147] tracking-wide max-w-lg leading-relaxed">
                    / Premier academic coaching for HSC, SSC & University Admissions. Combining top university mentors, instant parent WhatsApp updates, and personalized AI progress tracking /
                </p>

                <!-- Actions -->
                <div class="pt-2 flex flex-wrap items-center gap-4">
                    <a href="#programs" class="inline-flex items-center justify-center px-8 py-3.5 rounded-full bg-[#2B2621] text-[#FAF8F5] text-xs font-bold uppercase tracking-widest hover:bg-[#433B34] hover:shadow-xl hover:scale-105 transition-all duration-200">
                        EXPLORE PROGRAMS
                    </a>
                    
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#2B2621] hover:text-[#5A5147] transition-colors">
                        <span class="w-7 h-7 rounded-full border border-[#2B2621]/30 flex items-center justify-center">
                            <svg class="w-3 h-3 translate-x-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </span>
                        <span>Student & Parent Portal</span>
                    </a>
                </div>
            </div>

            <!-- RIGHT: INTERACTIVE 3D PHOTO DECK SLIDER (ALPINE.JS) -->
            <div 
                class="lg:col-span-6 relative w-full h-[430px] sm:h-[480px] flex items-center justify-center lg:justify-end"
                x-data="{
                    active: 0,
                    autoplay: null,
                    slides: [
                        {
                            title: 'Faculty Masterclasses',
                            desc: 'Interactive lectures & board problem-solving sessions',
                            badge: 'HSC & SSC Prep',
                            img: '{{ asset('images/workshop.jpg') }}'
                        },
                        {
                            title: 'Active Learning Labs',
                            desc: 'Small-group discussions & peer study dynamics',
                            badge: 'Collaborative Study',
                            img: '{{ asset('images/discussion.jpg') }}'
                        },
                        {
                            title: '1-on-1 Faculty Mentorship',
                            desc: 'Individual diagnostic care and targeted guidance',
                            badge: 'Personalized Care',
                            img: '{{ asset('images/mentorship.webp') }}'
                        },
                        {
                            title: 'Board Exam Mock Halls',
                            desc: 'Weekly timed model tests with nationwide ranking',
                            badge: 'Exam Excellence',
                            img: '{{ asset('images/classroom.webp') }}'
                        }
                    ],
                    next() {
                        this.active = (this.active + 1) % this.slides.length;
                    },
                    prev() {
                        this.active = (this.active - 1 + this.slides.length) % this.slides.length;
                    },
                    goTo(idx) {
                        this.active = idx;
                    },
                    startTimer() {
                        this.autoplay = setInterval(() => { this.next(); }, 4000);
                    },
                    stopTimer() {
                        clearInterval(this.autoplay);
                    }
                }"
                x-init="startTimer()"
                @mouseenter="stopTimer()"
                @mouseleave="startTimer()"
            >
                
                <!-- Floating Campus Stat Badge (Top-Left) -->
                <div class="absolute -top-2 left-2 sm:left-6 bg-[#FAF8F5]/90 backdrop-blur-md rounded-full px-4 py-1.5 shadow-lg border border-white/80 z-40 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="text-[11px] font-bold text-[#2B2621]">Dhaka Main & Chittagong Campuses</span>
                </div>

                <!-- 3D Card Stack Container -->
                <div class="relative w-[90%] sm:w-[84%] h-[350px] sm:h-[400px]">
                    
                    <template x-for="(slide, index) in slides" :key="index">
                        <div 
                            @click="goTo(index)"
                            class="absolute inset-0 rounded-2xl overflow-hidden shadow-2xl transition-all duration-500 ease-out cursor-pointer bg-[#1E1B18] border-2 border-white/70 select-none"
                            :class="{
                                'z-30 translate-x-0 translate-y-0 rotate-0 opacity-100 scale-100 shadow-2xl shadow-[#2B2621]/30': active === index,
                                'z-20 translate-x-4 -translate-y-3 rotate-2 opacity-80 scale-[0.96] shadow-xl shadow-[#2B2621]/20': active === (index - 1 + slides.length) % slides.length,
                                'z-10 translate-x-8 -translate-y-6 rotate-4 opacity-50 scale-[0.92] shadow-md': active === (index - 2 + slides.length) % slides.length,
                                'z-0 translate-x-12 -translate-y-9 rotate-6 opacity-0 scale-[0.88] pointer-events-none': active !== index && active !== (index - 1 + slides.length) % slides.length && active !== (index - 2 + slides.length) % slides.length
                            }"
                        >
                            <!-- Photo with unified editorial film grade -->
                            <img 
                                :src="slide.img" 
                                :alt="slide.title"
                                class="w-full h-full object-cover object-center editorial-grade transition-transform duration-700 hover:scale-105"
                            />
                            
                            <!-- Gradient Scrim -->
                            <div class="absolute inset-0 bg-gradient-to-t from-[#2B2621]/90 via-[#2B2621]/20 to-transparent"></div>

                            <!-- Live Campus Overlay Pill (Only visible on active card) -->
                            <div x-show="active === index" class="absolute top-4 right-4 z-30">
                                <button 
                                    @click.stop="techModal = true" 
                                    class="bg-[#FAF8F5]/95 backdrop-blur-md rounded-2xl px-3 py-1.5 shadow-xl border border-white/60 flex items-center gap-2 hover:scale-105 transition-transform text-left"
                                >
                                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
                                    <div>
                                        <span class="block text-[8px] font-extrabold uppercase tracking-widest text-[#73685D]">IN SESSION</span>
                                        <span class="block text-[10px] font-bold text-[#2B2621]" x-text="slide.badge"></span>
                                    </div>
                                </button>
                            </div>

                            <!-- Bottom Dynamic Content Overlay -->
                            <div class="absolute bottom-4 left-4 right-4 text-[#FAF8F5] z-20" x-show="active === index" x-transition.opacity.duration.300ms>
                                <span class="text-[9px] font-bold uppercase tracking-widest text-amber-300 block mb-0.5" x-text="slide.badge"></span>
                                <h4 class="font-editorial text-lg sm:text-xl font-bold leading-tight" x-text="slide.title"></h4>
                                <p class="text-xs text-[#FAF8F5]/80 mt-1 font-normal line-clamp-1" x-text="slide.desc"></p>
                            </div>
                        </div>
                    </template>

                </div>

                <!-- Interactive Navigation & Progress Pill Bar (Bottom Overlay) -->
                <div class="absolute -bottom-4 right-4 sm:right-8 bg-[#FAF8F5]/95 backdrop-blur-md rounded-full px-3.5 py-2 shadow-xl border border-white/80 z-40 flex items-center gap-3">
                    
                    <!-- Prev Button -->
                    <button 
                        @click="prev()" 
                        class="w-7 h-7 rounded-full bg-[#2B2621] text-[#FAF8F5] flex items-center justify-center hover:bg-[#433B34] transition-all text-xs font-bold shadow-sm"
                        title="Previous photo"
                    >
                        ←
                    </button>

                    <!-- Indicators / Number -->
                    <div class="flex items-center gap-1 text-[11px] font-bold text-[#2B2621]">
                        <span x-text="'0' + (active + 1)"></span>
                        <span class="text-slate-400">/</span>
                        <span class="text-slate-500">04</span>
                    </div>

                    <!-- Next Button -->
                    <button 
                        @click="next()" 
                        class="w-7 h-7 rounded-full bg-[#2B2621] text-[#FAF8F5] flex items-center justify-center hover:bg-[#433B34] transition-all text-xs font-bold shadow-sm"
                        title="Next photo"
                    >
                        →
                    </button>
                </div>

            </div>

        </main>

        <!-- 3. BOTTOM 3 HIGHLIGHT CARDS (Matching user reference layout) -->
        <footer class="relative z-20 w-full max-w-7xl mx-auto px-6 sm:px-8 pb-10">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-end">
                
                <!-- Bottom Left: Terracotta Feature Card -->
                <div class="md:col-span-4 terracotta-card rounded-3xl p-6 shadow-xl relative overflow-hidden group hover:-translate-y-1 transition-all">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-[10px] font-bold uppercase tracking-widest opacity-85">Student Diagnostics</span>
                        <span class="w-6 h-6 rounded-full bg-white/20 flex items-center justify-center text-xs font-bold">🎯</span>
                    </div>
                    <h3 class="font-editorial text-2xl font-bold leading-tight mb-2">
                        Early weakness detection
                    </h3>
                    <p class="text-xs text-[#FAF8F5]/85 font-normal leading-relaxed mb-4">
                        We detect learning gaps before board exams. Mentors receive automated insights to provide targeted 1-on-1 help.
                    </p>
                    <a href="#why-us" class="inline-flex items-center gap-2 text-[10px] font-bold uppercase tracking-wider text-amber-200 hover:text-white transition-colors">
                        <span>Learn Our Methodology</span>
                        <span>→</span>
                    </a>
                </div>

                <!-- Bottom Center: Results & Trust Counter -->
                <div class="md:col-span-4 flex flex-col items-center justify-center text-center text-[#FAF8F5] py-4">
                    <!-- Avatar Stack -->
                    <div class="flex items-center -space-x-2 mb-2">
                        <div class="w-9 h-9 rounded-full border-2 border-[#FAF8F5] bg-[#8A6E59] flex items-center justify-center text-[10px] font-bold" title="Faculty">BUET</div>
                        <div class="w-9 h-9 rounded-full border-2 border-[#FAF8F5] bg-[#473E35] flex items-center justify-center text-[10px] font-bold" title="Faculty">DMC</div>
                        <div class="w-9 h-9 rounded-full border-2 border-[#FAF8F5] bg-[#2B2621] flex items-center justify-center text-[10px] font-bold" title="Faculty">DU</div>
                        <div class="w-9 h-9 rounded-full border-2 border-[#FAF8F5] bg-emerald-700 flex items-center justify-center text-[10px] font-bold">+50</div>
                    </div>
                    <!-- Large Italics Serif Number -->
                    <div class="font-editorial italic text-3xl sm:text-4xl font-bold tracking-tight text-[#FAF8F5]">
                        98.6%
                    </div>
                    <p class="text-xs uppercase tracking-widest text-[#FAF8F5]/80 font-medium">
                        Board GPA 5.00 & University Placement Rate
                    </p>
                </div>

                <!-- Bottom Right: Academy Promise -->
                <div class="md:col-span-4 text-left md:text-right text-[#FAF8F5] space-y-2 py-4">
                    <h3 class="font-editorial text-xl sm:text-2xl uppercase font-bold tracking-wide leading-tight">
                        TRANSPARENT COACHING. ZERO UNCHECKED WEAKNESSES.
                    </h3>
                    <div>
                        <a href="#programs" class="inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-widest text-amber-300 hover:text-white transition-colors">
                            <span>VIEW ENROLLMENT BATCHES</span>
                            <span>→</span>
                        </a>
                    </div>
                </div>

            </div>
        </footer>

    </div>

    <!-- 2. WHY PARENTS & STUDENTS CHOOSE US -->
    <section id="why-us" class="py-20 bg-[#FAF8F5] border-t border-[#D9D2C9]">
        <div class="max-w-7xl mx-auto px-6 sm:px-8">
            
            <div class="text-center max-w-2xl mx-auto mb-14 space-y-3">
                <span class="text-xs font-bold uppercase tracking-widest text-[#8A6E59]">The Tutorly Standard</span>
                <h2 class="font-editorial text-4xl sm:text-5xl font-bold text-[#2B2621]">
                    Why Parents Place Their Trust in Us
                </h2>
                <p class="text-sm text-[#6B6157]">
                    Traditional coaching centers leave parents in the dark. We keep you connected and your child focused every single day.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <!-- Pillar 1 -->
                <div class="bg-white p-8 rounded-3xl border border-[#E5DFD7] shadow-sm hover:shadow-xl transition-all space-y-3">
                    <div class="w-12 h-12 rounded-2xl bg-[#EAE5DF] flex items-center justify-center text-xl text-[#2B2621]">
                        📲
                    </div>
                    <h3 class="font-editorial text-2xl font-bold text-[#2B2621]">Instant WhatsApp Presence</h3>
                    <p class="text-xs text-[#6B6157] leading-relaxed">
                        Never worry if your child reached class safely. The moment a student enters the classroom, a verified arrival alert is dispatched to the guardian's WhatsApp.
                    </p>
                </div>

                <!-- Pillar 2 -->
                <div class="bg-white p-8 rounded-3xl border border-[#E5DFD7] shadow-sm hover:shadow-xl transition-all space-y-3">
                    <div class="w-12 h-12 rounded-2xl bg-[#8A6E59]/20 flex items-center justify-center text-xl text-[#8A6E59]">
                        🧠
                    </div>
                    <h3 class="font-editorial text-2xl font-bold text-[#2B2621]">Smart Academic Radar</h3>
                    <p class="text-xs text-[#6B6157] leading-relaxed">
                        Our internal system continuously tracks quiz results and homework submission trends to detect which topics (e.g. Organic Chemistry, Calculus) need extra guidance.
                    </p>
                </div>

                <!-- Pillar 3 -->
                <div class="bg-white p-8 rounded-3xl border border-[#E5DFD7] shadow-sm hover:shadow-xl transition-all space-y-3">
                    <div class="w-12 h-12 rounded-2xl bg-[#473E35]/15 flex items-center justify-center text-xl text-[#473E35]">
                        📜
                    </div>
                    <h3 class="font-editorial text-2xl font-bold text-[#2B2621]">Verified Performance Reports</h3>
                    <p class="text-xs text-[#6B6157] leading-relaxed">
                        Monthly structured model test scorecards, teacher remarks, digital payment receipts, and authenticated course completion certificates.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- 3. ACADEMIC PROGRAMS & CAMPUSES (Tight & Focused) -->
    <section id="programs" class="py-20 bg-[#EAE5DF] border-t border-[#D9D2C9]">
        <div class="max-w-7xl mx-auto px-6 sm:px-8">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-[#8A6E59]">Academic Excellence</span>
                    <h2 class="font-editorial text-4xl sm:text-5xl font-bold text-[#2B2621] mt-1">
                        Coaching Programs & Batches
                    </h2>
                </div>
                <p class="text-xs text-[#6B6157] max-w-md">
                    Structured lecture plans, weekly model tests, and lecture sheets curated by premier faculty.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-16">
                
                <!-- Program 1 -->
                <div class="bg-[#FAF8F5] p-7 rounded-3xl border border-black/5 shadow-sm flex flex-col justify-between space-y-4">
                    <div>
                        <span class="px-3 py-1 rounded-full bg-[#8A6E59]/15 text-[#8A6E59] text-[10px] font-bold uppercase tracking-wider">Higher Secondary</span>
                        <h3 class="font-editorial text-2xl font-bold text-[#2B2621] mt-2 mb-1">HSC Science Special</h3>
                        <p class="text-xs text-[#6B6157] leading-relaxed">
                            Comprehensive prep for Physics, Chemistry, Higher Mathematics, and Biology with weekly board-standard creative exams.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-[#E5DFD7] flex items-center justify-between text-xs font-semibold">
                        <span class="text-[#2B2621]">Dhaka & Chittagong</span>
                        <a href="{{ route('login') }}" class="text-[#8A6E59] hover:text-[#2B2621]">Enroll in Batch →</a>
                    </div>
                </div>

                <!-- Program 2 -->
                <div class="bg-[#FAF8F5] p-7 rounded-3xl border border-black/5 shadow-sm flex flex-col justify-between space-y-4">
                    <div>
                        <span class="px-3 py-1 rounded-full bg-[#8A6E59]/15 text-[#8A6E59] text-[10px] font-bold uppercase tracking-wider">Secondary Board</span>
                        <h3 class="font-editorial text-2xl font-bold text-[#2B2621] mt-2 mb-1">SSC Board Excellence</h3>
                        <p class="text-xs text-[#6B6157] leading-relaxed">
                            Targeted GPA 5.00 foundation program for Class 9 & 10 students covering General Math, Higher Math, Physics & Chemistry.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-[#E5DFD7] flex items-center justify-between text-xs font-semibold">
                        <span class="text-[#2B2621]">All Campuses</span>
                        <a href="{{ route('login') }}" class="text-[#8A6E59] hover:text-[#2B2621]">Enroll in Batch →</a>
                    </div>
                </div>

                <!-- Program 3 -->
                <div class="bg-[#FAF8F5] p-7 rounded-3xl border border-black/5 shadow-sm flex flex-col justify-between space-y-4">
                    <div>
                        <span class="px-3 py-1 rounded-full bg-[#2B2621] text-[#FAF8F5] text-[10px] font-bold uppercase tracking-wider">Competitive Prep</span>
                        <h3 class="font-editorial text-2xl font-bold text-[#2B2621] mt-2 mb-1">Admission Engineering & Medical</h3>
                        <p class="text-xs text-[#6B6157] leading-relaxed">
                            High-intensity problem-solving masterclasses, past 20-year question bank analysis, and nationwide ranking mock tests.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-[#E5DFD7] flex items-center justify-between text-xs font-semibold">
                        <span class="text-[#2B2621]">Main Campus Special</span>
                        <a href="{{ route('login') }}" class="text-[#8A6E59] hover:text-[#2B2621]">Enroll in Batch →</a>
                    </div>
                </div>

            </div>

            <!-- Campuses Bar -->
            <div id="branches" class="bg-white/80 backdrop-blur-md rounded-3xl p-6 sm:p-8 border border-black/5 flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-[#2B2621] text-white flex items-center justify-center text-xl">
                        🏢
                    </div>
                    <div>
                        <h4 class="font-bold text-base text-[#2B2621]">Our Multi-Branch Network</h4>
                        <p class="text-xs text-[#6B6157]">Dhaka Central Campus (Dhanmondi/Farmgate) · Uttara Branch · Chittagong Campus</p>
                    </div>
                </div>
                <a href="{{ route('login') }}" class="px-6 py-2.5 rounded-full bg-[#2B2621] text-white text-xs font-bold uppercase tracking-wider hover:bg-[#433B34] transition-all flex-shrink-0">
                    Access Branch Portal
                </a>
            </div>

        </div>
    </section>

    <!-- 4. FOOTER & RECRUITER CALLOUT BAR -->
    <footer class="py-16 bg-[#2B2621] text-[#FAF8F5]">
        <div class="max-w-7xl mx-auto px-6 sm:px-8">
            
            <div class="flex flex-col md:flex-row items-center justify-between gap-8 pb-12 border-b border-white/10 text-center md:text-left">
                <div>
                    <h3 class="font-editorial text-3xl sm:text-4xl font-bold mb-2">
                        Tutorly Coaching Academy
                    </h3>
                    <p class="text-xs text-[#FAF8F5]/70 max-w-lg">
                        Empowering students across Bangladesh with structured learning, elite faculty, and transparent guardian communication.
                    </p>
                </div>
                <div class="flex flex-wrap items-center gap-3 justify-center">
                    <button @click="techModal = true" class="px-6 py-3 rounded-full bg-white/10 hover:bg-white/20 border border-white/20 text-[#FAF8F5] text-xs font-bold uppercase tracking-widest transition-all">
                        🛠️ Architecture & Recruiter Showcase
                    </button>
                    <a href="{{ route('login') }}" class="px-7 py-3 rounded-full bg-[#FAF8F5] text-[#2B2621] text-xs font-bold uppercase tracking-widest hover:bg-amber-100 transition-all shadow-lg">
                        Sign In to Portal
                    </a>
                </div>
            </div>

            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-[#FAF8F5]/60 gap-4">
                <div>© {{ date('Y') }} Tutorly Academy. All rights reserved.</div>
                <div class="flex items-center gap-4">
                    <span class="hover:text-white cursor-pointer" @click="techModal = true">View Engineering Stack</span>
                    <span>•</span>
                    <a href="{{ route('login') }}" class="hover:text-white">Faculty Login</a>
                    <span>•</span>
                    <a href="{{ route('login') }}" class="hover:text-white">Guardian Portal</a>
                </div>
            </div>

        </div>
    </footer>

    <!-- 5. RECRUITER / ARCHITECTURE SHOWCASE MODAL (Direct 1-Click for Evaluators) -->
    <div 
        x-show="techModal" 
        x-cloak 
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-md"
        @keydown.escape.window="techModal = false"
    >
        <div 
            @click.away="techModal = false"
            class="bg-[#1E1B18] text-[#FAF8F5] border border-white/10 rounded-3xl max-w-2xl w-full p-6 sm:p-8 shadow-2xl space-y-6 max-h-[90vh] overflow-y-auto"
        >
            <!-- Modal Header -->
            <div class="flex items-center justify-between border-b border-white/10 pb-4">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-amber-500/20 text-amber-300 border border-amber-500/30 flex items-center justify-center font-bold text-sm">
                        ⚡
                    </div>
                    <div>
                        <h3 class="font-bold text-lg text-white">Tutorly Engineering & Architecture</h3>
                        <p class="text-xs text-slate-400">Full-Stack SaaS Platform Architecture for Evaluators</p>
                    </div>
                </div>
                <button @click="techModal = false" class="text-slate-400 hover:text-white p-1 rounded-lg hover:bg-white/10 text-xl font-bold">
                    ✕
                </button>
            </div>

            <!-- Tech Stack Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-center">
                <div class="bg-white/5 p-3 rounded-2xl border border-white/5">
                    <span class="block text-xs font-bold text-amber-300">Backend</span>
                    <span class="text-xs text-slate-300">Laravel 11 (PHP 8.3)</span>
                </div>
                <div class="bg-white/5 p-3 rounded-2xl border border-white/5">
                    <span class="block text-xs font-bold text-cyan-300">Reactive UI</span>
                    <span class="text-xs text-slate-300">Livewire 3 + Alpine</span>
                </div>
                <div class="bg-white/5 p-3 rounded-2xl border border-white/5">
                    <span class="block text-xs font-bold text-emerald-300">Real-Time</span>
                    <span class="text-xs text-slate-300">Laravel Reverb</span>
                </div>
                <div class="bg-white/5 p-3 rounded-2xl border border-white/5">
                    <span class="block text-xs font-bold text-purple-300">AI Engine</span>
                    <span class="text-xs text-slate-300">Google Gemini 2.5</span>
                </div>
            </div>

            <!-- Key Engineering Highlights -->
            <div class="space-y-2.5 text-xs text-slate-300 bg-white/5 p-4 rounded-2xl border border-white/5">
                <p class="font-bold text-white uppercase tracking-wider text-[11px]">Key Systems Implemented:</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                    <div>✓ <strong>Multi-Branch Tenant Scoping</strong>: Custom Global ORM scopes (`BelongsToBranch`) for automatic tenant data isolation.</div>
                    <div>✓ <strong>Live Attendance Board</strong>: Zero-latency WebSocket broadcasting via Laravel Reverb on 1-tap marks.</div>
                    <div>✓ <strong>Gemini AI Student Radar</strong>: Automated at-risk detection, parent Q&A assistant & report card draft generator.</div>
                    <div>✓ <strong>WhatsApp Notifications & SSLCommerz</strong>: Custom notification channel + sandbox online fee checkout.</div>
                </div>
            </div>

            <!-- Demo Credentials & 1-Click Launch -->
            <div class="bg-[#2B2621] p-4 rounded-2xl border border-[#5A4F43] space-y-3">
                <p class="text-xs font-bold text-amber-300 uppercase tracking-wider">Demo Credentials:</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs">
                    <div class="bg-black/40 p-2 rounded-lg border border-white/10">
                        <span class="text-slate-400 block text-[10px]">SUPER ADMIN:</span>
                        <code class="text-emerald-300 font-mono">superadmin@coachsync.app</code>
                        <span class="text-slate-400 block text-[10px] mt-0.5">Password: password</span>
                    </div>
                    <div class="bg-black/40 p-2 rounded-lg border border-white/10">
                        <span class="text-slate-400 block text-[10px]">BRANCH ADMIN (DHAKA):</span>
                        <code class="text-emerald-300 font-mono">admin.dhaka@coachsync.app</code>
                        <span class="text-slate-400 block text-[10px] mt-0.5">Password: password</span>
                    </div>
                </div>
            </div>

            <!-- Direct Launch Button -->
            <div class="flex items-center justify-end gap-3 pt-2">
                <button @click="techModal = false" class="px-5 py-2.5 text-xs font-semibold text-slate-300 hover:text-white">
                    Close
                </button>
                <a href="{{ route('login') }}" class="px-6 py-2.5 rounded-full bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-400 hover:to-amber-500 text-[#1E1B18] font-bold text-xs uppercase tracking-wider shadow-lg">
                    Launch Application →
                </a>
            </div>
        </div>
    </div>

    @livewireScripts
</body>
</html>
