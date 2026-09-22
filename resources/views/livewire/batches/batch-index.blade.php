<div class="space-y-6">
    <!-- Header with Search, Filter & Add Button -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold text-[#343a40]">Batches & Course Management</h1>
            <p class="text-xs text-[#9c9fa6] mt-0.5">Manage coaching batches, subject schedules, and faculty assignments</p>
        </div>

        <div class="flex items-center gap-3">
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search batch or subject..." class="bg-white text-[#495057] placeholder-[#a7afb7] border border-[#e4e7ea] rounded-xl px-3.5 py-2 text-xs focus:ring-2 focus:ring-[#b66dff] focus:outline-none shadow-xs">

            <select wire:model.live="branchId" class="bg-white text-[#495057] border border-[#e4e7ea] rounded-xl px-3.5 py-2 text-xs focus:ring-2 focus:ring-[#b66dff] focus:outline-none shadow-xs">
                <option value="">All Branches</option>
                @foreach($branches as $b)
                    <option value="{{ $b->id }}">{{ $b->name }}</option>
                @endforeach
            </select>

            <button wire:click="openCreateModal" class="px-4 py-2 bg-[#b66dff] hover:bg-purple-600 text-white rounded-xl text-xs font-semibold shadow-md shadow-purple-500/20 transition-all flex items-center gap-1.5 flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>New Batch</span>
            </button>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="p-3.5 bg-[#00d25b]/10 border border-[#00d25b]/30 text-[#00d25b] rounded-xl text-xs flex items-center gap-2">
            <span>✓</span> {{ session('success') }}
        </div>
    @endif

    <!-- Batches Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse($batches as $batch)
            <div class="bg-white border border-[#ebedf2] rounded-2xl p-5 shadow-sm hover:border-[#b66dff]/40 hover:shadow-md transition-all flex flex-col justify-between space-y-4">
                <div>
                    <div class="flex items-center justify-between gap-2 mb-2">
                        <span class="inline-flex px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-purple-50 text-[#b66dff] border border-purple-200">
                            {{ $batch->branch->name ?? 'Main Branch' }}
                        </span>
                        <span class="text-[10px] font-bold text-[#9c9fa6]">
                            {{ $batch->enrollments->count() }} Students
                        </span>
                    </div>

                    <h3 class="text-base font-bold text-[#343a40]">{{ $batch->name }}</h3>
                    <p class="text-xs text-[#b66dff] font-medium mt-0.5">{{ $batch->subject }}</p>

                    <div class="mt-4 pt-3 border-t border-[#ebedf2] space-y-2 text-xs text-[#495057]">
                        <div class="flex items-center gap-2">
                            <span class="text-[#9c9fa6] text-[11px]">Instructor:</span>
                            <span class="font-semibold text-[#343a40]">{{ $batch->teacher->name ?? 'Unassigned' }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-[#9c9fa6] text-[11px]">Schedule:</span>
                            <span class="text-[#797979]">{{ $batch->schedule ?? 'Flexible' }}</span>
                        </div>
                    </div>
                </div>

                <div class="pt-3 border-t border-[#ebedf2] flex items-center justify-between text-xs">
                    <a href="{{ route('attendance.index') }}" class="text-[#b66dff] hover:text-purple-700 font-semibold text-[11px]">
                        Mark Attendance →
                    </a>
                    <a href="{{ route('students.index') }}" class="text-[#9c9fa6] hover:text-[#343a40] text-[11px]">
                        View Students
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-3 py-12 text-center text-[#9c9fa6] text-xs">
                No batches found matching your filters. Click <strong>"New Batch"</strong> to add one.
            </div>
        @endforelse
    </div>

    <div>
        {{ $batches->links() }}
    </div>

    <!-- Create Batch Modal -->
    @if($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-xs">
            <div class="bg-white border border-[#ebedf2] rounded-2xl max-w-md w-full p-6 shadow-2xl space-y-4">
                <div class="flex items-center justify-between border-b border-[#ebedf2] pb-3">
                    <h3 class="text-base font-bold text-[#343a40]">Create New Batch</h3>
                    <button wire:click="$set('showModal', false)" class="text-[#9c9fa6] hover:text-[#343a40]">✕</button>
                </div>

                <form wire:submit="createBatch" class="space-y-3.5">
                    <div>
                        <label class="block text-[11px] font-semibold text-[#495057] uppercase mb-1">Batch Name</label>
                        <input type="text" wire:model="name" placeholder="e.g. HSC Physics Master Batch 2026" class="w-full bg-[#f8f9fa] border border-[#e4e7ea] rounded-xl px-3.5 py-2 text-xs text-[#343a40] focus:ring-2 focus:ring-[#b66dff] focus:outline-none">
                        @error('name') <span class="text-rose-500 text-[10px]">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-[11px] font-semibold text-[#495057] uppercase mb-1">Subject</label>
                        <input type="text" wire:model="subject" placeholder="e.g. Physics 1st Paper" class="w-full bg-[#f8f9fa] border border-[#e4e7ea] rounded-xl px-3.5 py-2 text-xs text-[#343a40] focus:ring-2 focus:ring-[#b66dff] focus:outline-none">
                        @error('subject') <span class="text-rose-500 text-[10px]">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-[11px] font-semibold text-[#495057] uppercase mb-1">Schedule</label>
                        <input type="text" wire:model="schedule" placeholder="e.g. Sun, Tue, Thu 04:00 PM" class="w-full bg-[#f8f9fa] border border-[#e4e7ea] rounded-xl px-3.5 py-2 text-xs text-[#343a40] focus:ring-2 focus:ring-[#b66dff] focus:outline-none">
                        @error('schedule') <span class="text-rose-500 text-[10px]">{{ $message }}</span> @enderror
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
                            <label class="block text-[11px] font-semibold text-[#495057] uppercase mb-1">Instructor</label>
                            <select wire:model="selectedTeacherId" class="w-full bg-[#f8f9fa] border border-[#e4e7ea] rounded-xl px-3 py-2 text-xs text-[#343a40] focus:ring-2 focus:ring-[#b66dff] focus:outline-none">
                                <option value="">Select Instructor</option>
                                @foreach($teachers as $t)
                                    <option value="{{ $t->id }}">{{ $t->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="pt-3 flex items-center justify-end gap-2 border-t border-[#ebedf2]">
                        <button type="button" wire:click="$set('showModal', false)" class="px-4 py-2 text-xs font-semibold text-[#9c9fa6] hover:text-[#343a40]">Cancel</button>
                        <button type="submit" class="px-5 py-2 bg-[#b66dff] hover:bg-purple-600 text-white rounded-xl text-xs font-semibold shadow-md shadow-purple-500/20">Save Batch</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
