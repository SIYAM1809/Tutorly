<div class="relative w-full max-w-md" x-data="{ open: false }">
    <div class="relative">
        <input type="text" wire:model.live.debounce.300ms="query" @focus="open = true" placeholder="Global search students, batches, subjects..." class="w-full bg-slate-800/80 text-slate-200 placeholder-slate-500 border border-slate-700/60 rounded-xl pl-9 pr-4 py-2 text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-500 absolute left-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
    </div>

    <div x-show="open && $wire.query.length >= 2" @click.outside="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="absolute left-0 right-0 z-50 mt-2 rounded-2xl bg-slate-900 border border-slate-800 shadow-2xl p-3 max-h-80 overflow-y-auto text-xs">
        @if(!empty($results['students']) && count($results['students']) > 0)
            <div class="px-2 py-1 text-[10px] font-bold uppercase text-indigo-400">Students</div>
            @foreach($results['students'] as $st)
                <a href="#" class="block px-3 py-2 rounded-lg hover:bg-slate-800 text-slate-200">
                    <div class="font-medium">{{ $st->name }}</div>
                    <div class="text-[10px] text-slate-400">{{ $st->email }}</div>
                </a>
            @endforeach
        @endif

        @if(!empty($results['batches']) && count($results['batches']) > 0)
            <div class="px-2 py-1 text-[10px] font-bold uppercase text-indigo-400 mt-2">Batches</div>
            @foreach($results['batches'] as $bt)
                <a href="#" class="block px-3 py-2 rounded-lg hover:bg-slate-800 text-slate-200">
                    <div class="font-medium">{{ $bt->name }}</div>
                    <div class="text-[10px] text-slate-400">{{ $bt->subject }}</div>
                </a>
            @endforeach
        @endif

        @if(empty($results['students']) && empty($results['batches']))
            <div class="py-4 text-center text-slate-500">No results found for "{{ $query }}"</div>
        @endif
    </div>
</div>
