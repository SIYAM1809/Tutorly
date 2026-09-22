<x-app-layout>
    <div class="space-y-6">
        <div>
            <h1 class="text-xl font-bold text-[#343a40]">My Exams & Results</h1>
            <p class="text-xs text-[#9c9fa6] mt-0.5">Upcoming exams and certificates for your batches</p>
        </div>
        @php
            $batchIds = \App\Models\Enrollment::where('student_id', auth()->id())
                ->where('status', 'active')->pluck('batch_id');
            $upcomingExams = \App\Models\Exam::with('batch')
                ->whereIn('batch_id', $batchIds)
                ->where('exam_date', '>=', now()->toDateString())
                ->orderBy('exam_date')->get();
            $pastExams = \App\Models\Exam::with('batch')
                ->whereIn('batch_id', $batchIds)
                ->where('exam_date', '<', now()->toDateString())
                ->orderByDesc('exam_date')->take(10)->get();
            $certificates = \App\Models\Certificate::with('batch')
                ->where('student_id', auth()->id())->get();
        @endphp

        @if($upcomingExams->isNotEmpty())
            <div class="bg-white rounded-2xl border border-[#ebedf2] shadow-sm p-5">
                <h3 class="text-sm font-bold text-[#343a40] mb-4">📅 Upcoming Exams</h3>
                <div class="space-y-3">
                    @foreach($upcomingExams as $exam)
                        <div class="flex items-center justify-between p-3 rounded-xl bg-amber-50 border border-amber-100">
                            <div>
                                <p class="text-xs font-bold text-[#343a40]">{{ $exam->title }}</p>
                                <p class="text-[11px] text-[#9c9fa6]">{{ $exam->batch?->name }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs font-bold">{{ \Carbon\Carbon::parse($exam->exam_date)->format('d M, Y') }}</p>
                                <span class="text-[10px] font-bold text-amber-700">
                                    In {{ \Carbon\Carbon::today()->diffInDays(\Carbon\Carbon::parse($exam->exam_date)) }} days
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        @if($certificates->isNotEmpty())
            <div class="bg-white rounded-2xl border border-[#ebedf2] shadow-sm p-5">
                <h3 class="text-sm font-bold text-[#343a40] mb-4">🏅 My Certificates</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach($certificates as $cert)
                        <div class="p-4 rounded-xl bg-gradient-to-br from-amber-50 to-yellow-50 border border-amber-200">
                            <p class="text-xs font-bold text-[#343a40]">{{ $cert->batch?->name }}</p>
                            <p class="text-[11px] text-[#9c9fa6]">Issued: {{ \Carbon\Carbon::parse($cert->issued_at)->format('d M, Y') }}</p>
                            <p class="text-[10px] font-mono text-amber-700 mt-1">{{ $cert->certificate_number }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        @if($upcomingExams->isEmpty() && $certificates->isEmpty())
            <div class="bg-white rounded-2xl border border-[#ebedf2] p-12 text-center">
                <div class="text-5xl mb-4">📝</div>
                <p class="text-sm font-semibold text-[#6c757d]">No upcoming exams scheduled.</p>
                <p class="text-xs text-[#9c9fa6] mt-1">Keep studying — results will appear here once exams are added.</p>
            </div>
        @endif
    </div>
</x-app-layout>
