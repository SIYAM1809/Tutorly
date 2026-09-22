<div class="space-y-6">
    <!-- Header with Tabs and Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold text-[#343a40]">Exams & Certificates</h1>
            <p class="text-xs text-[#9c9fa6] mt-0.5">Schedule model tests, track batch exams, and issue course completion certificates</p>
        </div>

        <div class="flex items-center gap-3">
            <!-- Tab Switcher -->
            <div class="bg-white p-1 rounded-xl border border-[#ebedf2] flex items-center text-xs shadow-xs">
                <button wire:click="$set('tab', 'exams')" class="px-3.5 py-1.5 rounded-lg font-semibold transition-all {{ $tab === 'exams' ? 'bg-[#b66dff] text-white shadow-xs' : 'text-[#9c9fa6] hover:text-[#343a40]' }}">
                    Exams List
                </button>
                <button wire:click="$set('tab', 'certificates')" class="px-3.5 py-1.5 rounded-lg font-semibold transition-all {{ $tab === 'certificates' ? 'bg-[#b66dff] text-white shadow-xs' : 'text-[#9c9fa6] hover:text-[#343a40]' }}">
                    Certificates
                </button>
            </div>

            @if($tab === 'exams')
                <button wire:click="openExamModal" class="px-4 py-2 bg-[#b66dff] hover:bg-purple-600 text-white rounded-xl text-xs font-semibold shadow-md shadow-purple-500/20 transition-all flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    <span>Schedule Exam</span>
                </button>
            @else
                <button wire:click="openCertModal" class="px-4 py-2 bg-[#00d25b] hover:bg-emerald-600 text-white rounded-xl text-xs font-semibold shadow-md shadow-emerald-500/20 transition-all flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    <span>Issue Certificate</span>
                </button>
            @endif
        </div>
    </div>

    @if (session()->has('success'))
        <div class="p-3.5 bg-[#00d25b]/10 border border-[#00d25b]/30 text-[#00d25b] rounded-xl text-xs flex items-center gap-2">
            <span>✓</span> {{ session('success') }}
        </div>
    @endif

    <!-- TAB 1: EXAMS LIST -->
    @if($tab === 'exams')
        <div class="bg-white border border-[#ebedf2] rounded-2xl overflow-hidden shadow-sm">
            <table class="w-full text-left text-xs text-[#495057]">
                <thead class="bg-[#f8f9fa] uppercase text-[#9c9fa6] text-[10px] tracking-wider">
                    <tr>
                        <th class="py-3.5 px-4 font-bold">Exam Title</th>
                        <th class="py-3.5 px-4 font-bold">Batch & Branch</th>
                        <th class="py-3.5 px-4 font-bold">Total Marks</th>
                        <th class="py-3.5 px-4 font-bold">Pass Marks</th>
                        <th class="py-3.5 px-4 font-bold">Exam Date</th>
                        <th class="py-3.5 px-4 text-right font-bold">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#ebedf2]">
                    @forelse($exams as $exam)
                        <tr class="hover:bg-purple-50/30 transition-colors">
                            <td class="py-3.5 px-4 font-bold text-[#343a40]">
                                {{ $exam->title }}
                            </td>
                            <td class="py-3.5 px-4">
                                <div class="font-semibold text-[#343a40]">{{ $exam->batch->name ?? 'Batch' }}</div>
                                <div class="text-[10px] text-[#9c9fa6]">{{ $exam->batch->branch->name ?? 'Main Branch' }}</div>
                            </td>
                            <td class="py-3.5 px-4 font-mono font-bold text-[#b66dff]">
                                {{ number_format($exam->total_marks, 0) }} pts
                            </td>
                            <td class="py-3.5 px-4 font-mono text-[#797979]">
                                {{ number_format($exam->pass_marks, 0) }} pts
                            </td>
                            <td class="py-3.5 px-4 text-[#343a40]">
                                {{ $exam->exam_date ? $exam->exam_date->format('M d, Y') : 'N/A' }}
                            </td>
                            <td class="py-3.5 px-4 text-right">
                                <span class="inline-flex px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-[#00d25b]/10 text-[#00d25b] border border-[#00d25b]/20">
                                    Scheduled
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-[#9c9fa6]">No exams scheduled yet. Click "Schedule Exam" to create one.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="p-4 border-t border-[#ebedf2]">
                {{ $exams->links() }}
            </div>
        </div>
    @endif

    <!-- TAB 2: CERTIFICATES -->
    @if($tab === 'certificates')
        <div class="bg-white border border-[#ebedf2] rounded-2xl overflow-hidden shadow-sm">
            <table class="w-full text-left text-xs text-[#495057]">
                <thead class="bg-[#f8f9fa] uppercase text-[#9c9fa6] text-[10px] tracking-wider">
                    <tr>
                        <th class="py-3.5 px-4 font-bold">Certificate No.</th>
                        <th class="py-3.5 px-4 font-bold">Student</th>
                        <th class="py-3.5 px-4 font-bold">Course / Batch</th>
                        <th class="py-3.5 px-4 font-bold">Issue Date</th>
                        <th class="py-3.5 px-4 text-right font-bold">Verification</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#ebedf2]">
                    @forelse($certificates as $cert)
                        <tr class="hover:bg-purple-50/30 transition-colors">
                            <td class="py-3.5 px-4 font-mono font-bold text-[#b66dff]">
                                {{ $cert->certificate_number }}
                            </td>
                            <td class="py-3.5 px-4">
                                <div class="font-bold text-[#343a40]">{{ $cert->student->name ?? 'Student' }}</div>
                                <div class="text-[10px] text-[#9c9fa6]">{{ $cert->student->email ?? '' }}</div>
                            </td>
                            <td class="py-3.5 px-4">
                                <div class="font-semibold text-[#343a40]">{{ $cert->batch->name ?? 'Batch' }}</div>
                                <div class="text-[10px] text-[#b66dff]">{{ $cert->batch->subject ?? '' }}</div>
                            </td>
                            <td class="py-3.5 px-4 text-[#797979]">
                                {{ $cert->issued_at ? $cert->issued_at->format('M d, Y') : 'N/A' }}
                            </td>
                            <td class="py-3.5 px-4 text-right">
                                <span class="inline-flex px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-purple-50 text-[#b66dff] border border-purple-200 font-mono">
                                    SHA256: {{ substr($cert->verification_hash, 0, 8) }}...
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-[#9c9fa6]">No certificates issued yet. Click "Issue Certificate" to generate one.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="p-4 border-t border-[#ebedf2]">
                {{ $certificates->links() }}
            </div>
        </div>
    @endif

    <!-- Create Exam Modal -->
    @if($showExamModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-xs">
            <div class="bg-white border border-[#ebedf2] rounded-2xl max-w-md w-full p-6 shadow-2xl space-y-4">
                <div class="flex items-center justify-between border-b border-[#ebedf2] pb-3">
                    <h3 class="text-base font-bold text-[#343a40]">Schedule New Exam</h3>
                    <button wire:click="$set('showExamModal', false)" class="text-[#9c9fa6] hover:text-[#343a40]">✕</button>
                </div>

                <form wire:submit="createExam" class="space-y-3.5">
                    <div>
                        <label class="block text-[11px] font-semibold text-[#495057] uppercase mb-1">Exam Title</label>
                        <input type="text" wire:model="examTitle" placeholder="e.g. Physics Midterm Model Test 2026" class="w-full bg-[#f8f9fa] border border-[#e4e7ea] rounded-xl px-3.5 py-2 text-xs text-[#343a40] focus:ring-2 focus:ring-[#b66dff] focus:outline-none">
                        @error('examTitle') <span class="text-rose-500 text-[10px]">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[11px] font-semibold text-[#495057] uppercase mb-1">Branch</label>
                            <select wire:model="selectedBranchId" class="w-full bg-[#f8f9fa] border border-[#e4e7ea] rounded-xl px-3 py-2 text-xs text-[#343a40] focus:ring-2 focus:ring-[#b66dff] focus:outline-none">
                                @foreach($branches as $b)
                                    <option value="{{ $b->id }}">{{ $b->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-[#495057] uppercase mb-1">Batch</label>
                            <select wire:model="selectedBatchId" class="w-full bg-[#f8f9fa] border border-[#e4e7ea] rounded-xl px-3 py-2 text-xs text-[#343a40] focus:ring-2 focus:ring-[#b66dff] focus:outline-none">
                                @foreach($batches as $bt)
                                    <option value="{{ $bt->id }}">{{ $bt->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-3">
                        <div>
                            <label class="block text-[11px] font-semibold text-[#495057] uppercase mb-1">Total Marks</label>
                            <input type="number" wire:model="totalMarks" class="w-full bg-[#f8f9fa] border border-[#e4e7ea] rounded-xl px-3 py-2 text-xs text-[#343a40] focus:ring-2 focus:ring-[#b66dff] focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-[#495057] uppercase mb-1">Pass Marks</label>
                            <input type="number" wire:model="passMarks" class="w-full bg-[#f8f9fa] border border-[#e4e7ea] rounded-xl px-3 py-2 text-xs text-[#343a40] focus:ring-2 focus:ring-[#b66dff] focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-[#495057] uppercase mb-1">Date</label>
                            <input type="date" wire:model="examDate" class="w-full bg-[#f8f9fa] border border-[#e4e7ea] rounded-xl px-3 py-2 text-xs text-[#343a40] focus:ring-2 focus:ring-[#b66dff] focus:outline-none">
                        </div>
                    </div>

                    <div class="pt-3 flex items-center justify-end gap-2 border-t border-[#ebedf2]">
                        <button type="button" wire:click="$set('showExamModal', false)" class="px-4 py-2 text-xs font-semibold text-[#9c9fa6] hover:text-[#343a40]">Cancel</button>
                        <button type="submit" class="px-5 py-2 bg-[#b66dff] hover:bg-purple-600 text-white rounded-xl text-xs font-semibold shadow-md shadow-purple-500/20">Schedule Exam</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Issue Certificate Modal -->
    @if($showCertModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-xs">
            <div class="bg-white border border-[#ebedf2] rounded-2xl max-w-md w-full p-6 shadow-2xl space-y-4">
                <div class="flex items-center justify-between border-b border-[#ebedf2] pb-3">
                    <h3 class="text-base font-bold text-[#343a40]">Issue Course Certificate</h3>
                    <button wire:click="$set('showCertModal', false)" class="text-[#9c9fa6] hover:text-[#343a40]">✕</button>
                </div>

                <form wire:submit="issueCertificate" class="space-y-3.5">
                    <div>
                        <label class="block text-[11px] font-semibold text-[#495057] uppercase mb-1">Student</label>
                        <select wire:model="certStudentId" class="w-full bg-[#f8f9fa] border border-[#e4e7ea] rounded-xl px-3 py-2 text-xs text-[#343a40] focus:ring-2 focus:ring-[#b66dff] focus:outline-none">
                            @foreach($students as $st)
                                <option value="{{ $st->id }}">{{ $st->name }} ({{ $st->email }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-[11px] font-semibold text-[#495057] uppercase mb-1">Completed Course / Batch</label>
                        <select wire:model="certBatchId" class="w-full bg-[#f8f9fa] border border-[#e4e7ea] rounded-xl px-3 py-2 text-xs text-[#343a40] focus:ring-2 focus:ring-[#b66dff] focus:outline-none">
                            @foreach($batches as $bt)
                                <option value="{{ $bt->id }}">{{ $bt->name }} — {{ $bt->subject }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="pt-3 flex items-center justify-end gap-2 border-t border-[#ebedf2]">
                        <button type="button" wire:click="$set('showCertModal', false)" class="px-4 py-2 text-xs font-semibold text-[#9c9fa6] hover:text-[#343a40]">Cancel</button>
                        <button type="submit" class="px-5 py-2 bg-[#00d25b] hover:bg-emerald-600 text-white rounded-xl text-xs font-semibold shadow-md shadow-emerald-500/20">Issue Certificate</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
