<div class="relative" x-data="{ open: false }">
    <button @click="open = !open; $wire.markAsRead()" class="relative p-2 text-[#9c9fa6] hover:text-[#b66dff] rounded-lg hover:bg-slate-50 transition-colors" title="Notifications">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>

        @if($unreadCount > 0)
            <span class="absolute top-1 right-1 flex h-2 w-2 rounded-full bg-[#fe7096] ring-2 ring-white"></span>
        @endif
    </button>

    <div 
        x-show="open" 
        @click.outside="open = false" 
        x-cloak
        x-transition:enter="transition ease-out duration-100" 
        x-transition:enter-start="opacity-0 scale-95" 
        x-transition:enter-end="opacity-100 scale-100" 
        class="absolute right-0 z-50 mt-2 w-80 origin-top-right rounded-2xl bg-white border border-[#ebedf2] shadow-2xl p-4 text-xs"
    >
        <div class="flex items-center justify-between pb-3 border-b border-[#ebedf2]">
            <h5 class="font-bold text-[#343a40]">Notifications</h5>
            <span class="text-[10px] text-[#b66dff] font-semibold bg-purple-50 px-2 py-0.5 rounded-full">Live Reverb</span>
        </div>

        <div class="mt-3 space-y-2 max-h-60 overflow-y-auto">
            @forelse($notifications as $notif)
                <div class="p-2.5 rounded-xl bg-[#f8f9fa] border border-[#e4e7ea] text-xs">
                    <div class="font-semibold text-[#343a40] flex items-center justify-between">
                        <span>{{ $notif['title'] }}</span>
                        <span class="text-[9px] text-[#9c9fa6] font-normal">{{ $notif['time'] }}</span>
                    </div>
                    <p class="text-[11px] text-[#797979] mt-1 leading-snug">{{ $notif['message'] }}</p>
                </div>
            @empty
                <div class="py-6 text-center text-[#9c9fa6]">No notifications yet</div>
            @endforelse
        </div>
    </div>
</div>
