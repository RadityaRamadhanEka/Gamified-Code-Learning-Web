<x-guest-layout>
    <!-- Main Auth Card (Canvas) -->
    <main class="relative z-10 w-full max-w-[420px] mx-auto px-4 my-8">
        <!-- Glassmorphism Container -->
        <div class="bg-surface/10 backdrop-blur-2xl border border-white/10 rounded-xl shadow-[0_0_30px_rgba(0,219,233,0.05)] overflow-hidden flex flex-col relative">
            <!-- Subtle Top Glow -->
            <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-primary/50 to-transparent"></div>
            
            <div class="p-8 flex flex-col gap-8">
                <!-- Header / Brand -->
                <div class="text-center flex flex-col items-center gap-4">
                    <a href="/" class="font-display-lg text-display-lg text-primary tracking-tighter hover:scale-105 transition-transform">NgodingAJG</a>
                    
                    <!-- Gamification XP Chip -->
                    <div class="bg-primary/10 border border-primary/20 rounded-full px-4 py-2 flex items-center gap-2 shadow-[0_0_10px_rgba(0,219,233,0.1)]">
                        <span class="material-symbols-outlined text-primary" style="font-size: 16px;">bolt</span>
                        <span class="font-label-caps text-label-caps text-primary">Selesaikan pendaftaran: +50 XP</span>
                    </div>
                </div>

                <!-- Forms Container -->
                <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-6">
                    @csrf

                    <!-- Standard Input Group: Name -->
                    <div class="flex flex-col gap-2">
                        <label for="name" class="font-label-caps text-label-caps text-on-surface-variant flex items-center gap-2">
                            <span class="">👤</span> Nama Lengkap
                        </label>
                        <div class="relative">
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Commander Shepard" class="w-full bg-surface-container-lowest border {{ $errors->has('name') ? 'border-error shadow-[0_0_15px_rgba(255,180,171,0.15)] focus:ring-error' : 'border-outline-variant focus:border-primary focus:ring-primary' }} rounded-lg px-4 py-3 font-code-sm text-code-sm text-on-surface placeholder:text-on-surface-variant/50 focus:outline-none focus:ring-1 focus:bg-surface-container/50 transition-all duration-300">
                        </div>
                        @error('name')
                            <span class="font-label-caps text-label-caps text-error mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Standard Input Group: Email -->
                    <div class="flex flex-col gap-2">
                        <label for="email" class="font-label-caps text-label-caps text-on-surface-variant flex items-center gap-2">
                            <span class="">📧</span> Email
                        </label>
                        <div class="relative">
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="commander@ngodingajg.code" class="w-full bg-surface-container-lowest border {{ $errors->has('email') ? 'border-error shadow-[0_0_15px_rgba(255,180,171,0.15)] focus:ring-error' : 'border-outline-variant focus:border-primary focus:ring-primary' }} rounded-lg px-4 py-3 font-code-sm text-code-sm text-on-surface placeholder:text-on-surface-variant/50 focus:outline-none focus:ring-1 focus:bg-surface-container/50 transition-all duration-300">
                        </div>
                        @error('email')
                            <span class="font-label-caps text-label-caps text-error mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Input Group: Password -->
                    <div class="flex flex-col gap-2">
                        <label for="password" class="font-label-caps text-label-caps {{ $errors->has('password') ? 'text-error' : 'text-on-surface-variant' }} flex justify-between items-center">
                            <span class="flex items-center gap-2"><span class="">🔑</span> Password</span>
                        </label>
                        <div class="relative" x-data="{ show: false }">
                            <input id="password" :type="show ? 'text' : 'password'" name="password" required autocomplete="new-password" placeholder="••••••••" class="w-full {{ $errors->has('password') ? 'bg-error-container/10 border-error shadow-[0_0_15px_rgba(255,180,171,0.15)] focus:ring-error' : 'bg-surface-container-lowest border-outline-variant focus:border-primary focus:ring-primary' }} border rounded-lg px-4 py-3 font-code-sm text-code-sm text-on-surface placeholder:text-on-surface-variant/50 focus:outline-none focus:ring-1 focus:bg-surface-container/50 transition-all duration-300 pr-12">
                            <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-on-surface transition-colors" @click="show = !show">
                                <span class="material-symbols-outlined text-on-surface-variant" x-text="show ? 'visibility_off' : 'visibility'">visibility</span>
                            </button>
                        </div>
                        @error('password')
                            <span class="font-label-caps text-label-caps text-error mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Input Group: Confirm Password -->
                    <div class="flex flex-col gap-2">
                        <label for="password_confirmation" class="font-label-caps text-label-caps {{ $errors->has('password_confirmation') ? 'text-error' : 'text-on-surface-variant' }} flex justify-between items-center">
                            <span class="flex items-center gap-2"><span class="">🔐</span> Konfirmasi Password</span>
                        </label>
                        <div class="relative" x-data="{ show: false }">
                            <input id="password_confirmation" :type="show ? 'text' : 'password'" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" class="w-full {{ $errors->has('password_confirmation') ? 'bg-error-container/10 border-error shadow-[0_0_15px_rgba(255,180,171,0.15)] focus:ring-error' : 'bg-surface-container-lowest border-outline-variant focus:border-primary focus:ring-primary' }} border rounded-lg px-4 py-3 font-code-sm text-code-sm text-on-surface placeholder:text-on-surface-variant/50 focus:outline-none focus:ring-1 focus:bg-surface-container/50 transition-all duration-300 pr-12">
                            <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-on-surface transition-colors" @click="show = !show">
                                <span class="material-symbols-outlined text-on-surface-variant" x-text="show ? 'visibility_off' : 'visibility'">visibility</span>
                            </button>
                        </div>
                        @error('password_confirmation')
                            <span class="font-label-caps text-label-caps text-error mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Actions -->
                    <div class="mt-4 flex flex-col gap-4">
                        <button type="submit" class="w-full bg-gradient-to-r from-primary-container to-secondary-container text-on-primary-container font-headline-lg-mobile text-headline-lg-mobile py-3 px-6 rounded-lg shadow-[0_0_20px_rgba(0,240,255,0.2)] hover:shadow-[0_0_30px_rgba(0,240,255,0.4)] transition-all duration-300 active:scale-95 flex items-center justify-center gap-2 relative overflow-hidden group">
                            <span class="relative z-10">Daftar & Mulai</span>
                            <span class="material-symbols-outlined relative z-10">person_add</span>
                            <!-- Hover Effect Glint -->
                            <div class="absolute inset-0 bg-white/20 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-500 ease-in-out skew-x-12"></div>
                        </button>
                        
                        <div class="text-center font-code-sm text-code-sm text-on-surface-variant">
                            Sudah punya akun? <a href="{{ route('login') }}" class="text-primary hover:text-primary-fixed border-b border-primary/30 hover:border-primary transition-colors pb-0.5">Masuk di sini</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Decorative Bottom Elements -->
        <div class="mt-8 flex justify-center gap-2 opacity-50">
            <div class="w-1.5 h-1.5 rounded-full bg-primary"></div>
            <div class="w-1.5 h-1.5 rounded-full bg-on-surface-variant"></div>
            <div class="w-1.5 h-1.5 rounded-full bg-on-surface-variant"></div>
        </div>
    </main>
</x-guest-layout>
