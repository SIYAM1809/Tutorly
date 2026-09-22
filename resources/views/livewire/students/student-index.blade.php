<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold text-[#343a40]">Student Management</h1>
            <p class="text-xs text-[#9c9fa6] mt-0.5">Multi-branch enrolled student records, attendance histories & performance profiles</p>
        </div>

        <div class="flex items-center gap-3">
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search student name/phone..." class="bg-white text-[#495057] placeholder-[#a7afb7] border border-[#e4e7ea] rounded-xl px-3.5 py-2 text-xs focus:ring-2 focus:ring-[#b66dff] focus:outline-none shadow-xs">

            <select wire:model.live="branchId" class="bg-white text-[#495057] border border-[#e4e7ea] rounded-xl px-3.5 py-2 text-xs focus:ring-2 focus:ring-[#b66dff] focus:outline-none shadow-xs">
                <option value="">All Branches</option>
                @foreach($branches as $b)
                    <option value="{{ $b->id }}">{{ $b->name }}</option>
                @endforeach
            </select>

            <button wire:click="openCreateModal" class="px-4 py-2 bg-[#b66dff] hover:bg-purple-600 text-white rounded-xl text-xs font-semibold shadow-md shadow-purple-500/20 transition-all flex items-center gap-1.5 flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                <span>Enroll Student</span>
            </button>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="p-3.5 bg-[#00d25b]/10 border border-[#00d25b]/30 text-[#00d25b] rounded-xl text-xs flex items-center gap-2">
            <span>✓</span> {{ session('success') }}
        </div>
    @endif

    <div class="bg-white border border-[#ebedf2] rounded-2xl overflow-hidden shadow-sm">
        <table class="w-full text-left text-xs text-[#495057]">
            <thead class="bg-[#f8f9fa] uppercase text-[#9c9fa6] text-[10px] tracking-wider">
                <tr>
                    <th class="py-3.5 px-4 font-bold">Student</th>
                    <th class="py-3.5 px-4 font-bold">Branch</th>
                    <th class="py-3.5 px-4 font-bold">Phone / Guardian</th>
                    <th class="py-3.5 px-4 font-bold">Enrolled Batches</th>
                    <th class="py-3.5 px-4 text-right font-bold">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#ebedf2]">
                @forelse($students as $st)
                    <tr class="hover:bg-purple-50/30 transition-colors">
                        <td class="py-3.5 px-4 font-medium text-[#343a40] flex items-center gap-3">
                            <div class="h-9 w-9 rounded-full bg-purple-100 text-[#b66dff] flex items-center justify-center font-bold text-xs border border-purple-200 shadow-xs">
                                {{ strtoupper(substr($st->name, 0, 2)) }}
                            </div>
                            <div>
                                <div class="font-bold text-[#343a40]">{{ $st->name }}</div>
                                <div class="text-[10px] text-[#9c9fa6]">{{ $st->email }}</div>
                            </div>
                        </td>
                        <td class="py-3.5 px-4">
                            <span class="inline-flex px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-purple-50 text-[#b66dff] border border-purple-200">
                                {{ $st->branch->name ?? 'Main Branch' }}
                            </span>
                        </td>
                        <td class="py-3.5 px-4 text-[#797979]">
                            <div>{{ $st->phone ?? 'N/A' }}</div>
                            <div class="text-[10px] text-[#9c9fa6]">Guardian: {{ $st->guardian_phone ?? 'N/A' }}</div>
                        </td>
                        <td class="py-3.5 px-4">
                            @foreach($st->enrollments as $enr)
                                <span class="inline-block bg-[#f8f9fa] text-[#495057] px-2 py-0.5 rounded text-[10px] border border-[#e4e7ea] mr-1 mb-1 font-medium">
                                    {{ $enr->batch->name ?? 'Batch' }}
                                </span>
                            @endforeach
                        </td>
                        <td class="py-3.5 px-4 text-right">
                            <button wire:click="viewStudentProfile({{ $st->id }})" class="px-3 py-1 bg-purple-50 text-[#b66dff] hover:bg-[#b66dff] hover:text-white rounded-lg text-xs font-semibold transition-all">
                                View Profile →
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-[#9c9fa6]">No student records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-4 border-t border-[#ebedf2]">
            {{ $students->links() }}
        </div>
    </div>

    <!-- STUDENT PROFILE SLIDE-OVER / MODAL (Light Theme) -->
    @if($showProfileModal && $profileStudent)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-xs">
            <div class="bg-white border border-[#ebedf2] rounded-2xl max-w-2xl w-full p-6 shadow-2xl space-y-5 max-h-[90vh] overflow-y-auto">
                <div class="flex items-center justify-between border-b border-[#ebedf2] pb-4">
                    <div class="flex items-center gap-3">
                        <div class="h-12 w-12 rounded-full bg-gradient-to-tr from-[#b66dff] to-[#6c5ce7] text-white flex items-center justify-center font-bold text-base shadow-md shadow-purple-500/20">
                            {{ strtoupper(substr($profileStudent->name, 0, 2)) }}
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-[#343a40]">{{ $profileStudent->name }}</h3>
                            <p class="text-xs text-[#b66dff]">{{ $profileStudent->email }} · {{ $profileStudent->phone }}</p>
                        </div>
                    </div>
                    <button wire:click="closeProfile" class="text-[#9c9fa6] hover:text-[#343a40] text-xl font-bold p-1">✕</button>
                </div>

                <!-- Info Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 text-xs">
                    <div class="bg-[#f8f9fa] p-3 rounded-xl border border-[#e4e7ea]">
                        <span class="text-[#9c9fa6] block text-[10px] uppercase font-bold">Branch</span>
                        <span class="font-semibold text-[#343a40]">{{ $profileStudent->branch->name ?? 'Main Campus' }}</span>
                    </div>
                    <div class="bg-[#f8f9fa] p-3 rounded-xl border border-[#e4e7ea]">
                        <span class="text-[#9c9fa6] block text-[10px] uppercase font-bold">Guardian Phone</span>
                        <span class="font-semibold text-[#343a40]">{{ $profileStudent->guardian_phone ?? 'N/A' }}</span>
                    </div>
                    <div class="bg-[#f8f9fa] p-3 rounded-xl border border-[#e4e7ea]">
                        <span class="text-[#9c9fa6] block text-[10px] uppercase font-bold">Enrolled Batches</span>
                        <span class="font-semibold text-[#b66dff]">{{ $profileStudent->enrollments->count() }} active</span>
                    </div>
                </div>

                <!-- AI Insight Snapshot -->
                @if($profileStudent->aiInsights->isNotEmpty())
                    @php $ai = $profileStudent->aiInsights->first(); @endphp
                    <div class="p-3.5 rounded-xl border {{ $ai->risk_level === 'HIGH' ? 'bg-[#fe7096]/10 border-[#fe7096]/30 text-[#fe7096]' : 'bg-[#00d25b]/10 border-[#00d25b]/30 text-[#00d25b]' }} text-xs space-y-1">
                        <div class="flex items-center justify-between font-bold text-[10px] uppercase tracking-wider">
                            <span>🤖 Gemini AI Insight Snapshot</span>
                            <span class="font-mono">{{ $ai->risk_level }} RISK</span>
                        </div>
                        <p class="text-[#343a40] text-xs">{{ $ai->summary_text }}</p>
                    </div>
                @endif

                <!-- Recent Attendance History -->
                <div class="space-y-2">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-[#9c9fa6]">Recent Attendance (Last 10 Days)</h4>
                    <div class="flex flex-wrap gap-2">
                        @forelse($profileStudent->attendances as $att)
                            <div class="px-2.5 py-1 rounded-lg border text-[11px] font-semibold flex items-center gap-1.5 {{ $att->status === 'present' ? 'bg-[#00d25b]/10 border-[#00d25b]/30 text-[#00d25b]' : ($att->status === 'late' ? 'bg-amber-500/10 border-amber-500/30 text-amber-500' : 'bg-[#fe7096]/10 border-[#fe7096]/30 text-[#fe7096]') }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $att->status === 'present' ? 'bg-[#00d25b]' : ($att->status === 'late' ? 'bg-amber-500' : 'bg-[#fe7096]') }}"></span>
                                <span>{{ $att->attendance_date ? \Carbon\Carbon::parse($att->attendance_date)->format('M d') : 'Date' }}</span>
                                <span class="uppercase text-[9px]">({{ $att->status }})</span>
                            </div>
                        @empty
                            <p class="text-xs text-[#9c9fa6]">No attendance marked yet.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Recent Invoices -->
                <div class="space-y-2">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-[#9c9fa6]">Recent Invoices</h4>
                    <div class="space-y-1.5">
                        @forelse($profileStudent->fees as $fee)
                            <div class="p-2.5 rounded-xl bg-[#f8f9fa] border border-[#e4e7ea] flex items-center justify-between text-xs">
                                <div>
                                    <span class="font-bold text-[#343a40]">{{ $fee->title }}</span>
                                    <span class="text-[#9c9fa6] block text-[10px]">Due: {{ $fee->due_date ? $fee->due_date->format('M d, Y') : 'N/A' }}</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="font-mono font-bold text-[#343a40]">৳{{ number_format($fee->amount, 2) }}</span>
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase {{ $fee->status === 'paid' ? 'bg-[#00d25b]/10 text-[#00d25b]' : 'bg-amber-500/10 text-amber-500' }}">
                                        {{ $fee->status }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <p class="text-xs text-[#9c9fa6]">No fee records found.</p>
                        @endforelse
                    </div>
                </div>

                <div class="pt-3 border-t border-[#ebedf2] flex justify-end">
                    <button wire:click="closeProfile" class="px-5 py-2 bg-slate-100 hover:bg-slate-200 text-[#343a40] rounded-xl text-xs font-semibold transition-colors">Close</button>
                </div>
            </div>
        </div>
    @endif

    <!-- ENROLL NEW STUDENT MODAL (Light Theme) -->
    @if($showCreateModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-xs">
            <div class="bg-white border border-[#ebedf2] rounded-2xl max-w-md w-full p-6 shadow-2xl space-y-4">
                <div class="flex items-center justify-between border-b border-[#ebedf2] pb-3">
                    <h3 class="text-base font-bold text-[#343a40]">Enroll New Student</h3>
                    <button wire:click="$set('showCreateModal', false)" class="text-[#9c9fa6] hover:text-[#343a40]">✕</button>
                </div>

                <form wire:submit="enrollStudent" class="space-y-3.5">
                    <div>
                        <label class="block text-[11px] font-semibold text-[#495057] uppercase mb-1">Student Full Name</label>
                        <input type="text" wire:model="newName" class="w-full bg-[#f8f9fa] border border-[#e4e7ea] rounded-xl px-3.5 py-2 text-xs text-[#343a40] focus:ring-2 focus:ring-[#b66dff] focus:outline-none">
                        @error('newName') <span class="text-rose-500 text-[10px]">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-[11px] font-semibold text-[#495057] uppercase mb-1">Email Address</label>
                        <input type="email" wire:model="newEmail" class="w-full bg-[#f8f9fa] border border-[#e4e7ea] rounded-xl px-3.5 py-2 text-xs text-[#343a40] focus:ring-2 focus:ring-[#b66dff] focus:outline-none">
                        @error('newEmail') <span class="text-rose-500 text-[10px]">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[11px] font-semibold text-[#495057] uppercase mb-1">Student Phone</label>
                            <input type="text" wire:model="newPhone" placeholder="+88017..." class="w-full bg-[#f8f9fa] border border-[#e4e7ea] rounded-xl px-3.5 py-2 text-xs text-[#343a40] focus:ring-2 focus:ring-[#b66dff] focus:outline-none">
                            @error('newPhone') <span class="text-rose-500 text-[10px]">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-[#495057] uppercase mb-1">Guardian Phone (WhatsApp)</label>
                            <input type="text" wire:model="newGuardianPhone" placeholder="+88018..." class="w-full bg-[#f8f9fa] border border-[#e4e7ea] rounded-xl px-3.5 py-2 text-xs text-[#343a40] focus:ring-2 focus:ring-[#b66dff] focus:outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[11px] font-semibold text-[#495057] uppercase mb-1">Branch</label>
                            <select wire:model="newBranchId" class="w-full bg-[#f8f9fa] border border-[#e4e7ea] rounded-xl px-3 py-2 text-xs text-[#343a40] focus:ring-2 focus:ring-[#b66dff] focus:outline-none">
                                @foreach($branches as $b)
                                    <option value="{{ $b->id }}">{{ $b->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-[#495057] uppercase mb-1">Initial Batch</label>
                            <select wire:model="newBatchId" class="w-full bg-[#f8f9fa] border border-[#e4e7ea] rounded-xl px-3 py-2 text-xs text-[#343a40] focus:ring-2 focus:ring-[#b66dff] focus:outline-none">
                                <option value="">Select Batch</option>
                                @foreach($batches as $bt)
                                    <option value="{{ $bt->id }}">{{ $bt->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="pt-3 flex items-center justify-end gap-2 border-t border-[#ebedf2]">
                        <button type="button" wire:click="$set('showCreateModal', false)" class="px-4 py-2 text-xs font-semibold text-[#9c9fa6] hover:text-[#343a40]">Cancel</button>
                        <button type="submit" class="px-5 py-2 bg-[#b66dff] hover:bg-purple-600 text-white rounded-xl text-xs font-semibold shadow-md shadow-purple-500/20">Enroll Student</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
