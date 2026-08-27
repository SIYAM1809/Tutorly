<div class="space-y-8">
    <!-- Top Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <div class="bg-slate-900/80 backdrop-blur-xl border border-slate-800 rounded-2xl p-5 shadow-xl hover:border-indigo-500/30 transition-all">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-400">Total Branches</span>
                <span class="p-2 bg-indigo-500/10 text-indigo-400 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </span>
            </div>
            <div class="text-3xl font-black text-white mt-3">{{ $totalBranches }}</div>
            <div class="text-[11px] text-emerald-400 mt-2 font-medium">Multi-branch SaaS Active</div>
        </div>

        <div class="bg-slate-900/80 backdrop-blur-xl border border-slate-800 rounded-2xl p-5 shadow-xl hover:border-indigo-500/30 transition-all">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-400">Enrolled Students</span>
                <span class="p-2 bg-cyan-500/10 text-cyan-400 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </span>
            </div>
            <div class="text-3xl font-black text-white mt-3">{{ $totalStudents }}</div>
            <div class="text-[11px] text-slate-400 mt-2">Active across all batches</div>
        </div>

        <div class="bg-slate-900/80 backdrop-blur-xl border border-slate-800 rounded-2xl p-5 shadow-xl hover:border-indigo-500/30 transition-all">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-400">Monthly Revenue</span>
                <span class="p-2 bg-emerald-500/10 text-emerald-400 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
            </div>
            <div class="text-3xl font-black text-white mt-3 font-mono">৳{{ number_format($monthlyRevenue, 2) }}</div>
            <div class="text-[11px] text-emerald-400 mt-2">SSLCommerz Verified</div>
        </div>

        <div class="bg-slate-900/80 backdrop-blur-xl border border-slate-800 rounded-2xl p-5 shadow-xl hover:border-indigo-500/30 transition-all">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-400">Today's Attendance</span>
                <span class="p-2 bg-purple-500/10 text-purple-400 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
            </div>
            <div class="text-3xl font-black text-white mt-3">{{ $todayAttendanceRate }}%</div>
            <div class="text-[11px] text-indigo-400 mt-2 font-medium">Synced via Reverb</div>
        </div>
    </div>

    <!-- AI Insight & Real-time Live Attendance Grid -->
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
