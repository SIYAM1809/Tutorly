<div class="bg-white border border-[#ebedf2] rounded-2xl p-6 shadow-sm flex flex-col h-[420px]">
    <div class="flex items-center justify-between pb-3 border-b border-[#ebedf2]">
        <div class="flex items-center gap-2">
            <span class="p-1.5 bg-[#00d25b]/15 text-[#00d25b] rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
            </span>
            <h4 class="text-sm font-bold text-[#343a40]">Parent Assistant</h4>
        </div>
        <select wire:model.live="selectedStudentId" class="bg-[#f8f9fa] text-[#495057] border border-[#e4e7ea] rounded-lg px-2.5 py-1 text-[11px] focus:ring-2 focus:ring-[#b66dff] focus:outline-none">
            @foreach($students as $st)
                <option value="{{ $st->id }}">{{ $st->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="flex-1 overflow-y-auto py-3 space-y-3 pr-1 text-xs">
        @if(empty($chatHistory))
            <div class="text-center py-12 text-[#9c9fa6] space-y-2">
                <div class="text-2xl">💬</div>
                <p>Ask any academic question about performance, fee invoices, or attendance history!</p>
            </div>
        @else
            @foreach($chatHistory as $msg)
                @if($msg['sender'] === 'user')
                    <div class="flex justify-end">
                        <div class="bg-[#b66dff] text-white px-3.5 py-2 rounded-2xl rounded-tr-none max-w-[85%] shadow-sm">
                            {{ $msg['text'] }}
                        </div>
                    </div>
                @else
                    <div class="flex justify-start">
                        <div class="bg-[#f8f9fa] text-[#343a40] border border-[#e4e7ea] px-3.5 py-2 rounded-2xl rounded-tl-none max-w-[90%] shadow-xs">
                            {{ $msg['text'] }}
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    </div>

    <form wire:submit.prevent="ask" class="pt-3 border-t border-[#ebedf2] flex gap-2">
        <input type="text" wire:model="question" placeholder="Ask Gemini AI..." class="flex-1 bg-[#f8f9fa] text-[#343a40] placeholder-[#a7afb7] border border-[#e4e7ea] rounded-xl px-3.5 py-2 text-xs focus:outline-none focus:ring-2 focus:ring-[#b66dff] focus:bg-white transition-all">
        <button type="submit" class="px-4 py-2 bg-[#b66dff] hover:bg-purple-600 text-white rounded-xl text-xs font-bold shadow-md shadow-purple-500/20 transition-all">Send</button>
    </form>
</div>
