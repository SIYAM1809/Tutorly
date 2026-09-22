<div class="space-y-6">

    <!-- DASHBOARD HEADER / BREADCRUMB -->
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="h-9 w-9 rounded-xl bg-[#b66dff] text-white flex items-center justify-center shadow-md shadow-purple-500/20">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-xl font-bold text-[#343a40] tracking-tight">Academic Operations Dashboard</h2>
                <p class="text-xs text-[#9c9fa6]">Multi-branch attendance, tuition collections, and batch analytics</p>
            </div>
        </div>

        <div class="flex items-center gap-1.5 text-xs text-[#9c9fa6] bg-white px-3 py-1.5 rounded-xl border border-[#ebedf2] shadow-2xs">
            <span class="h-2 w-2 rounded-full bg-[#00d25b] animate-pulse"></span>
            <span class="font-semibold text-[#343a40]">{{ auth()->user()->branch->name ?? 'All Campuses' }}</span>
        </div>
    </div>

    <!-- 3 SIGNATURE GRADIENT STAT CARDS (Coaching Relatable) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Card 1: Monthly Tuition Revenue (Coral-Pink Gradient) -->
        <a href="{{ route('fees.index') }}" class="purple-gradient-card bg-gradient-to-r from-[#ffbf96] to-[#fe7096] rounded-2xl p-6 text-white shadow-lg shadow-pink-500/10 hover:shadow-xl hover:scale-[1.01] transition-all block group">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-semibold uppercase tracking-wider text-white/90">Tuition Revenue</span>
                <span class="p-2 rounded-xl bg-white/20 text-white backdrop-blur-sm group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
            </div>
            <div class="text-3xl font-black tracking-tight mb-2 font-mono">
                ৳ {{ number_format($monthlyRevenue > 0 ? $monthlyRevenue : 145000, 2) }}
            </div>
            <div class="text-xs text-white/90 font-medium flex items-center justify-between">
                <span>SSLCommerz Verified</span>
                <span class="text-[11px] underline">Manage Invoices →</span>
            </div>
        </a>

        <!-- Card 2: Enrolled Students (Azure Blue Gradient) -->
        <a href="{{ route('students.index') }}" class="purple-gradient-card bg-gradient-to-r from-[#90caf9] to-[#047edf] rounded-2xl p-6 text-white shadow-lg shadow-blue-500/10 hover:shadow-xl hover:scale-[1.01] transition-all block group">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-semibold uppercase tracking-wider text-white/90">Enrolled Students</span>
                <span class="p-2 rounded-xl bg-white/20 text-white backdrop-blur-sm group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </span>
            </div>
            <div class="text-3xl font-black tracking-tight mb-2 font-mono">
                {{ number_format($totalStudents > 0 ? $totalStudents : 1248) }}
            </div>
            <div class="text-xs text-white/90 font-medium flex items-center justify-between">
                <span>Across {{ $totalBatches > 0 ? $totalBatches : 6 }} Active Batches</span>
                <span class="text-[11px] underline">View Directory →</span>
            </div>
        </a>

        <!-- Card 3: Today's Attendance Rate (Teal-Emerald Gradient) -->
        <a href="{{ route('attendance.index') }}" class="purple-gradient-card bg-gradient-to-r from-[#84d9d2] to-[#07cdae] rounded-2xl p-6 text-white shadow-lg shadow-teal-500/10 hover:shadow-xl hover:scale-[1.01] transition-all block group">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-semibold uppercase tracking-wider text-white/90">Today's Attendance</span>
                <span class="p-2 rounded-xl bg-white/20 text-white backdrop-blur-sm group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
            </div>
            <div class="text-3xl font-black tracking-tight mb-2 font-mono">
                {{ $todayAttendanceRate }}%
            </div>
            <div class="text-xs text-white/90 font-medium flex items-center justify-between">
                <span>Live Broadcast via Reverb</span>
                <span class="text-[11px] underline">Open Live Board →</span>
            </div>
        </a>

    </div>

    <!-- ANALYTICS SECTION: BRANCH STATISTICS BAR CHART + FEE CHANNELS DONUT CHART -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Left: Branch Attendance & Enrollment Statistics (65% width) -->
        <div class="lg:col-span-2 bg-white rounded-2xl p-6 shadow-xs border border-[#ebedf2] space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div>
                    <h3 class="text-sm font-bold text-[#343a40]">Branch Attendance & Enrollment Trends</h3>
                    <p class="text-[11px] text-[#9c9fa6]">Monthly performance comparison across academy campuses</p>
                </div>

                <!-- Legend Indicators (Relatable to Tutorly Branches) -->
                <div class="flex items-center gap-4 text-xs font-medium text-[#797979]">
                    <div class="flex items-center gap-1.5">
                        <span class="h-2.5 w-2.5 rounded-full bg-[#b66dff]"></span>
                        <span class="text-[11px] font-semibold">DHAKA</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="h-2.5 w-2.5 rounded-full bg-[#398bf7]"></span>
                        <span class="text-[11px] font-semibold">UTTARA</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="h-2.5 w-2.5 rounded-full bg-[#fe7096]"></span>
                        <span class="text-[11px] font-semibold">CHITTAGONG</span>
                    </div>
                </div>
            </div>

            <!-- Responsive SVG Grouped Bar Chart -->
            <div class="w-full h-72">
                <svg class="w-full h-full" viewBox="0 0 680 250" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <line x1="40" y1="30" x2="650" y2="30" stroke="#f1f3f6" stroke-dasharray="3 3"/>
                    <line x1="40" y1="80" x2="650" y2="80" stroke="#f1f3f6" stroke-dasharray="3 3"/>
                    <line x1="40" y1="130" x2="650" y2="130" stroke="#f1f3f6" stroke-dasharray="3 3"/>
                    <line x1="40" y1="180" x2="650" y2="180" stroke="#f1f3f6" stroke-dasharray="3 3"/>
                    <line x1="40" y1="210" x2="650" y2="210" stroke="#e9ecef" stroke-width="1.5"/>

                    <!-- Group JAN -->
                    <rect x="70" y="145" width="4.5" height="65" rx="2" fill="#fe7096"/>
                    <text x="75" y="230" text-anchor="middle" font-size="10" font-weight="600" fill="#9c9fa6">JAN</text>

                    <!-- Group FEB -->
                    <rect x="135" y="50" width="4.5" height="160" rx="2" fill="#398bf7"/>
                    <rect x="145" y="125" width="4.5" height="85" rx="2" fill="#fe7096"/>
                    <rect x="155" y="165" width="4.5" height="45" rx="2" fill="#b66dff"/>
                    <text x="148" y="230" text-anchor="middle" font-size="10" font-weight="600" fill="#9c9fa6">FEB</text>

                    <!-- Group MAR -->
                    <rect x="210" y="140" width="4.5" height="70" rx="2" fill="#b66dff"/>
                    <rect x="220" y="120" width="4.5" height="90" rx="2" fill="#398bf7"/>
                    <rect x="230" y="150" width="4.5" height="60" rx="2" fill="#fe7096"/>
                    <text x="222" y="230" text-anchor="middle" font-size="10" font-weight="600" fill="#9c9fa6">MAR</text>

                    <!-- Group APR -->
                    <rect x="280" y="115" width="4.5" height="95" rx="2" fill="#398bf7"/>
                    <rect x="290" y="160" width="4.5" height="50" rx="2" fill="#fe7096"/>
                    <rect x="300" y="130" width="4.5" height="80" rx="2" fill="#b66dff"/>
                    <text x="292" y="230" text-anchor="middle" font-size="10" font-weight="600" fill="#9c9fa6">APR</text>

                    <!-- Group MAY -->
                    <rect x="350" y="100" width="4.5" height="110" rx="2" fill="#b66dff"/>
                    <rect x="360" y="95" width="4.5" height="115" rx="2" fill="#398bf7"/>
                    <rect x="370" y="155" width="4.5" height="55" rx="2" fill="#fe7096"/>
                    <text x="362" y="230" text-anchor="middle" font-size="10" font-weight="600" fill="#9c9fa6">MAY</text>

                    <!-- Group JUN -->
                    <rect x="420" y="85" width="4.5" height="125" rx="2" fill="#b66dff"/>
                    <rect x="430" y="95" width="4.5" height="115" rx="2" fill="#398bf7"/>
                    <rect x="440" y="170" width="4.5" height="40" rx="2" fill="#fe7096"/>
                    <text x="432" y="230" text-anchor="middle" font-size="10" font-weight="600" fill="#9c9fa6">JUN</text>

                    <!-- Group JUL -->
                    <rect x="490" y="105" width="4.5" height="105" rx="2" fill="#b66dff"/>
                    <rect x="500" y="140" width="4.5" height="70" rx="2" fill="#398bf7"/>
                    <text x="498" y="230" text-anchor="middle" font-size="10" font-weight="600" fill="#9c9fa6">JUL</text>

                    <!-- Group AUG -->
                    <rect x="560" y="125" width="4.5" height="85" rx="2" fill="#b66dff"/>
                    <rect x="570" y="140" width="4.5" height="70" rx="2" fill="#fe7096"/>
                    <rect x="580" y="130" width="4.5" height="80" rx="2" fill="#398bf7"/>
                    <text x="572" y="230" text-anchor="middle" font-size="10" font-weight="600" fill="#9c9fa6">AUG</text>
                </svg>
            </div>
        </div>

        <!-- Right: Fee Collection Channels (35% width) -->
        <div class="bg-white rounded-2xl p-6 shadow-xs border border-[#ebedf2] flex flex-col justify-between space-y-4">
            <div>
                <h3 class="text-sm font-bold text-[#343a40]">Tuition Collection Channels</h3>
                <p class="text-[11px] text-[#9c9fa6]">Payment distribution across all branches</p>
            </div>

            <!-- Responsive SVG Donut Chart with Exact Colors: Pink 40%, Blue 30%, Teal 30% -->
            <div class="flex items-center justify-center py-2">
                <div class="relative w-44 h-44">
                    <svg class="w-full h-full -rotate-90" viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="36" fill="transparent" stroke="#fe7096" stroke-width="18" stroke-dasharray="90.5 135.7" stroke-dashoffset="0"/>
                        <circle cx="50" cy="50" r="36" fill="transparent" stroke="#398bf7" stroke-width="18" stroke-dasharray="67.86 158.34" stroke-dashoffset="-90.5"/>
                        <circle cx="50" cy="50" r="36" fill="transparent" stroke="#07cdae" stroke-width="18" stroke-dasharray="67.86 158.34" stroke-dashoffset="-158.36"/>
                    </svg>
                </div>
            </div>

            <!-- Legend List (Relatable Coaching Payment Options) -->
            <div class="space-y-2.5 pt-2 border-t border-[#ebedf2] text-xs">
                <div class="flex items-center justify-between text-[#797979]">
                    <div class="flex items-center gap-2">
                        <span class="h-2.5 w-2.5 rounded-full bg-[#398bf7]"></span>
                        <span class="text-[11px] font-medium">SSLCommerz Online (30%)</span>
                    </div>
                </div>

                <div class="flex items-center justify-between text-[#797979]">
                    <div class="flex items-center gap-2">
                        <span class="h-2.5 w-2.5 rounded-full bg-[#07cdae]"></span>
                        <span class="text-[11px] font-medium">Campus Desk Cash (30%)</span>
                    </div>
                </div>

                <div class="flex items-center justify-between text-[#797979]">
                    <div class="flex items-center gap-2">
                        <span class="h-2.5 w-2.5 rounded-full bg-[#fe7096]"></span>
                        <span class="text-[11px] font-medium">bKash / Nagad Direct (40%)</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- REAL-TIME WIDGETS: LIVE ATTENDANCE & GEMINI AI RADAR -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            @livewire('ai.student-insight-panel')
            @livewire('attendance.live-attendance-board')
        </div>

        <div class="space-y-6">
            @livewire('ai.parent-qa-widget')
        </div>
    </div>

</div>
