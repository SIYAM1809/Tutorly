<div class="bg-white border border-[#ebedf2] rounded-2xl p-6 shadow-sm relative overflow-hidden">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div class="flex items-center gap-3">
            <div class="p-2.5 bg-purple-50 border border-purple-200 rounded-xl text-[#b66dff]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <div>
                <h3 class="text-base font-bold text-[#343a40]">Gemini AI Risk Radar</h3>
                <p class="text-xs text-[#9c9fa6]">Automated academic risk assessment & faculty guidance</p>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <select wire:model.live="selectedStudentId" class="bg-[#f8f9fa] text-[#495057] border border-[#e4e7ea] rounded-xl px-3 py-1.5 text-xs focus:ring-2 focus:ring-[#b66dff] focus:outline-none">
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>

            <button wire:click="runAnalysis" class="px-4 py-1.5 bg-[#b66dff] hover:bg-purple-600 text-white rounded-xl text-xs font-semibold shadow-md shadow-purple-500/20 transition-all flex items-center gap-1.5">
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
            <div class="p-4 rounded-xl border {{ $latestInsight->risk_level === 'HIGH' ? 'bg-[#fe7096]/10 border-[#fe7096]/30 text-[#fe7096]' : ($latestInsight->risk_level === 'MEDIUM' ? 'bg-amber-500/10 border-amber-500/30 text-amber-500' : 'bg-[#00d25b]/10 border-[#00d25b]/30 text-[#00d25b]') }}">
                <div class="text-[10px] uppercase font-bold tracking-wider opacity-80">Risk Classification</div>
                <div class="text-xl font-black mt-1 flex items-center gap-2">
                    {{ $latestInsight->risk_level }} RISK
                </div>
            </div>

            <div class="md:col-span-2 p-4 rounded-xl bg-[#f8f9fa] border border-[#ebedf2]">
                <div class="text-[10px] uppercase font-bold tracking-wider text-[#9c9fa6]">AI Assessment Summary</div>
                <p class="text-xs text-[#343a40] mt-1 leading-relaxed">{{ $latestInsight->summary_text }}</p>
                <div class="mt-3 pt-3 border-t border-[#ebedf2] flex items-center justify-between text-[11px]">
                    <span class="text-[#797979]">Action: <strong class="text-[#b66dff]">{{ $latestInsight->recommended_action }}</strong></span>
                    <span class="text-[#9c9fa6] text-[10px]">{{ $latestInsight->generated_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>
    @else
        <div class="py-6 text-center text-[#9c9fa6] text-xs">
            No cached AI insight available for this student. Click <strong>Re-Analyze</strong> to invoke Gemini.
        </div>
    @endif
</div>
