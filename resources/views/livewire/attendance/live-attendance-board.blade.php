<div class="bg-white border border-[#ebedf2] rounded-2xl p-6 shadow-sm">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="text-base font-bold text-[#343a40] flex items-center gap-2">
                <span class="relative flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#00d25b] opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-[#00d25b]"></span>
                </span>
                Real-Time Attendance Board
            </h2>
            <p class="text-xs text-[#9c9fa6] mt-0.5">Live WebSocket broadcast via Laravel Reverb</p>
        </div>

        <div class="flex items-center gap-3">
            <select wire:model.live="selectedBatchId" class="bg-[#f8f9fa] text-[#495057] border border-[#e4e7ea] rounded-xl px-3.5 py-1.5 text-xs focus:ring-2 focus:ring-[#b66dff] focus:outline-none">
                @foreach($batches as $batch)
                    <option value="{{ $batch->id }}">{{ $batch->name }} ({{ $batch->subject }})</option>
                @endforeach
            </select>

            <input type="date" wire:model.live="attendanceDate" class="bg-[#f8f9fa] text-[#495057] border border-[#e4e7ea] rounded-xl px-3 py-1.5 text-xs focus:ring-2 focus:ring-[#b66dff] focus:outline-none">
        </div>
    </div>

    @if($currentBatch)
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-[#495057]">
                <thead class="bg-[#f8f9fa] uppercase text-[#9c9fa6] text-[10px] tracking-wider">
                    <tr>
                        <th class="py-3 px-4 rounded-l-xl font-bold">Student</th>
                        <th class="py-3 px-4 font-bold">Roll</th>
                        <th class="py-3 px-4 font-bold">Status</th>
                        <th class="py-3 px-4 rounded-r-xl text-right font-bold">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#ebedf2]">
                    @forelse($currentBatch->enrollments as $enrollment)
                        @php
                            $student = $enrollment->student;
                            $status = $attendanceStates[$student->id] ?? 'present';
                        @endphp
                        <tr class="hover:bg-purple-50/30 transition-colors">
                            <td class="py-3.5 px-4 font-medium text-[#343a40] flex items-center gap-3">
                                <div class="h-8 w-8 rounded-full bg-purple-100 text-[#b66dff] flex items-center justify-center font-bold text-xs border border-purple-200">
                                    {{ strtoupper(substr($student->name, 0, 2)) }}
                                </div>
                                <div>
                                    <div class="font-bold text-[#343a40]">{{ $student->name }}</div>
                                    <div class="text-[10px] text-[#9c9fa6]">{{ $student->email }}</div>
                                </div>
                            </td>
                            <td class="py-3.5 px-4 text-[#797979]">{{ $enrollment->roll_number ?? 'N/A' }}</td>
                            <td class="py-3.5 px-4">
                                @if($status === 'present')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-[#00d25b]/10 text-[#00d25b] border border-[#00d25b]/20">
                                        Present
                                    </span>
                                @elseif($status === 'absent')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-[#fe7096]/10 text-[#fe7096] border border-[#fe7096]/20">
                                        Absent
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-500/10 text-amber-500 border border-amber-500/20">
                                        Late
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-right">
                                <div class="inline-flex gap-1 bg-[#f8f9fa] p-1 rounded-xl border border-[#e4e7ea]">
                                    <button wire:click="toggleStatus({{ $student->id }}, 'present')" class="px-2.5 py-1 rounded-lg text-[10px] font-bold transition-all {{ $status === 'present' ? 'bg-[#00d25b] text-white shadow-sm' : 'text-[#9c9fa6] hover:text-[#343a40]' }}">P</button>
                                    <button wire:click="toggleStatus({{ $student->id }}, 'absent')" class="px-2.5 py-1 rounded-lg text-[10px] font-bold transition-all {{ $status === 'absent' ? 'bg-[#fe7096] text-white shadow-sm' : 'text-[#9c9fa6] hover:text-[#343a40]' }}">A</button>
                                    <button wire:click="toggleStatus({{ $student->id }}, 'late')" class="px-2.5 py-1 rounded-lg text-[10px] font-bold transition-all {{ $status === 'late' ? 'bg-amber-500 text-white shadow-sm' : 'text-[#9c9fa6] hover:text-[#343a40]' }}">L</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-6 text-center text-[#9c9fa6]">No students enrolled in this batch.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @else
        <div class="py-8 text-center text-[#9c9fa6]">Select a batch to begin attendance entry.</div>
    @endif
</div>
