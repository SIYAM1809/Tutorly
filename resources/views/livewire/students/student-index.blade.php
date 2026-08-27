<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-white">Student Management</h1>
            <p class="text-xs text-slate-400 mt-1">Multi-branch enrolled student records and academic performance</p>
        </div>

        <div class="flex items-center gap-3">
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search student name/phone..." class="bg-slate-800 text-slate-200 border border-slate-700 rounded-xl px-3.5 py-2 text-xs focus:ring-2 focus:ring-indigo-500">

            <select wire:model.live="branchId" class="bg-slate-800 text-slate-200 border border-slate-700 rounded-xl px-3.5 py-2 text-xs">
                <option value="">All Branches</option>
                @foreach($branches as $b)
                    <option value="{{ $b->id }}">{{ $b->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="bg-slate-900/80 backdrop-blur-xl border border-slate-800 rounded-2xl overflow-hidden shadow-2xl">
        <table class="w-full text-left text-xs text-slate-300">
            <thead class="bg-slate-800/60 uppercase text-slate-400 text-[10px] tracking-wider">
                <tr>
                    <th class="py-3.5 px-4">Student</th>
                    <th class="py-3.5 px-4">Branch</th>
                    <th class="py-3.5 px-4">Phone / Guardian</th>
                    <th class="py-3.5 px-4">Enrolled Batches</th>
                    <th class="py-3.5 px-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800">
                @forelse($students as $st)
                    <tr class="hover:bg-slate-800/40 transition-colors">
                        <td class="py-3.5 px-4 font-medium text-white flex items-center gap-3">
                            <div class="h-9 w-9 rounded-full bg-indigo-600/30 text-indigo-300 flex items-center justify-center font-bold text-xs border border-indigo-500/30">
                                {{ strtoupper(substr($st->name, 0, 2)) }}
                            </div>
                            <div>
                                <div class="font-bold">{{ $st->name }}</div>
                                <div class="text-[10px] text-slate-400">{{ $st->email }}</div>
                            </div>
                        </td>
                        <td class="py-3.5 px-4">
                            <span class="inline-flex px-2.5 py-1 rounded-full text-[10px] font-semibold bg-indigo-500/10 text-indigo-400 border border-indigo-500/20">
                                {{ $st->branch->name ?? 'Main Branch' }}
                            </span>
                        </td>
                        <td class="py-3.5 px-4">
                            <div>{{ $st->phone ?? 'N/A' }}</div>
                            <div class="text-[10px] text-slate-400">Guardian: {{ $st->guardian_phone ?? 'N/A' }}</div>
                        </td>
                        <td class="py-3.5 px-4">
                            @foreach($st->enrollments as $enr)
                                <span class="inline-block bg-slate-800 text-slate-300 px-2 py-0.5 rounded text-[10px] border border-slate-700 mr-1 mb-1">
                                    {{ $enr->batch->name ?? 'Batch' }}
                                </span>
                            @endforeach
                        </td>
                        <td class="py-3.5 px-4 text-right">
                            <button class="px-3 py-1 bg-indigo-600/20 text-indigo-400 hover:bg-indigo-600 hover:text-white rounded-lg text-xs font-semibold transition-all">
                                View Profile
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-slate-500">No student records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-4 border-t border-slate-800">
            {{ $students->links() }}
        </div>
    </div>
</div>
