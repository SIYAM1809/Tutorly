<div class="space-y-6">

    {{-- ── Page Header ── --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-[#343a40]">
                Good {{ now()->hour < 12 ? 'Morning' : (now()->hour < 17 ? 'Afternoon' : 'Evening') }},
                {{ auth()->user()->name }} 👋
            </h1>
            <p class="text-xs text-[#9c9fa6] mt-0.5">
                {{ now()->format('l, d F Y') }} — Your Teaching Workspace
            </p>
        </div>
        <a href="{{ route('attendance.index') }}"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gradient-to-r from-[#b66dff] to-[#6c5ce7] text-white text-xs font-bold shadow-md hover:opacity-90 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
            </svg>
            Mark Today's Attendance
        </a>
    </div>

    {{-- ── KPI Cards ── --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

        {{-- Total Students --}}
        <div class="purple-gradient-card rounded-2xl p-5 bg-gradient-to-br from-[#b66dff] to-[#6c5ce7] text-white shadow-lg">
            <p class="text-xs font-semibold uppercase tracking-wider opacity-80 mb-1">My Students</p>
            <p class="text-3xl font-black">{{ $totalStudents }}</p>
            <p class="text-xs opacity-70 mt-1">Across all my batches</p>
        </div>

        {{-- Today's Classes --}}
        <div class="purple-gradient-card rounded-2xl p-5 bg-gradient-to-br from-[#00b09b] to-[#00d25b] text-white shadow-lg">
            <p class="text-xs font-semibold uppercase tracking-wider opacity-80 mb-1">Today's Classes</p>
            <p class="text-3xl font-black">{{ count($todayBatches) }}</p>
            <p class="text-xs opacity-70 mt-1">{{ now()->format('l') }}</p>
        </div>

        {{-- Attendance Rate --}}
        <div class="purple-gradient-card rounded-2xl p-5 bg-gradient-to-br from-[#f7971e] to-[#ffd200] text-white shadow-lg">
            <p class="text-xs font-semibold uppercase tracking-wider opacity-80 mb-1">7-Day Attendance</p>
            <p class="text-3xl font-black">{{ $overallAttendanceRate }}%</p>
            <p class="text-xs opacity-70 mt-1">Across all my batches</p>
        </div>
    </div>

    {{-- ── Today's Schedule + Upcoming Exams ── --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Today's Batches --}}
        <div class="bg-white rounded-2xl border border-[#ebedf2] p-5 shadow-sm">
            <h3 class="text-sm font-bold text-[#343a40] mb-4 flex items-center gap-2">
                <span class="text-base">📚</span> Today's Teaching Schedule
            </h3>
            @if(count($todayBatches) > 0)
                <div class="space-y-3">
                    @foreach($todayBatches as $batch)
                        <div class="flex items-center justify-between p-3 rounded-xl bg-purple-50/60 border border-purple-100">
                            <div>
                                <p class="text-xs font-bold text-[#343a40]">{{ $batch['name'] }}</p>
                                <p class="text-[11px] text-[#9c9fa6]">{{ $batch['subject'] }} · {{ $batch['branch_name'] }}</p>
                                <p class="text-[11px] text-[#b66dff] font-medium mt-0.5">{{ $batch['schedule'] }}</p>
                            </div>
                            <div class="text-right">
                                <span class="text-[11px] font-bold text-[#343a40]">{{ $batch['students'] }}</span>
                                <p class="text-[10px] text-[#9c9fa6]">students</p>
                                <a href="{{ route('attendance.index') }}"
                                   class="mt-1 inline-block text-[10px] font-bold text-[#b66dff] hover:underline">
                                    Mark →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 text-[#9c9fa6]">
                    <div class="text-4xl mb-2">😴</div>
                    <p class="text-xs">No classes scheduled for today.</p>
                </div>
            @endif
        </div>

        {{-- Upcoming Exams --}}
        <div class="bg-white rounded-2xl border border-[#ebedf2] p-5 shadow-sm">
            <h3 class="text-sm font-bold text-[#343a40] mb-4 flex items-center gap-2">
                <span class="text-base">📝</span> Upcoming Exams (Next 14 Days)
            </h3>
            @if(count($upcomingExams) > 0)
                <div class="space-y-3">
                    @foreach($upcomingExams as $exam)
                        <div class="flex items-center justify-between p-3 rounded-xl bg-amber-50/60 border border-amber-100">
                            <div>
                                <p class="text-xs font-bold text-[#343a40]">{{ $exam['title'] }}</p>
                                <p class="text-[11px] text-[#9c9fa6]">{{ $exam['batch'] }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs font-bold text-[#343a40]">{{ $exam['exam_date'] }}</p>
                                <span class="text-[10px] px-2 py-0.5 rounded-full font-bold
                                    {{ $exam['days_left'] <= 3 ? 'bg-red-100 text-red-600' : 'bg-amber-100 text-amber-700' }}">
                                    {{ $exam['days_left'] === 0 ? 'Today' : 'In ' . $exam['days_left'] . 'd' }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 text-[#9c9fa6]">
                    <div class="text-4xl mb-2">✅</div>
                    <p class="text-xs">No exams in the next 14 days.</p>
                </div>
            @endif
        </div>
    </div>

    {{-- ── Weekly Attendance Sparkline ── --}}
    <div class="bg-white rounded-2xl border border-[#ebedf2] p-5 shadow-sm">
        <h3 class="text-sm font-bold text-[#343a40] mb-4 flex items-center gap-2">
            <span class="text-base">📊</span> Attendance Trend — Last 7 Days
        </h3>
        <div class="flex items-end gap-3 h-24">
            @foreach($weeklyAttendance as $day)
                <div class="flex flex-col items-center gap-1 flex-1">
                    <span class="text-[10px] font-bold text-[#495057]">{{ $day['rate'] }}%</span>
                    <div class="w-full rounded-t-lg transition-all"
                         style="height: {{ max(4, ($day['rate'] / 100) * 64) }}px;
                                background: {{ $day['rate'] >= 80 ? '#00d25b' : ($day['rate'] >= 60 ? '#ffd200' : '#fc424a') }};">
                    </div>
                    <span class="text-[10px] text-[#9c9fa6]">{{ $day['label'] }}</span>
                </div>
            @endforeach
        </div>
    </div>

    {{-- ── Quick Links ── --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
        <a href="{{ route('attendance.index') }}"
           class="flex items-center gap-3 p-4 rounded-2xl bg-white border border-[#ebedf2] hover:border-[#b66dff] hover:shadow-md transition-all group">
            <span class="text-2xl">📋</span>
            <div>
                <p class="text-xs font-bold text-[#343a40] group-hover:text-[#b66dff]">Attendance Board</p>
                <p class="text-[10px] text-[#9c9fa6]">Mark present / absent</p>
            </div>
        </a>
        <a href="{{ route('batches.index') }}"
           class="flex items-center gap-3 p-4 rounded-2xl bg-white border border-[#ebedf2] hover:border-[#b66dff] hover:shadow-md transition-all group">
            <span class="text-2xl">📦</span>
            <div>
                <p class="text-xs font-bold text-[#343a40] group-hover:text-[#b66dff]">My Batches</p>
                <p class="text-[10px] text-[#9c9fa6]">View class rosters</p>
            </div>
        </a>
        <a href="{{ route('exams.index') }}"
           class="flex items-center gap-3 p-4 rounded-2xl bg-white border border-[#ebedf2] hover:border-[#b66dff] hover:shadow-md transition-all group">
            <span class="text-2xl">📝</span>
            <div>
                <p class="text-xs font-bold text-[#343a40] group-hover:text-[#b66dff]">Exams</p>
                <p class="text-[10px] text-[#9c9fa6]">View exam schedule</p>
            </div>
        </a>
    </div>
</div>
