<x-app-layout>
    <div class="space-y-6">
        <div>
            <h1 class="text-xl font-bold text-[#343a40]">My Fees & Payments</h1>
            <p class="text-xs text-[#9c9fa6] mt-0.5">Your invoices — pay outstanding fees online</p>
        </div>
        @php
            $fees = \App\Models\Fee::where('student_id', auth()->id())->orderByDesc('created_at')->paginate(15);
        @endphp
        <div class="bg-white rounded-2xl border border-[#ebedf2] shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-xs">
                    <thead class="bg-slate-50 border-b border-[#ebedf2]">
                        <tr>
                            <th class="px-5 py-3 text-left font-bold text-[#343a40]">Invoice</th>
                            <th class="px-5 py-3 text-left font-bold text-[#343a40]">Amount</th>
                            <th class="px-5 py-3 text-left font-bold text-[#343a40]">Due Date</th>
                            <th class="px-5 py-3 text-left font-bold text-[#343a40]">Status</th>
                            <th class="px-5 py-3 text-left font-bold text-[#343a40]">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#ebedf2]">
                        @forelse($fees as $fee)
                            <tr class="hover:bg-slate-50/50">
                                <td class="px-5 py-3 font-semibold text-[#343a40]">{{ $fee->title }}</td>
                                <td class="px-5 py-3 font-bold text-[#343a40]">৳{{ number_format($fee->amount, 0) }}</td>
                                <td class="px-5 py-3 text-[#495057]">
                                    {{ \Carbon\Carbon::parse($fee->due_date)->format('d M, Y') }}
                                    @if($fee->status !== 'paid' && \Carbon\Carbon::parse($fee->due_date)->isPast())
                                        <span class="ml-1 text-[9px] font-bold text-red-500">OVERDUE</span>
                                    @endif
                                </td>
                                <td class="px-5 py-3">
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold
                                        {{ $fee->status === 'paid' ? 'bg-green-100 text-green-700' : ($fee->status === 'partial' ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-600') }}">
                                        {{ ucfirst($fee->status) }}
                                    </span>
                                </td>
                                <td class="px-5 py-3">
                                    @if($fee->status !== 'paid')
                                        <a href="{{ route('payment.pay', $fee->id) }}"
                                           class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-gradient-to-r from-[#b66dff] to-[#6c5ce7] text-white text-[10px] font-bold hover:opacity-90 transition">
                                            Pay Now
                                        </a>
                                    @else
                                        <span class="text-[10px] text-[#00d25b] font-semibold">✓ Paid</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-5 py-8 text-center text-[#9c9fa6]">🎉 No fees found. You're all clear!</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-5 py-3 border-t border-[#ebedf2]">{{ $fees->links() }}</div>
        </div>
    </div>
</x-app-layout>
