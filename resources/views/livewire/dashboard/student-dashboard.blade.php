<div class="space-y-6">

    {{-- ── Page Header ── --}}
    <div class="flex items-center justify-between flex-wrap gap-3">
        <div>
            <h1 class="text-xl font-bold text-[#343a40]">
                My Student Portal 🎓
            </h1>
            <p class="text-xs text-[#9c9fa6] mt-0.5">
                Welcome back, {{ auth()->user()->name }} — {{ now()->format('l, d F Y') }}
            </p>
        </div>
        @if(count($pendingFees) > 0)
            <a href="{{ route('student.fees') }}"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gradient-to-r from-rose-500 to-pink-500 text-white text-xs font-bold shadow-md hover:opacity-90 transition animate-pulse">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                ৳{{ number_format($totalDue, 0) }} Due — Pay Now
            </a>
        @endif
    </div>

    {{-- ── KPI Cards ── --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">

        {{-- Enrolled Batches --}}
        <div class="purple-gradient-card rounded-2xl p-5 bg-gradient-to-br from-[#b66dff] to-[#6c5ce7] text-white shadow-lg">
            <p class="text-[10px] font-semibold uppercase tracking-wider opacity-80 mb-1">Enrolled Batches</p>
            <p class="text-3xl font-black">{{ count($enrolledBatches) }}</p>
            <p class="text-[10px] opacity-70 mt-1">Active courses</p>
        </div>

        {{-- Attendance Rate --}}
        <div class="purple-gradient-card rounded-2xl p-5 bg-gradient-to-br from-[#00b09b] to-[#00d25b] text-white shadow-lg">
            <p class="text-[10px] font-semibold uppercase tracking-wider opacity-80 mb-1">This Month</p>
            <p class="text-3xl font-black">{{ $attendanceRate }}%</p>
            <p class="text-[10px] opacity-70 mt-1">{{ $presentCount }}/{{ $totalClassDays }} days present</p>
        </div>

        {{-- Upcoming Exams --}}
        <div class="purple-gradient-card rounded-2xl p-5 bg-gradient-to-br from-[#f7971e] to-[#ffd200] text-white shadow-lg">
            <p class="text-[10px] font-semibold uppercase tracking-wider opacity-80 mb-1">Upcoming Exams</p>
            <p class="text-3xl font-black">{{ count($upcomingExams) }}</p>
            <p class="text-[10px] opacity-70 mt-1">In next 30 days</p>
        </div>

        {{-- Pending Fees --}}
        <div class="purple-gradient-card rounded-2xl p-5 bg-gradient-to-br from-[#fc424a] to-[#fd7b6e] text-white shadow-lg">
            <p class="text-[10px] font-semibold uppercase tracking-wider opacity-80 mb-1">Fees Due</p>
            <p class="text-3xl font-black">{{ count($pendingFees) }}</p>
            <p class="text-[10px] opacity-70 mt-1">৳{{ number_format($totalDue, 0) }} total outstanding</p>
        </div>
    </div>

    {{-- ── Main Content Grid ── --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- My Enrolled Batches --}}
        <div class="bg-white rounded-2xl border border-[#ebedf2] p-5 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-bold text-[#343a40] flex items-center gap-2">
                    <span>📚</span> My Enrolled Batches
                </h3>
                <a href="{{ route('student.batches') }}" class="text-[11px] text-[#b66dff] font-semibold hover:underline">View All →</a>
            </div>
            @if(count($enrolledBatches) > 0)
                <div class="space-y-3">
                    @foreach($enrolledBatches as $batch)
                        <div class="p-3 rounded-xl bg-purple-50/50 border border-purple-100">
                            <div class="flex items-start justify-between">
                                <div>
                                    <p class="text-xs font-bold text-[#343a40]">{{ $batch['name'] }}</p>
                                    <p class="text-[11px] text-[#9c9fa6]">{{ $batch['subject'] }} · {{ $batch['branch'] }}</p>
                                    <p class="text-[11px] text-[#b66dff] font-medium mt-0.5">{{ $batch['schedule'] }}</p>
                                </div>
                                <div class="text-right shrink-0">
                                    <p class="text-[11px] text-[#6c757d]">Teacher</p>
                                    <p class="text-[11px] font-semibold text-[#343a40]">{{ $batch['teacher'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 text-[#9c9fa6]">
                    <div class="text-4xl mb-2">📭</div>
                    <p class="text-xs">You are not enrolled in any batch yet.</p>
                    <p class="text-[10px] mt-1">Contact your branch admin to get enrolled.</p>
                </div>
            @endif
        </div>

        {{-- Upcoming Exams --}}
        <div class="bg-white rounded-2xl border border-[#ebedf2] p-5 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-bold text-[#343a40] flex items-center gap-2">
                    <span>📝</span> Upcoming Exams
                </h3>
                <a href="{{ route('student.exams') }}" class="text-[11px] text-[#b66dff] font-semibold hover:underline">View All →</a>
            </div>
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
                                    {{ $exam['days_left'] === 0 ? 'Today!' : 'In ' . $exam['days_left'] . ' days' }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 text-[#9c9fa6]">
                    <div class="text-4xl mb-2">✅</div>
                    <p class="text-xs">No upcoming exams. Stay prepared!</p>
                </div>
            @endif
        </div>
    </div>

    {{-- ── Attendance + Fees Row ── --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Attendance This Month --}}
        <div class="bg-white rounded-2xl border border-[#ebedf2] p-5 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-bold text-[#343a40] flex items-center gap-2">
                    <span>📊</span> My Attendance — {{ now()->format('F Y') }}
                </h3>
                <a href="{{ route('student.attendance') }}" class="text-[11px] text-[#b66dff] font-semibold hover:underline">Full History →</a>
            </div>
            <div class="flex items-center gap-6">
                {{-- Circular Progress --}}
                <div class="relative w-24 h-24 shrink-0">
                    <svg class="w-24 h-24 -rotate-90" viewBox="0 0 36 36">
                        <circle cx="18" cy="18" r="15.9" fill="none" stroke="#f0f0f0" stroke-width="3"/>
                        <circle cx="18" cy="18" r="15.9" fill="none"
                            stroke="{{ $attendanceRate >= 80 ? '#00d25b' : ($attendanceRate >= 60 ? '#ffd200' : '#fc424a') }}"
                            stroke-width="3"
                            stroke-dasharray="{{ $attendanceRate }}, 100"
                            stroke-linecap="round"/>
                    </svg>
                    <div class="absolute inset-0 flex flex-col items-center justify-center">
                        <span class="text-lg font-black text-[#343a40]">{{ $attendanceRate }}%</span>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-[#00d25b]"></span>
                        <p class="text-xs text-[#495057]">Present: <strong>{{ $presentCount }} days</strong></p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-[#fc424a]"></span>
                        <p class="text-xs text-[#495057]">Absent: <strong>{{ $totalClassDays - $presentCount }} days</strong></p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-[#ebedf2]"></span>
                        <p class="text-xs text-[#495057]">Total Recorded: <strong>{{ $totalClassDays }} days</strong></p>
                    </div>
                    @if($attendanceRate < 75)
                        <p class="text-[10px] text-red-500 font-semibold">⚠️ Attendance below 75%. Speak to your teacher.</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Pending Fees --}}
        <div class="bg-white rounded-2xl border border-[#ebedf2] p-5 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-bold text-[#343a40] flex items-center gap-2">
                    <span>💳</span> Fees Due
                </h3>
                <a href="{{ route('student.fees') }}" class="text-[11px] text-[#b66dff] font-semibold hover:underline">All Invoices →</a>
            </div>
            @if(count($pendingFees) > 0)
                <div class="space-y-3">
                    @foreach(array_slice($pendingFees, 0, 4) as $fee)
                        <div class="flex items-center justify-between p-3 rounded-xl
                            {{ $fee['overdue'] ? 'bg-red-50 border border-red-100' : 'bg-slate-50 border border-[#ebedf2]' }}">
                            <div>
                                <p class="text-xs font-bold text-[#343a40]">{{ $fee['title'] }}</p>
                                <p class="text-[11px] {{ $fee['overdue'] ? 'text-red-500 font-semibold' : 'text-[#9c9fa6]' }}">
                                    Due: {{ $fee['due_date'] }} {{ $fee['overdue'] ? '— OVERDUE' : '' }}
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-black text-[#343a40]">৳{{ number_format($fee['amount'], 0) }}</p>
                                <a href="{{ route('payment.pay', $fee['id']) }}"
                                   class="text-[10px] font-bold text-white bg-[#b66dff] px-2 py-0.5 rounded-lg hover:opacity-90 transition">
                                    Pay
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-3 p-3 rounded-xl bg-purple-50 border border-purple-100 flex justify-between items-center">
                    <span class="text-xs font-bold text-[#343a40]">Total Outstanding</span>
                    <span class="text-sm font-black text-[#b66dff]">৳{{ number_format($totalDue, 0) }}</span>
                </div>
            @else
                <div class="text-center py-8 text-[#9c9fa6]">
                    <div class="text-4xl mb-2">🎉</div>
                    <p class="text-xs font-semibold text-[#00d25b]">All fees paid! You're all clear.</p>
                </div>
            @endif
        </div>
    </div>

    {{-- ── Certificates ── --}}
    @if(count($certificates) > 0)
        <div class="bg-white rounded-2xl border border-[#ebedf2] p-5 shadow-sm">
            <h3 class="text-sm font-bold text-[#343a40] mb-4 flex items-center gap-2">
                <span>🏅</span> My Certificates
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                @foreach($certificates as $cert)
                    <div class="p-4 rounded-xl bg-gradient-to-br from-amber-50 to-yellow-50 border border-amber-200">
                        <p class="text-xs font-bold text-[#343a40]">{{ $cert['batch'] }}</p>
                        <p class="text-[10px] text-[#9c9fa6] mt-0.5">Issued: {{ $cert['issued_at'] }}</p>
                        <p class="text-[10px] font-mono text-amber-700 mt-1 truncate">{{ $cert['number'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- ── Quick Links ── --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <a href="{{ route('student.attendance') }}"
           class="flex items-center gap-3 p-4 rounded-2xl bg-white border border-[#ebedf2] hover:border-[#b66dff] hover:shadow-md transition-all group">
            <span class="text-2xl">📋</span>
            <div>
                <p class="text-xs font-bold text-[#343a40] group-hover:text-[#b66dff]">My Attendance</p>
                <p class="text-[10px] text-[#9c9fa6]">Full history</p>
            </div>
        </a>
        <a href="{{ route('student.fees') }}"
           class="flex items-center gap-3 p-4 rounded-2xl bg-white border border-[#ebedf2] hover:border-[#b66dff] hover:shadow-md transition-all group">
            <span class="text-2xl">💳</span>
            <div>
                <p class="text-xs font-bold text-[#343a40] group-hover:text-[#b66dff]">My Fees</p>
                <p class="text-[10px] text-[#9c9fa6]">Pay online</p>
            </div>
        </a>
        <a href="{{ route('student.exams') }}"
           class="flex items-center gap-3 p-4 rounded-2xl bg-white border border-[#ebedf2] hover:border-[#b66dff] hover:shadow-md transition-all group">
            <span class="text-2xl">📝</span>
            <div>
                <p class="text-xs font-bold text-[#343a40] group-hover:text-[#b66dff]">My Exams</p>
                <p class="text-[10px] text-[#9c9fa6]">Results & schedule</p>
            </div>
        </a>
        <a href="{{ route('student.batches') }}"
           class="flex items-center gap-3 p-4 rounded-2xl bg-white border border-[#ebedf2] hover:border-[#b66dff] hover:shadow-md transition-all group">
            <span class="text-2xl">📚</span>
            <div>
                <p class="text-xs font-bold text-[#343a40] group-hover:text-[#b66dff]">My Batches</p>
                <p class="text-[10px] text-[#9c9fa6]">Class details</p>
            </div>
        </a>
    </div>
</div>
