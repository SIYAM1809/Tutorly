<div class="space-y-6">
    <!-- Header with Search, Filter & Generate Invoice Button -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold text-[#343a40]">Fee Management & Billing</h1>
            <p class="text-xs text-[#9c9fa6] mt-0.5">Track tuition payments, generate fee invoices, and collect via SSLCommerz</p>
        </div>

        <div class="flex items-center gap-3">
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search student or invoice..." class="bg-white text-[#495057] placeholder-[#a7afb7] border border-[#e4e7ea] rounded-xl px-3.5 py-2 text-xs focus:ring-2 focus:ring-[#b66dff] focus:outline-none shadow-xs">

            <select wire:model.live="status" class="bg-white text-[#495057] border border-[#e4e7ea] rounded-xl px-3.5 py-2 text-xs focus:ring-2 focus:ring-[#b66dff] focus:outline-none shadow-xs">
                <option value="">All Statuses</option>
                <option value="paid">Paid</option>
                <option value="pending">Pending</option>
                <option value="overdue">Overdue</option>
            </select>

            <button wire:click="openCreateModal" class="px-4 py-2 bg-[#b66dff] hover:bg-purple-600 text-white rounded-xl text-xs font-semibold shadow-md shadow-purple-500/20 transition-all flex items-center gap-1.5 flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>New Invoice</span>
            </button>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="p-3.5 bg-[#00d25b]/10 border border-[#00d25b]/30 text-[#00d25b] rounded-xl text-xs flex items-center gap-2">
            <span>✓</span> {{ session('success') }}
        </div>
    @endif

    <!-- Fee Invoices Table -->
    <div class="bg-white border border-[#ebedf2] rounded-2xl overflow-hidden shadow-sm">
        <table class="w-full text-left text-xs text-[#495057]">
            <thead class="bg-[#f8f9fa] uppercase text-[#9c9fa6] text-[10px] tracking-wider">
                <tr>
                    <th class="py-3.5 px-4 font-bold">Invoice / Title</th>
                    <th class="py-3.5 px-4 font-bold">Student & Branch</th>
                    <th class="py-3.5 px-4 font-bold">Amount (BDT)</th>
                    <th class="py-3.5 px-4 font-bold">Due Date</th>
                    <th class="py-3.5 px-4 font-bold">Status</th>
                    <th class="py-3.5 px-4 text-right font-bold">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#ebedf2]">
                @forelse($fees as $fee)
                    <tr class="hover:bg-purple-50/30 transition-colors">
                        <td class="py-3.5 px-4 font-medium text-[#343a40]">
                            <div class="font-bold text-[#343a40]">#INV-{{ str_pad($fee->id, 5, '0', STR_PAD_LEFT) }}</div>
                            <div class="text-[10px] text-[#b66dff]">{{ $fee->title }}</div>
                        </td>
                        <td class="py-3.5 px-4">
                            <div class="font-semibold text-[#343a40]">{{ $fee->student->name ?? 'Student' }}</div>
                            <div class="text-[10px] text-[#9c9fa6]">{{ $fee->branch->name ?? 'Main Branch' }} · {{ $fee->batch->name ?? 'Batch' }}</div>
                        </td>
                        <td class="py-3.5 px-4 font-mono font-bold text-[#343a40]">
                            ৳{{ number_format($fee->amount, 2) }}
                        </td>
                        <td class="py-3.5 px-4 text-[#797979]">
                            {{ $fee->due_date ? $fee->due_date->format('M d, Y') : 'N/A' }}
                        </td>
                        <td class="py-3.5 px-4">
                            @if($fee->status === 'paid')
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-[#00d25b]/10 text-[#00d25b] border border-[#00d25b]/20">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#00d25b]"></span> Paid
                                </span>
                            @elseif($fee->status === 'overdue')
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-[#fe7096]/10 text-[#fe7096] border border-[#fe7096]/20">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#fe7096]"></span> Overdue
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-500/10 text-amber-500 border border-amber-500/20">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Pending
                                </span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-right space-x-2">
                            @if($fee->status !== 'paid')
                                <a href="{{ route('payment.pay', $fee->id) }}" class="inline-flex px-3 py-1 bg-[#00d25b] hover:bg-emerald-600 text-white rounded-lg text-xs font-semibold shadow-sm transition-all">
                                    💳 Pay via SSLCommerz
                                </a>
                                <button wire:click="markAsPaid({{ $fee->id }})" class="px-2.5 py-1 bg-slate-100 hover:bg-slate-200 text-[#495057] rounded-lg text-xs font-semibold transition-all">
                                    Mark Paid
                                </button>
                            @else
                                <span class="text-[11px] font-semibold text-[#00d25b]">✓ Settled</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-[#9c9fa6]">No fee invoices found. Click "New Invoice" to generate one.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-4 border-t border-[#ebedf2]">
            {{ $fees->links() }}
        </div>
    </div>

    <!-- Create Invoice Modal -->
    @if($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-xs">
            <div class="bg-white border border-[#ebedf2] rounded-2xl max-w-md w-full p-6 shadow-2xl space-y-4">
                <div class="flex items-center justify-between border-b border-[#ebedf2] pb-3">
                    <h3 class="text-base font-bold text-[#343a40]">Generate Fee Invoice</h3>
                    <button wire:click="$set('showModal', false)" class="text-[#9c9fa6] hover:text-[#343a40]">✕</button>
                </div>

                <form wire:submit="createFee" class="space-y-3.5">
                    <div>
                        <label class="block text-[11px] font-semibold text-[#495057] uppercase mb-1">Invoice Title</label>
                        <input type="text" wire:model="title" class="w-full bg-[#f8f9fa] border border-[#e4e7ea] rounded-xl px-3.5 py-2 text-xs text-[#343a40] focus:ring-2 focus:ring-[#b66dff] focus:outline-none">
                        @error('title') <span class="text-rose-500 text-[10px]">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[11px] font-semibold text-[#495057] uppercase mb-1">Student</label>
                            <select wire:model="selectedStudentId" class="w-full bg-[#f8f9fa] border border-[#e4e7ea] rounded-xl px-3 py-2 text-xs text-[#343a40] focus:ring-2 focus:ring-[#b66dff] focus:outline-none">
                                @foreach($students as $st)
                                    <option value="{{ $st->id }}">{{ $st->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-[#495057] uppercase mb-1">Batch</label>
                            <select wire:model="selectedBatchId" class="w-full bg-[#f8f9fa] border border-[#e4e7ea] rounded-xl px-3 py-2 text-xs text-[#343a40] focus:ring-2 focus:ring-[#b66dff] focus:outline-none">
                                <option value="">General</option>
                                @foreach($batches as $bt)
                                    <option value="{{ $bt->id }}">{{ $bt->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[11px] font-semibold text-[#495057] uppercase mb-1">Amount (BDT)</label>
                            <input type="number" step="0.01" wire:model="amount" class="w-full bg-[#f8f9fa] border border-[#e4e7ea] rounded-xl px-3.5 py-2 text-xs text-[#343a40] focus:ring-2 focus:ring-[#b66dff] focus:outline-none">
                            @error('amount') <span class="text-rose-500 text-[10px]">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-[#495057] uppercase mb-1">Due Date</label>
                            <input type="date" wire:model="dueDate" class="w-full bg-[#f8f9fa] border border-[#e4e7ea] rounded-xl px-3.5 py-2 text-xs text-[#343a40] focus:ring-2 focus:ring-[#b66dff] focus:outline-none">
                            @error('dueDate') <span class="text-rose-500 text-[10px]">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="pt-3 flex items-center justify-end gap-2 border-t border-[#ebedf2]">
                        <button type="button" wire:click="$set('showModal', false)" class="px-4 py-2 text-xs font-semibold text-[#9c9fa6] hover:text-[#343a40]">Cancel</button>
                        <button type="submit" class="px-5 py-2 bg-[#b66dff] hover:bg-purple-600 text-white rounded-xl text-xs font-semibold shadow-md shadow-purple-500/20">Issue Invoice</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
