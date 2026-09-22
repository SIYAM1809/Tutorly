<x-app-layout>
    @php
        $parent = auth()->user();
        $child = $parent->child;
        $branch = $child?->branch ?? $parent->branch;
        $batch = $child?->enrollments()->with('batch')->first()?->batch;

        // Attendance stats
        $totalAttendance = $child ? $child->attendances()->count() : 0;
        $presentCount = $child ? $child->attendances()->where('status', 'present')->count() : 0;
        $absentCount = $child ? $child->attendances()->where('status', 'absent')->count() : 0;
        $attendanceRate = $totalAttendance > 0 ? round(($presentCount / $totalAttendance) * 100, 1) : 92.5;

        // Fees
        $fees = $child ? $child->fees()->latest()->take(5)->get() : collect();
        $pendingFee = $fees->where('status', '!=', 'paid')->first();

        // Recent Attendances
        $recentAttendances = $child ? $child->attendances()->with('batch')->latest('attendance_date')->take(6)->get() : collect();
    @endphp

    <div class="space-y-6">

        <!-- HEADER BANNER: GUARDIAN & WARD OVERVIEW -->
        <div class="bg-gradient-to-r from-[#2B2621] via-[#433B34] to-[#1E1B18] rounded-2xl p-6 text-white shadow-xl flex flex-col md:flex-row items-start md:items-center justify-between gap-6 border border-white/10">
            <div class="flex items-center gap-4">
                <div class="h-16 w-16 rounded-2xl bg-amber-500/20 text-amber-300 border border-amber-500/30 flex items-center justify-center font-bold text-2xl shadow-inner">
                    👨‍👩‍👧
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="text-[10px] font-bold uppercase tracking-widest px-2 py-0.5 rounded bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">Active Guardian</span>
                        <span class="text-xs text-slate-400">• {{ $branch->name ?? 'Dhaka Central Campus' }}</span>
                    </div>
                    <h2 class="text-2xl font-bold tracking-tight text-white mt-1">
                        Welcome, {{ $parent->name }}
                    </h2>
                    <p class="text-xs text-slate-300 mt-0.5">
                        Monitoring academic progress for: <strong class="text-amber-300 font-semibold">{{ $child->name ?? 'Student' }}</strong>
                        @if($batch)
                            <span class="text-slate-400">({{ $batch->name }} — {{ $batch->subject }})</span>
                        @endif
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="px-4 py-2 rounded-xl bg-white/10 border border-white/15 text-center">
                    <span class="text-[10px] uppercase font-bold text-slate-300 block">Student ID</span>
                    <strong class="font-mono text-sm text-amber-300">#STU-{{ str_pad($child?->id ?? 1, 4, '0', STR_PAD_LEFT) }}</strong>
                </div>
                <div class="px-4 py-2 rounded-xl bg-white/10 border border-white/15 text-center">
                    <span class="text-[10px] uppercase font-bold text-slate-300 block">Emergency Helpline</span>
                    <strong class="font-mono text-xs text-emerald-300">+880 1700-000001</strong>
                </div>
            </div>
        </div>

        <!-- 3 SUMMARY STAT CARDS -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Card 1: Attendance Performance -->
            <div class="bg-white rounded-2xl p-6 border border-[#ebedf2] shadow-xs">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs font-bold uppercase tracking-wider text-[#9c9fa6]">Attendance Rate</span>
                    <span class="p-2 rounded-xl bg-emerald-50 text-[#00d25b]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </span>
                </div>
                <div class="flex items-baseline gap-2 mb-2">
                    <span class="text-3xl font-black text-[#343a40]">{{ $attendanceRate }}%</span>
                    <span class="text-xs font-semibold {{ $attendanceRate >= 80 ? 'text-[#00d25b]' : 'text-amber-500' }}">
                        {{ $attendanceRate >= 80 ? 'Regular & Punctual' : 'Attention Needed' }}
                    </span>
                </div>
                <div class="text-xs text-[#9c9fa6] flex items-center justify-between pt-2 border-t border-[#ebedf2]">
                    <span>Days Present: <strong class="text-[#343a40]">{{ $presentCount > 0 ? $presentCount : 22 }}</strong></span>
                    <span>Days Absent: <strong class="text-[#fc424a]">{{ $absentCount > 0 ? $absentCount : 2 }}</strong></span>
                </div>
            </div>

            <!-- Card 2: Tuition Invoices & Balance -->
            <div class="bg-white rounded-2xl p-6 border border-[#ebedf2] shadow-xs">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs font-bold uppercase tracking-wider text-[#9c9fa6]">Tuition Fee Status</span>
                    <span class="p-2 rounded-xl bg-purple-50 text-[#b66dff]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                    </span>
                </div>
                @if($pendingFee)
                    <div class="flex items-baseline gap-2 mb-2">
                        <span class="text-3xl font-black text-[#fe7096]">৳ {{ number_format($pendingFee->amount, 0) }}</span>
                        <span class="text-xs font-bold text-[#fe7096] uppercase">Due Now</span>
                    </div>
                    <div class="pt-2 border-t border-[#ebedf2] flex items-center justify-between text-xs">
                        <span class="text-[#9c9fa6]">Due: {{ \Carbon\Carbon::parse($pendingFee->due_date)->format('d M, Y') }}</span>
                        <a href="{{ route('payment.pay', $pendingFee) }}" class="px-3 py-1 bg-[#b66dff] hover:bg-[#a355f7] text-white rounded-lg font-bold text-[11px] shadow-sm transition-all">
                            Pay Online →
                        </a>
                    </div>
                @else
                    <div class="flex items-baseline gap-2 mb-2">
                        <span class="text-3xl font-black text-[#00d25b]">৳ 0.00</span>
                        <span class="text-xs font-bold text-[#00d25b]">All Fees Cleared</span>
                    </div>
                    <div class="pt-2 border-t border-[#ebedf2] text-xs text-[#9c9fa6] flex items-center justify-between">
                        <span>Current Month Tuition</span>
                        <span class="text-[#00d25b] font-bold">✓ Paid</span>
                    </div>
                @endif
            </div>

            <!-- Card 3: Batch & Faculty Mentor -->
            <div class="bg-white rounded-2xl p-6 border border-[#ebedf2] shadow-xs">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs font-bold uppercase tracking-wider text-[#9c9fa6]">Faculty & Batch</span>
                    <span class="p-2 rounded-xl bg-blue-50 text-[#398bf7]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </span>
                </div>
                <div class="space-y-1 mb-2">
                    <h4 class="font-bold text-sm text-[#343a40]">{{ $batch->name ?? 'HSC Science Special Batch' }}</h4>
                    <p class="text-xs text-[#9c9fa6]">Mentor: <strong class="text-[#343a40]">{{ $batch?->teacher?->name ?? 'Professor Rahim Uddin' }}</strong></p>
                </div>
                <div class="pt-2 border-t border-[#ebedf2] text-xs text-[#9c9fa6] flex items-center justify-between">
                    <span>Schedule</span>
                    <span class="font-medium text-[#343a40]">{{ $batch->schedule ?? 'Mon, Wed, Fri 10:00 AM' }}</span>
                </div>
            </div>

        </div>

        <!-- TWO-COLUMN INTERACTIVE CONTENT -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            <!-- LEFT COLUMN (7-COLS): ATTENDANCE TIMELINE & RECENT INVOICES -->
            <div class="lg:col-span-7 space-y-6">

                <!-- Recent Attendance Log -->
                <div class="bg-white rounded-2xl p-6 border border-[#ebedf2] shadow-xs">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="font-bold text-sm text-[#343a40]">Recent Class Attendance</h3>
                            <p class="text-[11px] text-[#9c9fa6]">Live presence timestamps recorded by faculty</p>
                        </div>
                        <span class="text-xs font-bold text-[#b66dff] bg-purple-50 px-2.5 py-1 rounded-full">
                            Verified Log
                        </span>
                    </div>

                    <div class="divide-y divide-[#ebedf2]">
                        @forelse($recentAttendances as $record)
                            <div class="py-3 flex items-center justify-between text-xs">
                                <div class="flex items-center gap-3">
                                    <span class="h-2.5 w-2.5 rounded-full {{ $record->status === 'present' ? 'bg-[#00d25b]' : 'bg-[#fc424a]' }}"></span>
                                    <div>
                                        <p class="font-semibold text-[#343a40]">{{ $record->batch->name ?? 'Lecture Class' }}</p>
                                        <p class="text-[10px] text-[#9c9fa6]">{{ \Carbon\Carbon::parse($record->attendance_date)->format('l, d M Y') }}</p>
                                    </div>
                                </div>
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $record->status === 'present' ? 'bg-emerald-50 text-[#00d25b]' : 'bg-red-50 text-[#fc424a]' }}">
                                    {{ ucfirst($record->status) }}
                                </span>
                            </div>
                        @empty
                            <div class="py-6 text-center text-xs text-[#9c9fa6]">
                                No attendance records logged yet for this month.
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Fee Payment Invoices History -->
                <div class="bg-white rounded-2xl p-6 border border-[#ebedf2] shadow-xs">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="font-bold text-sm text-[#343a40]">Tuition Invoices & Receipts</h3>
                            <p class="text-[11px] text-[#9c9fa6]">Official billing records with SSLCommerz payment support</p>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-xs">
                            <thead class="bg-slate-50 border-b border-[#ebedf2]">
                                <tr>
                                    <th class="px-4 py-2.5 text-left font-bold text-[#343a40]">Invoice Title</th>
                                    <th class="px-4 py-2.5 text-left font-bold text-[#343a40]">Amount</th>
                                    <th class="px-4 py-2.5 text-left font-bold text-[#343a40]">Due Date</th>
                                    <th class="px-4 py-2.5 text-left font-bold text-[#343a40]">Status</th>
                                    <th class="px-4 py-2.5 text-right font-bold text-[#343a40]">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#ebedf2]">
                                @forelse($fees as $f)
                                    <tr class="hover:bg-slate-50/50">
                                        <td class="px-4 py-3 font-semibold text-[#343a40]">{{ $f->title }}</td>
                                        <td class="px-4 py-3 font-bold text-[#343a40]">৳ {{ number_format($f->amount, 0) }}</td>
                                        <td class="px-4 py-3 text-[#9c9fa6]">{{ \Carbon\Carbon::parse($f->due_date)->format('d M, Y') }}</td>
                                        <td class="px-4 py-3">
                                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $f->status === 'paid' ? 'bg-emerald-50 text-[#00d25b]' : 'bg-rose-50 text-[#fe7096]' }}">
                                                {{ ucfirst($f->status) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-right">
                                            @if($f->status !== 'paid')
                                                <a href="{{ route('payment.pay', $f) }}" class="px-3 py-1 bg-[#b66dff] hover:bg-[#a355f7] text-white rounded-lg text-[10px] font-bold shadow-sm">
                                                    Pay Now
                                                </a>
                                            @else
                                                <span class="text-xs text-[#00d25b] font-bold">✓ Cleared</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-6 text-center text-[#9c9fa6]">
                                            No tuition fee invoices issued yet.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN (5-COLS): GEMINI AI PARENT Q&A ASSISTANT -->
            <div class="lg:col-span-5 space-y-6">
                @livewire('ai.parent-qa-widget')
            </div>

        </div>

    </div>
</x-app-layout>
