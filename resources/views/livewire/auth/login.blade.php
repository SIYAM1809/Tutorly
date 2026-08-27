<div class="min-h-screen bg-slate-950 flex items-center justify-center p-4 relative overflow-hidden">

    {{-- Ambient background glows --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-indigo-600/20 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-cyan-500/15 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-indigo-900/10 rounded-full blur-3xl"></div>
    </div>

    <div class="w-full max-w-md relative z-10">

        {{-- Logo --}}
        <div class="flex flex-col items-center mb-8">
            <div class="h-16 w-16 rounded-2xl bg-gradient-to-tr from-indigo-600 to-cyan-500 flex items-center justify-center font-black text-white text-2xl shadow-2xl shadow-indigo-600/40 mb-4">
                TL
            </div>
            <h1 class="text-3xl font-extrabold tracking-tight text-white">Tutorly</h1>
            <p class="text-slate-400 text-sm mt-1 font-medium">Multi-Branch Coaching Center Platform</p>
        </div>

        {{-- Card --}}
        <div class="bg-slate-900/70 backdrop-blur-xl border border-slate-800/80 rounded-2xl p-8 shadow-2xl shadow-black/40">

            <h2 class="text-xl font-bold text-white mb-1">Welcome back</h2>
            <p class="text-slate-400 text-sm mb-6">Sign in to your account to continue</p>

            <form wire:submit="authenticate" class="space-y-5">

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-xs font-semibold text-slate-300 mb-1.5 uppercase tracking-wider">Email Address</label>
                    <input
                        wire:model="email"
                        id="email"
                        type="email"
                        autocomplete="email"
                        autofocus
                        placeholder="admin@tutorly.app"
                        class="w-full bg-slate-800/80 border @error('email') border-red-500 @else border-slate-700 @enderror rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                    >
                    @error('email')
                        <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-xs font-semibold text-slate-300 mb-1.5 uppercase tracking-wider">Password</label>
                    <input
                        wire:model="password"
                        id="password"
                        type="password"
                        autocomplete="current-password"
                        placeholder="••••••••"
                        class="w-full bg-slate-800/80 border @error('password') border-red-500 @else border-slate-700 @enderror rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                    >
                    @error('password')
                        <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center gap-2">
                    <input wire:model="remember" id="remember" type="checkbox"
                        class="w-4 h-4 rounded border-slate-600 bg-slate-800 text-indigo-500 focus:ring-indigo-500 focus:ring-offset-slate-900">
                    <label for="remember" class="text-sm text-slate-400 cursor-pointer">Keep me signed in</label>
                </div>

                {{-- Submit --}}
                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-indigo-600 to-cyan-600 hover:from-indigo-500 hover:to-cyan-500 text-white font-semibold py-3 rounded-xl shadow-lg shadow-indigo-600/30 hover:shadow-indigo-600/50 transition-all duration-200 flex items-center justify-center gap-2 text-sm"
                    wire:loading.attr="disabled"
                    wire:loading.class="opacity-75 cursor-not-allowed"
                >
                    <span wire:loading.remove>Sign In</span>
                    <span wire:loading class="flex items-center gap-2">
                        <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Signing in...
                    </span>
                </button>

            </form>

            {{-- Demo credentials hint --}}
            <div class="mt-6 p-3 bg-slate-800/60 border border-slate-700/60 rounded-xl space-y-1">
                <p class="text-xs text-slate-400 text-center font-semibold text-indigo-400 mb-1">Demo Credentials</p>
                <p class="text-xs text-slate-400 text-center">
                    <span class="font-semibold text-slate-300">Super Admin:</span>
                    superadmin@coachsync.app / password
                </p>
                <p class="text-xs text-slate-400 text-center">
                    <span class="font-semibold text-slate-300">Branch Admin:</span>
                    admin.dhaka@coachsync.app / password
                </p>
            </div>

        </div>

        <p class="text-center text-xs text-slate-600 mt-6">
            © {{ date('Y') }} Tutorly · Powered by Laravel 11 + Livewire 3
        </p>
    </div>
</div>
