<div class="relative inline-block text-left" x-data="{ open: false }">
    <button @click="open = !open" type="button" class="inline-flex items-center gap-x-1.5 rounded-lg bg-slate-800/80 px-3 py-1.5 text-xs font-semibold text-slate-200 border border-slate-700/60 hover:bg-slate-700/80 transition-all">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
        </svg>
        <span>{{ strtoupper($currentLocale) }}</span>
        <svg class="-mr-1 h-4 w-4 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
        </svg>
    </button>

    <div x-show="open" @click.outside="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="absolute right-0 z-50 mt-2 w-32 origin-top-right rounded-lg bg-slate-900 border border-slate-800 shadow-xl py-1">
        <button wire:click="switchLanguage('en')" class="w-full text-left px-4 py-2 text-xs font-medium text-slate-300 hover:bg-indigo-600 hover:text-white flex items-center justify-between">
            <span>English</span>
            @if($currentLocale === 'en')
                <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
            @endif
        </button>
        <button wire:click="switchLanguage('bn')" class="w-full text-left px-4 py-2 text-xs font-medium text-slate-300 hover:bg-indigo-600 hover:text-white flex items-center justify-between">
            <span>বাংলা</span>
            @if($currentLocale === 'bn')
                <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
            @endif
        </button>
    </div>
</div>
