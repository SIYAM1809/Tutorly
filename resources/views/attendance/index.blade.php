<x-app-layout>
    <div class="space-y-6">
        <div>
            <h1 class="text-2xl font-black text-white">Live Attendance Board</h1>
            <p class="text-xs text-slate-400 mt-1">Real-time presence tracking with instant Laravel Reverb WebSocket broadcasts</p>
        </div>

        @livewire('attendance.live-attendance-board')
    </div>
</x-app-layout>
