<x-app-layout>
    <div class="space-y-6">
        <div>
            <h1 class="text-xl font-bold text-[#343a40]">My Attendance</h1>
            <p class="text-xs text-[#9c9fa6] mt-0.5">Your attendance record — {{ now()->format('F Y') }}</p>
        </div>
        @php
            $records = \App\Models\Attendance::where('student_id', auth()->id())
                ->orderByDesc('attendance_date')->paginate(20);
            $present = \App\Models\Attendance::where('student_id', auth()->id())
                ->where('status', 'present')->count();
            $total = \App\Models\Attendance::where('student_id', auth()->id())->count();
            $rate = $total > 0 ? round(($present / $total) * 100, 1) : 0;
        @endphp

        <div class="grid grid-cols-3 gap-4">
            <div class="bg-white rounded-2xl border border-[#ebedf2] p-4 text-center shadow-sm">
                <p class="text-2xl font-black text-[#b66dff]">{{ $rate }}%</p>
                <p class="text-xs text-[#9c9fa6]">Overall Rate</p>
            </div>
            <div class="bg-white rounded-2xl border border-[#ebedf2] p-4 text-center shadow-sm">
                <p class="text-2xl font-black text-[#00d25b]">{{ $present }}</p>
                <p class="text-xs text-[#9c9fa6]">Days Present</p>
            </div>
            <div class="bg-white rounded-2xl border border-[#ebedf2] p-4 text-center shadow-sm">
                <p class="text-2xl font-black text-[#fc424a]">{{ $total - $present }}</p>
                <p class="text-xs text-[#9c9fa6]">Days Absent</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-[#ebedf2] shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-xs">
                    <thead class="bg-slate-50 border-b border-[#ebedf2]">
                        <tr>
                            <th class="px-5 py-3 text-left font-bold text-[#343a40]">Date</th>
                            <th class="px-5 py-3 text-left font-bold text-[#343a40]">Batch</th>
                            <th class="px-5 py-3 text-left font-bold text-[#343a40]">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#ebedf2]">
                        @forelse($records as $r)
                            <tr class="hover:bg-slate-50/50">
                                <td class="px-5 py-3 text-[#495057]">{{ \Carbon\Carbon::parse($r->attendance_date)->format('d M, Y') }}</td>
                                <td class="px-5 py-3 text-[#495057]">{{ $r->batch?->name ?? '—' }}</td>
                                <td class="px-5 py-3">
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold
                                        {{ $r->status === 'present' ? 'bg-green-100 text-green-700' : ($r->status === 'late' ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-600') }}">
                                        {{ ucfirst($r->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="px-5 py-8 text-center text-[#9c9fa6]">No attendance records found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-5 py-3 border-t border-[#ebedf2]">{{ $records->links() }}</div>
        </div>
    </div>
</x-app-layout>
