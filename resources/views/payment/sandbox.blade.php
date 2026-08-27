<x-app-layout>
    <div class="max-w-xl mx-auto py-12">
        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-8 shadow-2xl text-center">
            <div class="h-16 w-16 bg-indigo-600/20 text-indigo-400 rounded-2xl flex items-center justify-center mx-auto mb-4 border border-indigo-500/30">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>

            <h2 class="text-xl font-bold text-white">SSLCommerz Sandbox Gateway</h2>
            <p class="text-xs text-slate-400 mt-1">Simulated local payment environment for BD coaching fees</p>

            <div class="my-6 p-4 rounded-2xl bg-slate-800/80 text-left space-y-2 text-xs">
                <div class="flex justify-between">
                    <span class="text-slate-400">Transaction ID:</span>
                    <span class="font-mono text-indigo-300 font-bold">{{ $payment->tran_id }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-400">Amount Due:</span>
                    <span class="font-mono text-emerald-400 font-bold">৳{{ number_format($payment->amount, 2) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-400">Student:</span>
                    <span class="text-white">{{ $payment->student->name ?? 'Student' }}</span>
                </div>
            </div>

            <form action="{{ route('payment.success') }}" method="POST" class="space-y-3">
                @csrf
                <input type="hidden" name="tran_id" value="{{ $payment->tran_id }}">
                <button type="submit" class="w-full py-3 bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs rounded-xl shadow-lg shadow-emerald-600/30 transition-all">
                    Simulate Successful SSLCommerz Payment
                </button>
            </form>

            <form action="{{ route('payment.fail') }}" method="POST" class="mt-2">
                @csrf
                <input type="hidden" name="tran_id" value="{{ $payment->tran_id }}">
                <button type="submit" class="w-full py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-300 font-semibold text-xs rounded-xl transition-all">
                    Simulate Payment Failure
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
