<div class="relative" x-data="{ open: false }">
    <button @click="open = !open; $wire.markAsRead()" class="relative p-2 text-slate-400 hover:text-white rounded-xl bg-slate-800/80 border border-slate-700/60 transition-all">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>

        @if($unreadCount > 0)
            <span class="absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-rose-500 text-[9px] font-bold text-white shadow-lg animate-pulse">
                {{ $unreadCount }}
            </span>
        @endif
    </button>

    <div x-show="open" @click.outside="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="absolute right-0 z-50 mt-2 w-80 origin-top-right rounded-2xl bg-slate-900 border border-slate-800 shadow-2xl p-4">
        <div class="flex items-center justify-between pb-3 border-b border-slate-800">
            <h5 class="text-xs font-bold text-white">Notifications</h5>
            <span class="text-[10px] text-indigo-400 font-semibold">Live Reverb</span>
        </div>

        <div class="mt-3 space-y-2 max-h-60 overflow-y-auto">
            @forelse($notifications as $notif)
                <div class="p-2.5 rounded-xl bg-slate-800/60 border border-slate-700/40 text-xs">
                    <div class="font-semibold text-white flex items-center justify-between">
                        <span>{{ $notif['title'] }}</span>
                        <span class="text-[9px] text-slate-500 font-normal">{{ $notif['time'] }}</span>
                    </div>
                    <p class="text-[11px] text-slate-400 mt-1 leading-snug">{{ $notif['message'] }}</p>
                </div>
            @empty
                <div class="py-6 text-center text-xs text-slate-500">No notifications</div>
            @endforelse
        </div>
    </div>
</div>
