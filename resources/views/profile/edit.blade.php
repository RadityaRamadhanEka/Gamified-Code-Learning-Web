<x-app-layout>
    <x-slot name="header">
        Edit Profile
    </x-slot>

    <!-- Header / Intro -->
    <div class="xl:col-span-12 mb-8">
        <h1 class="font-display-lg text-display-lg md:text-display-lg text-on-surface mb-2">Edit Profile</h1>
        <p class="font-body-md text-body-md text-on-surface-variant">Manage your identity within the void.</p>
    </div>

    <!-- Left Column: Identity & Stats -->
    <div class="xl:col-span-4 flex flex-col gap-6">
        <!-- Avatar & Badge Card -->
        <div class="glass-panel rounded-xl p-8 flex flex-col items-center text-center relative overflow-hidden group">
            <!-- Subtle ambient glow behind card -->
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-32 h-32 bg-primary/20 rounded-full blur-[50px] pointer-events-none"></div>
            
            <div class="relative mb-6">
                <div class="w-32 h-32 rounded-full overflow-hidden border-2 border-primary/30 p-1">
                    <img alt="Current Avatar" class="w-full h-full rounded-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBUTl8uFqsNVG2XzMPfWu3bbBPXdxPeZ2LEKYxbQTows7PG5I_40zr2rtq4nbsEllhxzX-N6JBQG8PNtuR7NhPubXDIbnPXBKXg7516AealsXVPcyEEcGjZzMAscQLmbqZOU_DtcjHie_Zf-lD3_JI0M7OB2vuqll-tQvmjEEEizH56L1Nznxm3A2UwuugDn_EYyG2WsrVKn1geGm-dHRydO69rEBWhzK8j-62TlF3jrwnontrWyZXtPMTdBHssPgibSc9EmegaM7s">
                </div>
                <button class="absolute bottom-0 right-0 w-10 h-10 bg-surface-bright border border-white/10 rounded-full flex items-center justify-center text-primary hover:bg-primary-container hover:text-on-primary-container hover:scale-110 transition-all shadow-lg group-hover:shadow-[0_0_15px_rgba(0,219,233,0.5)]">
                    <span class="material-symbols-outlined" style="font-size: 20px;">photo_camera</span>
                </button>
            </div>
            
            <h2 class="font-headline-lg text-headline-lg text-on-surface mb-1">{{ Auth::user()->name ?? 'Alpha Dev' }}</h2>
            <p class="font-body-md text-body-md text-on-surface-variant mb-4">{{ Auth::user()->email ?? 'alpha.dev@nebulacode.io' }}</p>
            
            <div class="inline-flex items-center gap-2 bg-secondary/10 border border-secondary/20 px-4 py-1.5 rounded-full mb-6">
                <span class="material-symbols-outlined text-secondary" data-weight="fill" style="font-variation-settings: 'FILL' 1;">stars</span>
                <span class="font-label-caps text-label-caps text-secondary-fixed">Level 42 Master</span>
            </div>
            
            <div class="w-full">
                <div class="flex justify-between items-end mb-2">
                    <span class="font-label-caps text-label-caps text-on-surface-variant">Total XP</span>
                    <span class="font-code-sm text-code-sm text-primary font-bold">50,000</span>
                </div>
                <div class="h-2 w-full bg-surface-container-lowest rounded-full overflow-hidden border border-white/5">
                    <div class="h-full bg-gradient-to-r from-primary-container to-secondary-container w-[85%] shadow-[0_0_10px_rgba(0,240,255,0.5)] relative">
                        <div class="absolute right-0 top-0 bottom-0 w-4 bg-white/40 blur-[2px]"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Card -->
        <div class="glass-panel rounded-xl p-6">
            <h3 class="font-label-caps text-label-caps text-on-surface-variant mb-6 uppercase tracking-widest border-b border-white/5 pb-2">Operational Stats</h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-surface-container-lowest border border-white/5 rounded-lg p-4 flex flex-col items-center justify-center text-center hover:border-primary/30 transition-colors">
                    <span class="material-symbols-outlined text-tertiary-fixed mb-2" data-weight="fill" style="font-variation-settings: 'FILL' 1;">emoji_events</span>
                    <span class="font-display-lg text-display-lg md:text-[32px] text-on-surface mb-1">12</span>
                    <span class="font-label-caps text-label-caps text-on-surface-variant">Badges Earned</span>
                </div>
                <div class="bg-surface-container-lowest border border-white/5 rounded-lg p-4 flex flex-col items-center justify-center text-center hover:border-primary/30 transition-colors">
                    <span class="material-symbols-outlined text-primary-fixed mb-2" data-weight="fill" style="font-variation-settings: 'FILL' 1;">timer</span>
                    <span class="font-display-lg text-display-lg md:text-[32px] text-on-surface mb-1">1,240</span>
                    <span class="font-label-caps text-label-caps text-on-surface-variant">Coding Hours</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Forms -->
    <div class="xl:col-span-8 flex flex-col gap-6">
        <!-- Basic Info Form -->
        <div class="glass-panel rounded-xl p-6 md:p-8">
            <h3 class="font-headline-lg-mobile text-headline-lg-mobile text-on-surface mb-6 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">person</span>
                Personal Details
            </h3>

            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                @csrf
            </form>

            <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                @csrf
                @method('patch')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex flex-col gap-2">
                        <label class="font-label-caps text-label-caps text-on-surface-variant">Display Name</label>
                        <input name="name" class="bg-surface border border-outline-variant rounded-lg p-3 text-on-surface font-body-md focus:border-primary-container focus:ring-1 focus:ring-primary-container outline-none transition-all placeholder-on-surface-variant/50" placeholder="Enter your display name" type="text" value="{{ old('name', $user->name ?? Auth::user()->name) }}" required autofocus autocomplete="name">
                        <x-input-error class="mt-2 text-error" :messages="$errors->get('name')" />
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="font-label-caps text-label-caps text-on-surface-variant">Email Address</label>
                        <input name="email" class="bg-surface border border-outline-variant rounded-lg p-3 text-on-surface font-body-md focus:border-primary-container focus:ring-1 focus:ring-primary-container outline-none transition-all placeholder-on-surface-variant/50" placeholder="Enter your email" type="email" value="{{ old('email', $user->email ?? Auth::user()->email) }}" required autocomplete="username">
                        <x-input-error class="mt-2 text-error" :messages="$errors->get('email')" />

                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                            <div>
                                <p class="text-sm mt-2 text-on-surface-variant">
                                    {{ __('Your email address is unverified.') }}

                                    <button form="send-verification" class="underline text-sm text-primary hover:text-primary-fixed rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                        {{ __('Click here to re-send the verification email.') }}
                                    </button>
                                </p>

                                @if (session('status') === 'verification-link-sent')
                                    <p class="mt-2 font-medium text-sm text-green-400">
                                        {{ __('A new verification link has been sent to your email address.') }}
                                    </p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="flex flex-col gap-2">
                    <label class="font-label-caps text-label-caps text-on-surface-variant">Bio / Mission Statement</label>
                    <textarea class="bg-surface border border-outline-variant rounded-lg p-3 text-on-surface font-body-md focus:border-primary-container focus:ring-1 focus:ring-primary-container outline-none transition-all placeholder-on-surface-variant/50 resize-none" rows="3">Exploring the outer rim of web development. Specializing in high-performance React architectures and dark mode aesthetics.</textarea>
                </div>
                
                <div class="flex flex-col gap-2">
                    <label class="font-label-caps text-label-caps text-on-surface-variant">Primary Technologies</label>
                    <div class="bg-surface border border-outline-variant rounded-lg p-3 flex flex-wrap gap-2 focus-within:border-primary-container focus-within:ring-1 focus-within:ring-primary-container transition-all">
                        <span class="inline-flex items-center gap-1 bg-primary/10 text-primary-fixed border border-primary/20 px-3 py-1 rounded-full font-code-sm text-code-sm">
                            React <button type="button" class="hover:text-white"><span class="material-symbols-outlined" style="font-size: 14px;">close</span></button>
                        </span>
                        <span class="inline-flex items-center gap-1 bg-primary/10 text-primary-fixed border border-primary/20 px-3 py-1 rounded-full font-code-sm text-code-sm">
                            TypeScript <button type="button" class="hover:text-white"><span class="material-symbols-outlined" style="font-size: 14px;">close</span></button>
                        </span>
                        <span class="inline-flex items-center gap-1 bg-primary/10 text-primary-fixed border border-primary/20 px-3 py-1 rounded-full font-code-sm text-code-sm">
                            Tailwind <button type="button" class="hover:text-white"><span class="material-symbols-outlined" style="font-size: 14px;">close</span></button>
                        </span>
                        <input class="bg-transparent border-none outline-none text-on-surface font-code-sm flex-1 min-w-[100px] p-0 focus:ring-0" placeholder="Add tech..." type="text">
                    </div>
                </div>

                <!-- Action Area -->
                <div class="flex items-center justify-end gap-4 mt-6">
                    @if (session('status') === 'profile-updated')
                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-on-surface-variant"
                        >{{ __('Saved.') }}</p>
                    @endif
                    <button type="submit" class="bg-gradient-to-r from-primary-fixed to-secondary-container text-surface-lowest font-label-caps text-label-caps px-8 py-3 rounded-lg shadow-[0_0_15px_rgba(0,219,233,0.3)] hover:scale-105 transition-transform flex items-center gap-2">
                        <span class="material-symbols-outlined" style="font-size: 18px;">save</span>
                        Save Configuration
                    </button>
                </div>
            </form>
        </div>

        <!-- Update Password Form -->
        <div class="glass-panel rounded-xl p-6 md:p-8 mt-6">
            <h3 class="font-headline-lg-mobile text-headline-lg-mobile text-on-surface mb-6 flex items-center gap-2">
                <span class="material-symbols-outlined text-secondary">lock</span>
                Security Details
            </h3>
            <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                @csrf
                @method('put')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex flex-col gap-2 md:col-span-2">
                        <label class="font-label-caps text-label-caps text-on-surface-variant">Current Password</label>
                        <input name="current_password" type="password" class="bg-surface border border-outline-variant rounded-lg p-3 text-on-surface font-body-md focus:border-secondary-container focus:ring-1 focus:ring-secondary-container outline-none transition-all placeholder-on-surface-variant/50" required autocomplete="current-password">
                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-error" />
                    </div>
                    
                    <div class="flex flex-col gap-2">
                        <label class="font-label-caps text-label-caps text-on-surface-variant">New Password</label>
                        <input name="password" type="password" class="bg-surface border border-outline-variant rounded-lg p-3 text-on-surface font-body-md focus:border-secondary-container focus:ring-1 focus:ring-secondary-container outline-none transition-all placeholder-on-surface-variant/50" required autocomplete="new-password">
                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-error" />
                    </div>
                    
                    <div class="flex flex-col gap-2">
                        <label class="font-label-caps text-label-caps text-on-surface-variant">Confirm Password</label>
                        <input name="password_confirmation" type="password" class="bg-surface border border-outline-variant rounded-lg p-3 text-on-surface font-body-md focus:border-secondary-container focus:ring-1 focus:ring-secondary-container outline-none transition-all placeholder-on-surface-variant/50" required autocomplete="new-password">
                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-error" />
                    </div>
                </div>

                <!-- Action Area -->
                <div class="flex items-center justify-end gap-4 mt-6">
                    @if (session('status') === 'password-updated')
                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-on-surface-variant"
                        >{{ __('Saved.') }}</p>
                    @endif
                    <button type="submit" class="bg-gradient-to-r from-secondary to-secondary-container text-surface-lowest font-label-caps text-label-caps px-8 py-3 rounded-lg shadow-[0_0_15px_rgba(112,0,255,0.3)] hover:scale-105 transition-transform flex items-center gap-2">
                        <span class="material-symbols-outlined" style="font-size: 18px;">key</span>
                        Update Password
                    </button>
                </div>
            </form>
        </div>

        <!-- Social Links Form (From template) -->
        <div class="glass-panel rounded-xl p-6 md:p-8 mt-6">
            <h3 class="font-headline-lg-mobile text-headline-lg-mobile text-on-surface mb-6 flex items-center gap-2">
                <span class="material-symbols-outlined text-tertiary-fixed">public</span>
                External Networks
            </h3>
            <form class="space-y-4">
                <div class="flex flex-col md:flex-row gap-4 items-center">
                    <div class="w-full md:w-32 flex-shrink-0 flex items-center gap-2 text-on-surface-variant">
                        <span class="material-symbols-outlined">code</span>
                        <label class="font-label-caps text-label-caps">GitHub</label>
                    </div>
                    <input class="w-full bg-surface border border-outline-variant rounded-lg p-3 text-on-surface font-code-sm focus:border-tertiary-fixed focus:ring-1 focus:ring-tertiary-fixed outline-none transition-all placeholder-on-surface-variant/50" placeholder="github.com/username" type="url" value="https://github.com/alphadev">
                </div>
                
                <div class="flex flex-col md:flex-row gap-4 items-center">
                    <div class="w-full md:w-32 flex-shrink-0 flex items-center gap-2 text-on-surface-variant">
                        <span class="material-symbols-outlined">work</span>
                        <label class="font-label-caps text-label-caps">LinkedIn</label>
                    </div>
                    <input class="w-full bg-surface border border-outline-variant rounded-lg p-3 text-on-surface font-code-sm focus:border-tertiary-fixed focus:ring-1 focus:ring-tertiary-fixed outline-none transition-all placeholder-on-surface-variant/50" placeholder="linkedin.com/in/username" type="url" value="">
                </div>
                
                <div class="flex flex-col md:flex-row gap-4 items-center">
                    <div class="w-full md:w-32 flex-shrink-0 flex items-center gap-2 text-on-surface-variant">
                        <span class="material-symbols-outlined">language</span>
                        <label class="font-label-caps text-label-caps">Website</label>
                    </div>
                    <input class="w-full bg-surface border border-outline-variant rounded-lg p-3 text-on-surface font-code-sm focus:border-tertiary-fixed focus:ring-1 focus:ring-tertiary-fixed outline-none transition-all placeholder-on-surface-variant/50" placeholder="https://..." type="url" value="https://nebulacode.io/alpha">
                </div>
                
                <div class="flex items-center justify-end gap-4 mt-6">
                    <button type="button" class="bg-gradient-to-r from-tertiary-fixed to-tertiary-container text-surface-lowest font-label-caps text-label-caps px-8 py-3 rounded-lg shadow-[0_0_15px_rgba(255,225,109,0.3)] hover:scale-105 transition-transform flex items-center gap-2">
                        <span class="material-symbols-outlined" style="font-size: 18px;">public</span>
                        Save Networks
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Delete Account Form -->
        <div class="glass-panel rounded-xl p-6 md:p-8 mt-6 border border-error/30">
            <h3 class="font-headline-lg-mobile text-headline-lg-mobile text-error mb-2 flex items-center gap-2">
                <span class="material-symbols-outlined">warning</span>
                Danger Zone
            </h3>
            <p class="text-sm text-on-surface-variant mb-6">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
            </p>

            <form method="post" action="{{ route('profile.destroy') }}" class="space-y-6">
                @csrf
                @method('delete')

                <div class="flex flex-col gap-2">
                    <label class="font-label-caps text-label-caps text-error">Confirm Password to Delete</label>
                    <input name="password" type="password" class="bg-surface border border-error/50 rounded-lg p-3 text-on-surface font-body-md focus:border-error focus:ring-1 focus:ring-error outline-none transition-all placeholder-on-surface-variant/50" placeholder="Password" required>
                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-error" />
                </div>

                <div class="flex justify-end gap-4 mt-6">
                    <button type="submit" class="bg-error/10 border border-error text-error font-label-caps text-label-caps px-8 py-3 rounded-lg hover:bg-error hover:text-on-error transition-colors flex items-center gap-2">
                        <span class="material-symbols-outlined" style="font-size: 18px;">delete_forever</span>
                        Delete Account
                    </button>
                </div>
            </form>
        </div>

    </div>
</x-app-layout>
