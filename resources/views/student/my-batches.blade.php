<x-app-layout>
    <div class="space-y-6">
        <div>
            <h1 class="text-xl font-bold text-[#343a40]">My Batches</h1>
            <p class="text-xs text-[#9c9fa6] mt-0.5">Your active enrolled courses and class schedules</p>
        </div>
        @php
            $enrollments = \App\Models\Enrollment::with(['batch.branch', 'batch.teacher'])
                ->where('student_id', auth()->id())->where('status', 'active')->get();
        @endphp
        @if($enrollments->isEmpty())
            <div class="bg-white rounded-2xl border border-[#ebedf2] p-12 text-center">
                <div class="text-5xl mb-4">📭</div>
                <p class="text-sm font-semibold text-[#6c757d]">You are not enrolled in any batch yet.</p>
                <p class="text-xs text-[#9c9fa6] mt-1">Contact your branch admin to get enrolled in a batch.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($enrollments as $e)
                    <div class="bg-white rounded-2xl border border-[#ebedf2] p-5 shadow-sm hover:shadow-md hover:border-[#b66dff] transition-all">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <h3 class="text-sm font-bold text-[#343a40]">{{ $e->batch?->name }}</h3>
                                <p class="text-xs text-[#b66dff] font-semibold">{{ $e->batch?->subject }}</p>
                            </div>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-green-100 text-green-700">Active</span>
                        </div>
                        <div class="space-y-1.5 text-xs text-[#6c757d]">
                            <p>🏛 {{ $e->batch?->branch?->name ?? 'N/A' }}</p>
                            <p>👨‍🏫 {{ $e->batch?->teacher?->name ?? 'Not assigned' }}</p>
                            <p>🕐 {{ trim(($e->batch?->schedule_days ?? '') . ' ' . ($e->batch?->schedule_time ?? '')) ?: 'Schedule not set' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
