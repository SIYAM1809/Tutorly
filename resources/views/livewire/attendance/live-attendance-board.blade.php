<div class="bg-slate-900/80 backdrop-blur-xl border border-slate-800 rounded-2xl p-6 shadow-2xl">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                <span class="relative flex h-3 w-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                </span>
                Real-Time Attendance Board
            </h2>
            <p class="text-xs text-slate-400 mt-1">Live updates broadcasted via Laravel Reverb to connected dashboards</p>
        </div>

        <div class="flex items-center gap-3">
            <select wire:model.live="selectedBatchId" class="bg-slate-800 text-slate-200 border border-slate-700 rounded-xl px-4 py-2 text-xs focus:ring-2 focus:ring-indigo-500">
                @foreach($batches as $batch)
                    <option value="{{ $batch->id }}">{{ $batch->name }} ({{ $batch->subject }})</option>
                @endforeach
            </select>

            <input type="date" wire:model.live="attendanceDate" class="bg-slate-800 text-slate-200 border border-slate-700 rounded-xl px-3 py-2 text-xs">
        </div>
    </div>

    @if($currentBatch)
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-300">
                <thead class="bg-slate-800/50 uppercase text-slate-400 text-[10px] tracking-wider">
                    <tr>
                        <th class="py-3 px-4 rounded-l-lg">Student</th>
                        <th class="py-3 px-4">Roll</th>
                        <th class="py-3 px-4">Current Status</th>
                        <th class="py-3 px-4 rounded-r-lg text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                    @forelse($currentBatch->enrollments as $enrollment)
                        @php
                            $student = $enrollment->student;
                            $status = $attendanceStates[$student->id] ?? 'present';
                        @endphp
                        <tr class="hover:bg-slate-800/30 transition-colors">
                            <td class="py-3.5 px-4 font-medium text-white flex items-center gap-3">
                                <div class="h-8 w-8 rounded-full bg-indigo-600/30 text-indigo-300 flex items-center justify-center font-bold text-xs border border-indigo-500/30">
                                    {{ strtoupper(substr($student->name, 0, 2)) }}
                                </div>
                                <div>
                                    <div>{{ $student->name }}</div>
                                    <div class="text-[10px] text-slate-400">{{ $student->email }}</div>
                                </div>
                            </td>
                            <td class="py-3.5 px-4 text-slate-400">{{ $enrollment->roll_number ?? 'N/A' }}</td>
                            <td class="py-3.5 px-4">
                                @if($status === 'present')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                        Present
                                    </span>
                                @elseif($status === 'absent')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-semibold bg-rose-500/10 text-rose-400 border border-rose-500/20">
                                        Absent
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-semibold bg-amber-500/10 text-amber-400 border border-amber-500/20">
                                        Late
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-right">
                                <div class="inline-flex gap-1 bg-slate-800 p-1 rounded-xl border border-slate-700/60">
                                    <button wire:click="toggleStatus({{ $student->id }}, 'present')" class="px-2.5 py-1 rounded-lg text-[10px] font-bold transition-all {{ $status === 'present' ? 'bg-emerald-600 text-white shadow-md' : 'text-slate-400 hover:text-white' }}">P</button>
                                    <button wire:click="toggleStatus({{ $student->id }}, 'absent')" class="px-2.5 py-1 rounded-lg text-[10px] font-bold transition-all {{ $status === 'absent' ? 'bg-rose-600 text-white shadow-md' : 'text-slate-400 hover:text-white' }}">A</button>
                                    <button wire:click="toggleStatus({{ $student->id }}, 'late')" class="px-2.5 py-1 rounded-lg text-[10px] font-bold transition-all {{ $status === 'late' ? 'bg-amber-600 text-white shadow-md' : 'text-slate-400 hover:text-white' }}">L</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-6 text-center text-slate-500">No students enrolled in this batch.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @else
        <div class="py-8 text-center text-slate-400">Select a batch to begin attendance entry.</div>
    @endif
</div>
