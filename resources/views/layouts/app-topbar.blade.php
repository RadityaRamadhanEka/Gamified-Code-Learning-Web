<header class="sticky top-0 w-full z-30 flex justify-between items-center px-gutter py-4 bg-surface/80 dark:bg-surface/80 backdrop-blur-xl border-b border-white/10 shadow-[0_0_15px_rgba(0,219,233,0.15)]">
    <div class="flex items-center gap-4">
        <h2 class="font-headline-lg text-headline-lg md:text-headline-lg-mobile font-bold hidden md:block">
            {{ $header ?? 'Dashboard' }}
        </h2>
    </div>
    <div class="flex items-center gap-4">
        <button class="text-on-surface-variant hover:text-primary transition-colors duration-200">
            <span class="material-symbols-outlined">notifications</span>
        </button>
        
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="flex items-center focus:outline-none">
                    <img alt="User avatar" class="w-10 h-10 rounded-full border border-primary/30 cursor-pointer hover:border-primary transition-colors" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBfXapcX2aJKKVlPGsBUAv8Du8MYX0pIQjR4HnF0havbAhF6DRr7hbxGoteV9G_DiC-E5KRW9E3rk_iTPYuP127SR8jlc5bzIo9xFqkPYQV3C7kR6sNdU6gpgX8cjTuw6omgaREfIfntuq44VBiba5o4TsM4vEK7rJGXrFmkVK8zuU4rlv3GNLL-9C3xh39FFDPp8vwR5V6zIHZ8Rv9Jl-ZThYQMUinHLGqCupnFZ2NU9_HBp91w_VLG_qxjIITwcR6GcvZO9Uqnis">
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')" class="text-black dark:text-black">
                    {{ __('Profile') }}
                </x-dropdown-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();" class="text-black dark:text-black">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</header>
