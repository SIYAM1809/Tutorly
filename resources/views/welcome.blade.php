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
<body class="font-ui antialiased text-[#2B2621] selection:bg-[#2B2621] selection:text-[#FAF8F5] bg-[#EAE5DF] min-h-screen" x-data="{ techModal: false, enrollModal: false, selectedBatchName: 'HSC Science Special', enrollSuccess: false, studentName: '', studentPhone: '', guardianPhone: '', selectedBranch: 'Dhaka Central Campus', lang: 'ENG' }">

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
                    <button @click="lang = lang === 'ENG' ? 'বাংলা' : 'ENG'" class="text-xs font-semibold text-[#5A524A] hover:text-[#2B2621] tracking-wider uppercase hidden sm:inline-block px-2.5 py-1 rounded-full border border-[#D9D2C9] transition-all">
                        <span x-text="lang === 'ENG' ? 'ENG (Switch to বাংলা)' : 'বাংলা (Switch to ENG)'"></span>
                    </button>
                    
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

            <!-- RIGHT: NAKED BENTO GRID WITH 2-SECOND DYNAMIC ROTATION (ALPINE.JS) -->
            <div 
                class="lg:col-span-6 relative w-full h-[390px] sm:h-[440px]"
                x-data="{
                    active: 0,
                    autoplay: null,
                    slides: [
                        {
                            title: 'Faculty Masterclasses',
                            desc: 'Interactive lectures & board problem-solving sessions',
                            badge: 'HSC & SSC Prep',
                            tag: 'Live Lecture',
                            img: '/images/workshop.jpg'
                        },
                        {
                            title: 'Active Learning Labs',
                            desc: 'Small-group discussions & peer study dynamics',
                            badge: 'Collaborative Study',
                            tag: 'Group Labs',
                            img: '/images/discussion.jpg'
                        },
                        {
                            title: '1-on-1 Faculty Mentorship',
                            desc: 'Individual diagnostic care and targeted guidance',
                            badge: 'Personalized Care',
                            tag: '1-on-1 Mentorship',
                            img: '/images/mentorship.webp'
                        },
                        {
                            title: 'Board Exam Mock Halls',
                            desc: 'Weekly timed model tests with nationwide ranking',
                            badge: 'Exam Excellence',
                            tag: 'Model Exams',
                            img: '/images/classroom.webp'
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
                        this.autoplay = setInterval(() => { this.next(); }, 2000);
                    },
                    stopTimer() {
                        clearInterval(this.autoplay);
                    }
                }"
                x-init="startTimer()"
                @mouseenter="stopTimer()"
                @mouseleave="startTimer()"
            >
                
                <!-- Floating Campus Badge (Top-Left) -->
                <div class="absolute -top-3 left-0 bg-[#FAF8F5]/90 backdrop-blur-md rounded-full px-3.5 py-1 shadow-md border border-white/80 z-20 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="text-[10px] font-bold text-[#2B2621]">Dhaka Main & Chittagong Campuses</span>
                </div>

                <!-- Naked Bento Grid (Direct on Beige Canvas, No Nested Cards) -->
                <div class="grid grid-cols-12 gap-3.5 sm:gap-4 h-full w-full pt-4">
                    
                    <!-- Left 7-Cols: Primary Featured Tile (Cycles every 2 sec) -->
                    <div class="col-span-7 relative h-full rounded-2xl overflow-hidden shadow-2xl shadow-[#2B2621]/15 border border-white/70 bg-[#1E1B18] group cursor-pointer" @click="next()">
                        
                        <template x-for="(slide, index) in slides" :key="index">
                            <div 
                                x-show="active === index"
                                x-transition:enter="transition ease-out duration-500"
                                x-transition:enter-start="opacity-0 scale-105"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-300 absolute inset-0"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                class="w-full h-full relative"
                            >
                                <img 
                                    :src="slide.img" 
                                    :alt="slide.title" 
                                    class="w-full h-full object-cover object-center editorial-grade"
                                />
                                <div class="absolute inset-0 bg-gradient-to-t from-[#2B2621]/90 via-[#2B2621]/20 to-transparent"></div>

                                <!-- Floating Live Badge (Top-Right of Primary Tile) -->
                                <button 
                                    @click.stop="techModal = true" 
                                    class="absolute top-3.5 right-3.5 bg-[#FAF8F5]/95 backdrop-blur-md rounded-xl px-2.5 py-1 shadow-md border border-white/60 flex items-center gap-2 hover:scale-105 transition-transform"
                                >
                                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
                                    <span class="text-[9px] font-bold text-[#2B2621]" x-text="slide.tag"></span>
                                </button>

                                <!-- Bottom Caption Overlay -->
                                <div class="absolute bottom-3.5 left-3.5 right-3.5 text-[#FAF8F5]">
                                    <span class="text-[8px] font-bold uppercase tracking-widest text-amber-300 block mb-0.5" x-text="slide.badge"></span>
                                    <h4 class="font-editorial text-base sm:text-lg font-bold leading-tight" x-text="slide.title"></h4>
                                    <p class="text-[11px] text-[#FAF8F5]/80 font-normal line-clamp-1 mt-0.5" x-text="slide.desc"></p>
                                </div>
                            </div>
                        </template>

                        <!-- Progress Dots Indicator (Top-Left inside primary tile) -->
                        <div class="absolute top-3.5 left-3.5 flex items-center gap-1 z-10">
                            <template x-for="(slide, index) in slides" :key="'dot-'+index">
                                <span 
                                    class="h-1 rounded-full transition-all duration-300"
                                    :class="active === index ? 'w-4 bg-amber-400' : 'w-1.5 bg-white/40'"
                                ></span>
                            </template>
                        </div>

                    </div>

                    <!-- Right 5-Cols: Stacked Secondary Bento Tiles (Clickable to switch) -->
                    <div class="col-span-5 flex flex-col gap-3.5 sm:gap-4 h-full">
                        
                        <!-- Top Secondary Tile -->
                        <div 
                            class="relative flex-1 rounded-2xl overflow-hidden shadow-lg shadow-[#2B2621]/10 border border-white/60 bg-[#1E1B18] group cursor-pointer hover:border-amber-400/80 transition-all"
                            @click="goTo((active + 1) % slides.length)"
                            title="Click to view"
                        >
                            <img 
                                :src="slides[(active + 1) % slides.length].img" 
                                :alt="slides[(active + 1) % slides.length].title" 
                                class="w-full h-full object-cover object-center editorial-grade group-hover:scale-105 transition-transform duration-500"
                            />
                            <div class="absolute inset-0 bg-gradient-to-t from-[#2B2621]/80 via-transparent to-transparent"></div>
                            
                            <div class="absolute bottom-2.5 left-2.5 right-2.5 text-[#FAF8F5]">
                                <span class="text-[7px] font-bold uppercase tracking-widest text-emerald-300 block" x-text="slides[(active + 1) % slides.length].badge"></span>
                                <p class="text-[11px] font-bold leading-tight truncate" x-text="slides[(active + 1) % slides.length].title"></p>
                            </div>

                            <div class="absolute top-2 right-2 text-[9px] font-bold bg-[#FAF8F5]/90 text-[#2B2621] px-1.5 py-0.5 rounded-md shadow-sm">
                                Next →
                            </div>
                        </div>

                        <!-- Bottom Secondary Tile -->
                        <div 
                            class="relative flex-1 rounded-2xl overflow-hidden shadow-lg shadow-[#2B2621]/10 border border-white/60 bg-[#1E1B18] group cursor-pointer hover:border-amber-400/80 transition-all"
                            @click="goTo((active + 2) % slides.length)"
                            title="Click to view"
                        >
                            <img 
                                :src="slides[(active + 2) % slides.length].img" 
                                :alt="slides[(active + 2) % slides.length].title" 
                                class="w-full h-full object-cover object-center editorial-grade group-hover:scale-105 transition-transform duration-500"
                            />
                            <div class="absolute inset-0 bg-gradient-to-t from-[#2B2621]/80 via-transparent to-transparent"></div>
                            
                            <div class="absolute bottom-2.5 left-2.5 right-2.5 text-[#FAF8F5]">
                                <span class="text-[7px] font-bold uppercase tracking-widest text-amber-300 block" x-text="slides[(active + 2) % slides.length].badge"></span>
                                <p class="text-[11px] font-bold leading-tight truncate" x-text="slides[(active + 2) % slides.length].title"></p>
                            </div>
                        </div>

                    </div>

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
                        <button @click="selectedBatchName = 'HSC Science Special'; enrollModal = true; enrollSuccess = false" class="text-[#8A6E59] hover:text-[#2B2621] font-bold">
                            Enroll in Batch →
                        </button>
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
                        <button @click="selectedBatchName = 'SSC Board Excellence'; enrollModal = true; enrollSuccess = false" class="text-[#8A6E59] hover:text-[#2B2621] font-bold">
                            Enroll in Batch →
                        </button>
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
                        <button @click="selectedBatchName = 'Admission Engineering & Medical'; enrollModal = true; enrollSuccess = false" class="text-[#8A6E59] hover:text-[#2B2621] font-bold">
                            Enroll in Batch →
                        </button>
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

    <!-- 6. STUDENT ADMISSION & BATCH ENROLLMENT MODAL -->
    <div 
        x-show="enrollModal" 
        x-cloak 
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-md"
        @keydown.escape.window="enrollModal = false"
    >
        <div 
            @click.away="enrollModal = false"
            class="bg-[#FAF8F5] text-[#2B2621] border border-[#E5DFD7] rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl space-y-5"
        >
            <div class="flex items-center justify-between border-b border-[#E5DFD7] pb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-[#8A6E59]/20 text-[#8A6E59] flex items-center justify-center font-bold text-lg">
                        🎓
                    </div>
                    <div>
                        <h3 class="font-editorial text-xl font-bold text-[#2B2621]">Batch Admission & Inquiry</h3>
                        <p class="text-xs text-[#73685D]">Join an elite coaching batch for academic excellence</p>
                    </div>
                </div>
                <button @click="enrollModal = false" class="text-[#73685D] hover:text-[#2B2621] text-xl font-bold p-1">
                    ✕
                </button>
            </div>

            <!-- SUCCESS STATE -->
            <template x-if="enrollSuccess">
                <div class="py-6 text-center space-y-4">
                    <div class="w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center text-3xl mx-auto shadow-inner">
                        ✓
                    </div>
                    <div>
                        <h4 class="font-editorial text-2xl font-bold text-[#2B2621]">Application Received!</h4>
                        <p class="text-xs text-[#6B6157] mt-1 max-w-sm mx-auto leading-relaxed">
                            Thank you, <strong class="text-[#2B2621]" x-text="studentName || 'Student'"></strong>. Our academic counselor will reach out via WhatsApp at <strong class="text-[#2B2621]" x-text="guardianPhone || studentPhone || 'your number'"></strong> with the class schedule & diagnostic test date.
                        </p>
                    </div>
                    <div class="pt-2 flex justify-center gap-3">
                        <button @click="enrollModal = false" class="px-6 py-2.5 bg-[#2B2621] text-white rounded-full text-xs font-bold uppercase tracking-wider shadow">
                            Done
                        </button>
                        <a href="{{ route('login') }}" class="px-6 py-2.5 bg-[#8A6E59] text-white rounded-full text-xs font-bold uppercase tracking-wider shadow">
                            Student Portal Login →
                        </a>
                    </div>
                </div>
            </template>

            <!-- FORM STATE -->
            <template x-if="!enrollSuccess">
                <form @submit.prevent="enrollSuccess = true" class="space-y-4">
                    <div class="p-3 bg-[#EAE5DF]/70 rounded-2xl border border-[#D9D2C9] text-xs">
                        <span class="text-[10px] uppercase font-bold text-[#73685D] block">Selected Program</span>
                        <strong class="text-[#2B2621] text-sm" x-text="selectedBatchName"></strong>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-[#4A423B] uppercase mb-1">Student Full Name</label>
                        <input type="text" x-model="studentName" required placeholder="e.g. Siyam Ahmed" class="w-full bg-white border border-[#D9D2C9] rounded-xl px-4 py-2.5 text-xs text-[#2B2621] focus:ring-2 focus:ring-[#8A6E59] focus:outline-none">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[11px] font-bold text-[#4A423B] uppercase mb-1">Student Phone</label>
                            <input type="tel" x-model="studentPhone" required placeholder="+88017..." class="w-full bg-white border border-[#D9D2C9] rounded-xl px-4 py-2.5 text-xs text-[#2B2621] focus:ring-2 focus:ring-[#8A6E59] focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-[#4A423B] uppercase mb-1">Guardian WhatsApp</label>
                            <input type="tel" x-model="guardianPhone" placeholder="+88018..." class="w-full bg-white border border-[#D9D2C9] rounded-xl px-4 py-2.5 text-xs text-[#2B2621] focus:ring-2 focus:ring-[#8A6E59] focus:outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-[#4A423B] uppercase mb-1">Preferred Campus</label>
                        <select x-model="selectedBranch" class="w-full bg-white border border-[#D9D2C9] rounded-xl px-4 py-2.5 text-xs text-[#2B2621] focus:ring-2 focus:ring-[#8A6E59] focus:outline-none">
                            <option value="Dhaka Central Campus">Dhaka Central Campus (Dhanmondi / Farmgate)</option>
                            <option value="Uttara Branch">Uttara Branch (Sector 7)</option>
                            <option value="Chittagong Campus">Chittagong Campus (GEC Circle)</option>
                        </select>
                    </div>

                    <div class="pt-3 flex items-center justify-end gap-3 border-t border-[#E5DFD7]">
                        <button type="button" @click="enrollModal = false" class="px-5 py-2.5 text-xs font-bold text-[#73685D] hover:text-[#2B2621]">
                            Cancel
                        </button>
                        <button type="submit" class="px-6 py-2.5 bg-[#2B2621] hover:bg-[#433B34] text-white rounded-full text-xs font-bold uppercase tracking-wider shadow-lg hover:shadow-xl transition-all">
                            Submit Admission Application →
                        </button>
                    </div>
                </form>
            </template>
        </div>
    </div>

    @livewireScripts
</body>
</html>
