<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
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
<body class="font-ui antialiased text-[#2B2621] selection:bg-[#2B2621] selection:text-[#FAF8F5] bg-[#EAE5DF] min-h-screen" x-data="{ enrollModal: false, selectedBatchName: 'HSC Science Special', enrollSuccess: false, studentName: '', studentPhone: '', guardianPhone: '', selectedBranch: 'Dhaka Central Campus', lang: 'ENG', isSubmitting: false, errorMessage: '' }">

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
                </nav>

                <!-- Language & Portal Login -->
                <div class="flex items-center gap-4">
                    <button @click="lang = lang === 'ENG' ? 'বাংলা' : 'ENG'" class="text-xs font-semibold text-[#5A524A] hover:text-[#2B2621] tracking-wider uppercase hidden sm:inline-block px-2.5 py-1 rounded-full border border-[#D9D2C9] transition-all">
                        <span x-text="lang === 'ENG' ? 'ENG (Switch to বাংলা)' : 'বাংলা (Switch to ENG)'"></span>
                    </button>
                    
                    <a href="{{ route('login') }}" class="px-6 py-2.5 rounded-full bg-[#2B2621] text-[#FAF8F5] text-xs font-bold uppercase tracking-wider hover:bg-[#433B34] transition-all shadow-md hover:shadow-lg hover:-translate-y-0.5">
                        Portal Login
                    </a>
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
                    
                    <a href="#branches" class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#2B2621] hover:text-[#5A5147] transition-colors group">
                        <span class="w-7 h-7 rounded-full border border-[#2B2621]/30 flex items-center justify-center group-hover:border-[#2B2621] transition-colors">
                            <svg class="w-3.5 h-3.5 text-[#2B2621]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </span>
                        <span>Find a Campus →</span>
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
                                <div class="absolute top-3.5 right-3.5 bg-[#FAF8F5]/95 backdrop-blur-md rounded-xl px-2.5 py-1 shadow-md border border-white/60 flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
                                    <span class="text-[9px] font-bold text-[#2B2621]" x-text="slide.tag"></span>
                                </div>

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

        </div>
    </section>

    <!-- 4. ACADEMY CAMPUSES & BRANCH NETWORK (#branches) -->
    <section id="branches" class="py-20 bg-[#FAF8F5] border-t border-[#D9D2C9]">
        <div class="max-w-7xl mx-auto px-6 sm:px-8">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#8A6E59]/10 text-[11px] font-bold text-[#8A6E59] uppercase tracking-widest mb-3">
                        <span>📍 Nationwide Network</span>
                    </div>
                    <h2 class="font-editorial text-4xl sm:text-5xl font-bold text-[#2B2621]">
                        Our Academy Campuses
                    </h2>
                </div>
                <p class="text-xs text-[#6B6157] max-w-md leading-relaxed">
                    Purpose-built learning facilities featuring air-conditioned smart lecture rooms, biometric student tracking, and dedicated faculty diagnostic labs.
                </p>
            </div>

            <!-- 3 CAMPUS CARDS -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Campus 1: Dhaka Central (Dhanmondi / Farmgate) -->
                <div class="bg-white rounded-3xl p-7 border border-[#E5DFD7] shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between space-y-6">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-bold uppercase tracking-wider">
                                Flagship Campus
                            </span>
                            <span class="font-mono text-[11px] font-bold text-[#8A6E59]">BR-DHK-01</span>
                        </div>

                        <div>
                            <h3 class="font-editorial text-2xl font-bold text-[#2B2621]">Dhaka Central Campus</h3>
                            <p class="text-[11px] text-[#73685D] mt-0.5">Dhanmondi / Farmgate Educational Zone</p>
                        </div>

                        <!-- Address & Location -->
                        <div class="p-3.5 bg-[#FAF8F5] rounded-2xl border border-[#EAE5DF] space-y-1 text-xs">
                            <div class="flex items-start gap-2 text-[#4A423B]">
                                <span class="text-sm">📍</span>
                                <div>
                                    <strong class="text-[#2B2621] block">Concord Royal Plaza (Level 4–6)</strong>
                                    <span class="text-[11px] text-[#73685D]">Road 27 (Old), Dhanmondi, Dhaka-1209 (Near Mirpur Road junction)</span>
                                </div>
                            </div>
                        </div>

                        <!-- Facilities & Specs -->
                        <div class="space-y-2">
                            <span class="text-[10px] uppercase font-bold text-[#8A6E59] tracking-wider block">Campus Facilities</span>
                            <ul class="text-xs text-[#5A5147] space-y-1.5">
                                <li class="flex items-center gap-2">
                                    <span class="text-emerald-600 font-bold">✓</span>
                                    <span><strong>10 AC Lecture Studios</strong> (420+ Student Capacity)</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="text-emerald-600 font-bold">✓</span>
                                    <span>Physics & Chemistry Demonstration Lab</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="text-emerald-600 font-bold">✓</span>
                                    <span>Biometric RFID Attendance & Instant SMS Relay</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="text-emerald-600 font-bold">✓</span>
                                    <span>1-on-1 Faculty Mentorship & Diagnostic Room</span>
                                </li>
                            </ul>
                        </div>

                        <!-- In-charge & Timings -->
                        <div class="pt-3 border-t border-[#EAE5DF] space-y-1 text-[11px] text-[#73685D]">
                            <div class="flex items-center justify-between">
                                <span>Operations Lead:</span>
                                <strong class="text-[#2B2621]">Md. Arifuzzaman</strong>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>Open Hours:</span>
                                <span class="font-medium text-[#2B2621]">Sat–Thu: 8:00 AM – 8:30 PM</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>Helpline:</span>
                                <a href="tel:+8801700000002" class="font-mono font-bold text-[#8A6E59] hover:underline">+880 1700-000002</a>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="pt-2 flex items-center gap-2">
                        <button 
                            @click="selectedBranch = 'Dhaka Central Campus'; enrollModal = true; enrollSuccess = false" 
                            class="flex-1 py-3 px-4 rounded-full bg-[#2B2621] hover:bg-[#433B34] text-white text-xs font-bold uppercase tracking-wider text-center transition-all shadow-md"
                        >
                            Apply for Dhaka →
                        </button>
                        <a 
                            href="https://wa.me/8801700000002" 
                            target="_blank" 
                            rel="noreferrer" 
                            class="p-3 rounded-full bg-emerald-50 text-emerald-700 hover:bg-emerald-100 transition-colors border border-emerald-200" 
                            title="Chat on WhatsApp"
                        >
                            💬
                        </a>
                    </div>
                </div>

                <!-- Campus 2: Uttara Branch -->
                <div class="bg-white rounded-3xl p-7 border border-[#E5DFD7] shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between space-y-6">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-800 text-[10px] font-bold uppercase tracking-wider">
                                North Zone Hub
                            </span>
                            <span class="font-mono text-[11px] font-bold text-[#8A6E59]">BR-UTR-02</span>
                        </div>

                        <div>
                            <h3 class="font-editorial text-2xl font-bold text-[#2B2621]">Uttara Campus</h3>
                            <p class="text-[11px] text-[#73685D] mt-0.5">Sector 7 / Rabindra Sarani Hub</p>
                        </div>

                        <!-- Address & Location -->
                        <div class="p-3.5 bg-[#FAF8F5] rounded-2xl border border-[#EAE5DF] space-y-1 text-xs">
                            <div class="flex items-start gap-2 text-[#4A423B]">
                                <span class="text-sm">📍</span>
                                <div>
                                    <strong class="text-[#2B2621] block">Plot 14, Jashimuddin Avenue</strong>
                                    <span class="text-[11px] text-[#73685D]">Sector 7 (Opposite Rajuk Uttara Model College), Uttara, Dhaka-1230</span>
                                </div>
                            </div>
                        </div>

                        <!-- Facilities & Specs -->
                        <div class="space-y-2">
                            <span class="text-[10px] uppercase font-bold text-[#8A6E59] tracking-wider block">Campus Facilities</span>
                            <ul class="text-xs text-[#5A5147] space-y-1.5">
                                <li class="flex items-center gap-2">
                                    <span class="text-emerald-600 font-bold">✓</span>
                                    <span><strong>6 Smart Lecture Studios</strong> (240+ Student Capacity)</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="text-emerald-600 font-bold">✓</span>
                                    <span>High-speed Silent Study Lounge & Wi-Fi Testing</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="text-emerald-600 font-bold">✓</span>
                                    <span>CCTV Surveillance with Female Guardian Lounge</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="text-emerald-600 font-bold">✓</span>
                                    <span>Automated WhatsApp Attendance Notifications</span>
                                </li>
                            </ul>
                        </div>

                        <!-- In-charge & Timings -->
                        <div class="pt-3 border-t border-[#EAE5DF] space-y-1 text-[11px] text-[#73685D]">
                            <div class="flex items-center justify-between">
                                <span>Campus In-Charge:</span>
                                <strong class="text-[#2B2621]">Farhana Yasmin</strong>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>Open Hours:</span>
                                <span class="font-medium text-[#2B2621]">Sat–Thu: 8:30 AM – 8:00 PM</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>Helpline:</span>
                                <a href="tel:+8801800000003" class="font-mono font-bold text-[#8A6E59] hover:underline">+880 1800-000003</a>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="pt-2 flex items-center gap-2">
                        <button 
                            @click="selectedBranch = 'Uttara Branch'; enrollModal = true; enrollSuccess = false" 
                            class="flex-1 py-3 px-4 rounded-full bg-[#2B2621] hover:bg-[#433B34] text-white text-xs font-bold uppercase tracking-wider text-center transition-all shadow-md"
                        >
                            Apply for Uttara →
                        </button>
                        <a 
                            href="https://wa.me/8801800000003" 
                            target="_blank" 
                            rel="noreferrer" 
                            class="p-3 rounded-full bg-emerald-50 text-emerald-700 hover:bg-emerald-100 transition-colors border border-emerald-200" 
                            title="Chat on WhatsApp"
                        >
                            💬
                        </a>
                    </div>
                </div>

                <!-- Campus 3: Chittagong Campus -->
                <div class="bg-white rounded-3xl p-7 border border-[#E5DFD7] shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between space-y-6">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="px-3 py-1 rounded-full bg-amber-100 text-amber-800 text-[10px] font-bold uppercase tracking-wider">
                                Port City Regional Hub
                            </span>
                            <span class="font-mono text-[11px] font-bold text-[#8A6E59]">BR-CTG-03</span>
                        </div>

                        <div>
                            <h3 class="font-editorial text-2xl font-bold text-[#2B2621]">Chittagong Campus</h3>
                            <p class="text-[11px] text-[#73685D] mt-0.5">GEC Circle / Nasirabad Educational Area</p>
                        </div>

                        <!-- Address & Location -->
                        <div class="p-3.5 bg-[#FAF8F5] rounded-2xl border border-[#EAE5DF] space-y-1 text-xs">
                            <div class="flex items-start gap-2 text-[#4A423B]">
                                <span class="text-sm">📍</span>
                                <div>
                                    <strong class="text-[#2B2621] block">Afsar Heights (3rd Floor)</strong>
                                    <span class="text-[11px] text-[#73685D]">GEC Circle, O.R. Nizam Road, CDA Avenue, Chattogram-4000</span>
                                </div>
                            </div>
                        </div>

                        <!-- Facilities & Specs -->
                        <div class="space-y-2">
                            <span class="text-[10px] uppercase font-bold text-[#8A6E59] tracking-wider block">Campus Facilities</span>
                            <ul class="text-xs text-[#5A5147] space-y-1.5">
                                <li class="flex items-center gap-2">
                                    <span class="text-emerald-600 font-bold">✓</span>
                                    <span><strong>5 Acoustic Classrooms</strong> & Model Test Examination Hall</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="text-emerald-600 font-bold">✓</span>
                                    <span>Chittagong Board & Medical Diagnostic Center</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="text-emerald-600 font-bold">✓</span>
                                    <span>Faculty Roster with CUET & CMC Guest Lecturers</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="text-emerald-600 font-bold">✓</span>
                                    <span>Biometric Attendance & Guardian Query Desk</span>
                                </li>
                            </ul>
                        </div>

                        <!-- In-charge & Timings -->
                        <div class="pt-3 border-t border-[#EAE5DF] space-y-1 text-[11px] text-[#73685D]">
                            <div class="flex items-center justify-between">
                                <span>Campus Coordinator:</span>
                                <strong class="text-[#2B2621]">Engr. Tanvir Ahmed</strong>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>Open Hours:</span>
                                <span class="font-medium text-[#2B2621]">Sat–Thu: 9:00 AM – 8:00 PM</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>Helpline:</span>
                                <a href="tel:+8801900000004" class="font-mono font-bold text-[#8A6E59] hover:underline">+880 1900-000004</a>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="pt-2 flex items-center gap-2">
                        <button 
                            @click="selectedBranch = 'Chittagong Campus'; enrollModal = true; enrollSuccess = false" 
                            class="flex-1 py-3 px-4 rounded-full bg-[#2B2621] hover:bg-[#433B34] text-white text-xs font-bold uppercase tracking-wider text-center transition-all shadow-md"
                        >
                            Apply for Chittagong →
                        </button>
                        <a 
                            href="https://wa.me/8801900000004" 
                            target="_blank" 
                            rel="noreferrer" 
                            class="p-3 rounded-full bg-emerald-50 text-emerald-700 hover:bg-emerald-100 transition-colors border border-emerald-200" 
                            title="Chat on WhatsApp"
                        >
                            💬
                        </a>
                    </div>
                </div>

            </div>

            <!-- Bottom Multi-Campus Synchrony Banner -->
            <div class="mt-12 bg-white/70 backdrop-blur-md rounded-3xl p-6 border border-[#E5DFD7] flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-[#8A6E59]/20 text-[#8A6E59] flex items-center justify-center text-2xl flex-shrink-0">
                        🔄
                    </div>
                    <div>
                        <h4 class="font-bold text-sm text-[#2B2621]">Centralized Academic Quality Across All 3 Campuses</h4>
                        <p class="text-xs text-[#73685D] mt-0.5">Identical lecture plans, synchronized weekly model tests, and centralized digital report cards across all branches.</p>
                    </div>
                </div>
                <button @click="enrollModal = true; enrollSuccess = false" class="px-6 py-2.5 rounded-full bg-[#2B2621] hover:bg-[#433B34] text-white text-xs font-bold uppercase tracking-wider transition-all shadow-md flex-shrink-0">
                    Speak with an Academic Advisor →
                </button>
            </div>

        </div>
    </section>

    <!-- 4. FOOTER & ADMISSIONS ACCESS BAR -->
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
                    <button @click="enrollModal = true; enrollSuccess = false" class="px-7 py-3 rounded-full bg-[#FAF8F5] text-[#2B2621] text-xs font-bold uppercase tracking-widest hover:bg-amber-100 transition-all shadow-lg">
                        Apply for Admission (2026–27) →
                    </button>
                </div>
            </div>

            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-[#FAF8F5]/60 gap-4">
                <div>© {{ date('Y') }} Tutorly Academy. All rights reserved.</div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('login') }}" class="hover:text-white transition-colors">Portal Login</a>
                    <span>•</span>
                    <a href="#branches" class="hover:text-white transition-colors">Campus Locations</a>
                    <span>•</span>
                    <a href="#programs" class="hover:text-white transition-colors">Academic Programs</a>
                </div>
            </div>

        </div>
    </footer>

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
                        <a href="{{ route('demo.login', 'student') }}" class="px-6 py-2.5 bg-[#8A6E59] hover:bg-[#705541] text-white rounded-full text-xs font-bold uppercase tracking-wider shadow transition-all">
                            Open Student Portal →
                        </a>
                    </div>
                </div>
            </template>

            <!-- FORM STATE -->
            <template x-if="!enrollSuccess">
                <form @submit.prevent="
                    isSubmitting = true;
                    errorMessage = '';
                    fetch('{{ route('admissions.store') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            student_name: studentName,
                            student_phone: studentPhone,
                            guardian_phone: guardianPhone,
                            batch_name: selectedBatchName,
                            selected_branch: selectedBranch
                        })
                    })
                    .then(async res => {
                        const data = await res.json();
                        if (!res.ok) {
                            throw new Error(data.message || 'Submission failed');
                        }
                        return data;
                    })
                    .then(data => {
                        isSubmitting = false;
                        enrollSuccess = true;
                    })
                    .catch(err => {
                        isSubmitting = false;
                        errorMessage = err.message || 'Failed to submit inquiry. Please check your information and try again.';
                    });
                " class="space-y-4">
                    <div class="p-3 bg-[#EAE5DF]/70 rounded-2xl border border-[#D9D2C9] text-xs">
                        <span class="text-[10px] uppercase font-bold text-[#73685D] block">Selected Program</span>
                        <strong class="text-[#2B2621] text-sm" x-text="selectedBatchName"></strong>
                    </div>

                    <div x-show="errorMessage" x-cloak class="p-3 bg-rose-50 border border-rose-200 text-rose-700 rounded-xl text-xs font-semibold">
                        <span x-text="errorMessage"></span>
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
                        <button type="submit" :disabled="isSubmitting" class="px-6 py-2.5 bg-[#2B2621] hover:bg-[#433B34] text-white rounded-full text-xs font-bold uppercase tracking-wider shadow-lg hover:shadow-xl transition-all disabled:opacity-50">
                            <span x-show="!isSubmitting">Submit Admission Application →</span>
                            <span x-show="isSubmitting" x-cloak>Submitting Application...</span>
                        </button>
                    </div>
                </form>
            </template>
        </div>
    </div>

    @livewireScripts
</body>
</html>
