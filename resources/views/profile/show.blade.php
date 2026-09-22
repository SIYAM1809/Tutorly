<x-app-layout>
    <div class="max-w-4xl mx-auto space-y-6">

        <!-- HEADER -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-black text-[#343a40]">Account Profile & Security</h1>
                <p class="text-xs text-[#9c9fa6] mt-1">Manage your account credentials, contact information, and security preferences</p>
            </div>
            <span class="px-3 py-1 bg-purple-100 text-[#b66dff] rounded-full text-xs font-bold uppercase tracking-wider">
                {{ str_replace('_', ' ', $user->user_type) }}
            </span>
        </div>

        @if(session('status'))
            <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl text-xs font-semibold flex items-center gap-2">
                <span>✓</span>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        @if(session('password_status'))
            <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl text-xs font-semibold flex items-center gap-2">
                <span>✓</span>
                <span>{{ session('password_status') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- 1. PERSONAL & CONTACT DETAILS -->
            <div class="bg-white rounded-2xl border border-[#ebedf2] p-6 shadow-xs space-y-5">
                <div class="flex items-center gap-3 pb-3 border-b border-[#ebedf2]">
                    <div class="h-10 w-10 rounded-xl bg-purple-50 text-[#b66dff] flex items-center justify-center font-bold">
                        👤
                    </div>
                    <div>
                        <h3 class="font-bold text-sm text-[#343a40]">Personal Information</h3>
                        <p class="text-[11px] text-[#9c9fa6]">Your name and communication details</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label class="block text-xs font-bold text-[#495057] uppercase mb-1">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full bg-slate-50 border border-[#ebedf2] rounded-xl px-4 py-2.5 text-xs text-[#343a40] focus:ring-2 focus:ring-[#b66dff] focus:outline-none">
                        @error('name') <p class="text-rose-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#495057] uppercase mb-1">Email Address</label>
                        <input type="email" value="{{ $user->email }}" disabled class="w-full bg-slate-100 border border-[#ebedf2] rounded-xl px-4 py-2.5 text-xs text-[#9c9fa6] cursor-not-allowed">
                        <p class="text-[10px] text-[#9c9fa6] mt-1">Contact your campus admin to update email</p>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#495057] uppercase mb-1">Phone Number</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="+880 17..." class="w-full bg-slate-50 border border-[#ebedf2] rounded-xl px-4 py-2.5 text-xs text-[#343a40] focus:ring-2 focus:ring-[#b66dff] focus:outline-none">
                        @error('phone') <p class="text-rose-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                    </div>

                    @if($user->user_type === 'student')
                        <div>
                            <label class="block text-xs font-bold text-[#495057] uppercase mb-1">Guardian WhatsApp Phone</label>
                            <input type="text" name="guardian_phone" value="{{ old('guardian_phone', $user->guardian_phone) }}" placeholder="+880 18..." class="w-full bg-slate-50 border border-[#ebedf2] rounded-xl px-4 py-2.5 text-xs text-[#343a40] focus:ring-2 focus:ring-[#b66dff] focus:outline-none">
                            @error('guardian_phone') <p class="text-rose-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                    @endif

                    <div>
                        <label class="block text-xs font-bold text-[#495057] uppercase mb-1">Preferred Language</label>
                        <select name="preferred_language" class="w-full bg-slate-50 border border-[#ebedf2] rounded-xl px-4 py-2.5 text-xs text-[#343a40] focus:ring-2 focus:ring-[#b66dff] focus:outline-none">
                            <option value="en" {{ $user->preferred_language === 'en' ? 'selected' : '' }}>English (Default)</option>
                            <option value="bn" {{ $user->preferred_language === 'bn' ? 'selected' : '' }}>বাংলা (Bengali)</option>
                        </select>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full py-2.5 bg-[#b66dff] hover:bg-[#a355f7] text-white rounded-xl text-xs font-bold shadow-md shadow-purple-500/20 transition-all">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>

            <!-- 2. CHANGE PASSWORD FORM -->
            <div class="bg-white rounded-2xl border border-[#ebedf2] p-6 shadow-xs space-y-5">
                <div class="flex items-center gap-3 pb-3 border-b border-[#ebedf2]">
                    <div class="h-10 w-10 rounded-xl bg-rose-50 text-[#fe7096] flex items-center justify-center font-bold">
                        🔒
                    </div>
                    <div>
                        <h3 class="font-bold text-sm text-[#343a40]">Update Password</h3>
                        <p class="text-[11px] text-[#9c9fa6]">Ensure your account uses a strong, secure password</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('profile.password') }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-bold text-[#495057] uppercase mb-1">Current Password</label>
                        <input type="password" name="current_password" required placeholder="••••••••" class="w-full bg-slate-50 border border-[#ebedf2] rounded-xl px-4 py-2.5 text-xs text-[#343a40] focus:ring-2 focus:ring-[#b66dff] focus:outline-none">
                        @error('current_password') <p class="text-rose-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#495057] uppercase mb-1">New Password</label>
                        <input type="password" name="password" required placeholder="Minimum 8 characters" class="w-full bg-slate-50 border border-[#ebedf2] rounded-xl px-4 py-2.5 text-xs text-[#343a40] focus:ring-2 focus:ring-[#b66dff] focus:outline-none">
                        @error('password') <p class="text-rose-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#495057] uppercase mb-1">Confirm New Password</label>
                        <input type="password" name="password_confirmation" required placeholder="Re-enter new password" class="w-full bg-slate-50 border border-[#ebedf2] rounded-xl px-4 py-2.5 text-xs text-[#343a40] focus:ring-2 focus:ring-[#b66dff] focus:outline-none">
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full py-2.5 bg-[#343a40] hover:bg-[#212529] text-white rounded-xl text-xs font-bold shadow-md transition-all">
                            Update Password
                        </button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</x-app-layout>
