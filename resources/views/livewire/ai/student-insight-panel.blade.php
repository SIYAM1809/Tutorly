<div class="bg-gradient-to-br from-slate-900 via-indigo-950/40 to-slate-900 border border-indigo-500/20 rounded-2xl p-6 shadow-2xl relative overflow-hidden">
    <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div class="flex items-center gap-3">
            <div class="p-2.5 bg-indigo-600/20 border border-indigo-500/30 rounded-xl text-indigo-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-white">Gemini AI Risk Insight Panel</h3>
                <p class="text-xs text-slate-400">Automated dropout risk flags & actionable teacher recommendations</p>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <select wire:model.live="selectedStudentId" class="bg-slate-800 text-slate-200 border border-slate-700 rounded-xl px-3 py-1.5 text-xs">
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>

            <button wire:click="runAnalysis" class="px-4 py-1.5 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl text-xs font-semibold shadow-lg shadow-indigo-600/30 transition-all flex items-center gap-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 animate-spin" wire:loading wire:target="runAnalysis" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
                <span>Re-Analyze</span>
            </button>
        </div>
    </div>

    @if($latestInsight)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="p-4 rounded-xl border {{ $latestInsight->risk_level === 'HIGH' ? 'bg-rose-500/10 border-rose-500/30 text-rose-300' : ($latestInsight->risk_level === 'MEDIUM' ? 'bg-amber-500/10 border-amber-500/30 text-amber-300' : 'bg-emerald-500/10 border-emerald-500/30 text-emerald-300') }}">
                <div class="text-[10px] uppercase font-bold tracking-wider opacity-80">Risk Classification</div>
                <div class="text-2xl font-black mt-1 flex items-center gap-2">
                    {{ $latestInsight->risk_level }} RISK
                </div>
            </div>

            <div class="md:col-span-2 p-4 rounded-xl bg-slate-800/60 border border-slate-700/60">
                <div class="text-[10px] uppercase font-bold tracking-wider text-slate-400">AI Assessment Summary</div>
                <p class="text-xs text-slate-200 mt-1 leading-relaxed">{{ $latestInsight->summary_text }}</p>
                <div class="mt-3 pt-3 border-t border-slate-700/50 flex items-center justify-between text-[11px]">
                    <span class="text-slate-400">Action: <strong class="text-indigo-300">{{ $latestInsight->recommended_action }}</strong></span>
                    <span class="text-slate-500 text-[10px]">{{ $latestInsight->generated_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>
    @else
        <div class="py-6 text-center text-slate-400 text-xs">
            No cached AI insight available for this student. Click <strong>Re-Analyze</strong> to invoke Gemini.
        </div>
    @endif
</div>
