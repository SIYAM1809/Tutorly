<div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 shadow-2xl flex flex-col h-[400px]">
    <div class="flex items-center justify-between pb-3 border-b border-slate-800">
        <div class="flex items-center gap-2">
            <span class="p-1.5 bg-emerald-500/20 text-emerald-400 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
            </span>
            <h4 class="text-sm font-bold text-white">Parent Academic Assistant</h4>
        </div>
        <select wire:model.live="selectedStudentId" class="bg-slate-800 text-slate-300 border border-slate-700 rounded-lg px-2.5 py-1 text-[11px]">
            @foreach($students as $st)
                <option value="{{ $st->id }}">{{ $st->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="flex-1 overflow-y-auto py-3 space-y-3 pr-1 text-xs">
        @if(empty($chatHistory))
            <div class="text-center py-10 text-slate-500">
                Ask any question about student performance, fees, or attendance!
            </div>
        @else
            @foreach($chatHistory as $msg)
                @if($msg['sender'] === 'user')
                    <div class="flex justify-end">
                        <div class="bg-indigo-600 text-white px-3.5 py-2 rounded-2xl rounded-tr-none max-w-[80%] shadow-md">
                            {{ $msg['text'] }}
                        </div>
                    </div>
                @else
                    <div class="flex justify-start">
                        <div class="bg-slate-800 text-slate-200 border border-slate-700/80 px-3.5 py-2 rounded-2xl rounded-tl-none max-w-[85%]">
                            {{ $msg['text'] }}
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    </div>

    <form wire:submit.prevent="ask" class="pt-3 border-t border-slate-800 flex gap-2">
        <input type="text" wire:model="question" placeholder="e.g. How is my child doing in math?" class="flex-1 bg-slate-800 text-slate-200 border border-slate-700 rounded-xl px-3 py-2 text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500">
        <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl text-xs font-bold transition-all">Send</button>
    </form>
</div>
