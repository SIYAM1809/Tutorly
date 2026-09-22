<div class="relative w-full max-w-md" x-data="{ open: false }">
    <div class="relative flex items-center">
        <svg class="w-4 h-4 text-[#9c9fa6] absolute left-3.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        <input 
            type="text" 
            wire:model.live.debounce.300ms="query" 
            @focus="open = true" 
            placeholder="Search students, batches, subjects..." 
            class="w-full bg-[#f8f9fa] text-xs text-[#343a40] placeholder-[#a7afb7] border border-[#e4e7ea] rounded-xl pl-10 pr-4 py-2 focus:ring-2 focus:ring-[#b66dff] focus:border-[#b66dff] focus:bg-white focus:outline-none transition-all shadow-2xs"
        >
    </div>

    <div 
        x-show="open && $wire.query.length >= 2" 
        @click.outside="open = false" 
        x-cloak
        x-transition:enter="transition ease-out duration-100" 
        x-transition:enter-start="opacity-0 scale-95" 
        x-transition:enter-end="opacity-100 scale-100" 
        class="absolute left-0 right-0 z-50 mt-2 rounded-2xl bg-white border border-[#ebedf2] shadow-2xl p-3 max-h-80 overflow-y-auto text-xs"
    >
        @if(!empty($results['students']) && count($results['students']) > 0)
            <div class="px-2 py-1 text-[10px] font-bold uppercase tracking-wider text-[#b66dff]">Enrolled Students</div>
            @foreach($results['students'] as $st)
                <a href="{{ route('students.index') }}?search={{ urlencode($st->name) }}" class="block px-3 py-2 rounded-xl hover:bg-purple-50/70 text-[#343a40] transition-colors">
                    <div class="font-semibold text-[#343a40]">{{ $st->name }}</div>
                    <div class="text-[10px] text-[#9c9fa6]">{{ $st->email }} · {{ $st->phone }}</div>
                </a>
            @endforeach
        @endif

        @if(!empty($results['batches']) && count($results['batches']) > 0)
            <div class="px-2 py-1 text-[10px] font-bold uppercase tracking-wider text-[#b66dff] mt-2">Active Batches</div>
            @foreach($results['batches'] as $bt)
                <a href="{{ route('batches.index') }}?search={{ urlencode($bt->name) }}" class="block px-3 py-2 rounded-xl hover:bg-purple-50/70 text-[#343a40] transition-colors">
                    <div class="font-semibold text-[#343a40]">{{ $bt->name }}</div>
                    <div class="text-[10px] text-[#9c9fa6]">{{ $bt->subject }} · {{ $bt->schedule }}</div>
                </a>
            @endforeach
        @endif

        @if(empty($results['students']) && empty($results['batches']))
            <div class="py-4 text-center text-[#9c9fa6]">No matching students or batches for "{{ $query }}"</div>
        @endif
    </div>
</div>
