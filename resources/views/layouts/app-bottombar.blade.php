<nav class="lg:hidden fixed bottom-0 left-0 w-full z-50 flex justify-around items-center h-16 px-4 bg-surface/90 dark:bg-surface/90 backdrop-blur-lg border-t border-white/10 shadow-[0_-4px_20px_rgba(0,0,0,0.5)] rounded-t-xl">
    <a class="{{ request()->routeIs('dashboard') ? 'text-primary scale-110 font-bold' : 'text-on-surface-variant hover:text-primary' }} flex flex-col items-center justify-center active:bg-primary/10 transition-all p-2 rounded-lg" href="{{ route('dashboard') }}">
        <span class="material-symbols-outlined" {!! request()->routeIs('dashboard') ? 'style="font-variation-settings: \'FILL\' 1;"' : '' !!}>home</span>
        <span class="font-label-caps text-label-caps mt-1" style="font-size: 10px;">Home</span>
    </a>
    <a class="{{ request()->routeIs('courses.*') ? 'text-primary scale-110 font-bold' : 'text-on-surface-variant hover:text-primary' }} flex flex-col items-center justify-center active:bg-primary/10 transition-all p-2 rounded-lg" href="{{ route('courses.index') }}">
        <span class="material-symbols-outlined" {!! request()->routeIs('courses.*') ? 'style="font-variation-settings: \'FILL\' 1;"' : '' !!}>menu_book</span>
        <span class="font-label-caps text-label-caps mt-1" style="font-size: 10px;">Kursus</span>
    </a>
    <a class="{{ request()->routeIs('leaderboard.*') ? 'text-primary scale-110 font-bold' : 'text-on-surface-variant hover:text-primary' }} flex flex-col items-center justify-center active:bg-primary/10 transition-all p-2 rounded-lg" href="{{ route('leaderboard.index') }}">
        <span class="material-symbols-outlined" {!! request()->routeIs('leaderboard.*') ? 'style="font-variation-settings: \'FILL\' 1;"' : '' !!}>emoji_events</span>
        <span class="font-label-caps text-label-caps mt-1" style="font-size: 10px;">Rank</span>
    </a>
    <a class="{{ request()->routeIs('profile.*') ? 'text-primary scale-110 font-bold' : 'text-on-surface-variant hover:text-primary' }} flex flex-col items-center justify-center active:bg-primary/10 transition-all p-2 rounded-lg" href="{{ route('profile.edit') }}">
        <span class="material-symbols-outlined" {!! request()->routeIs('profile.*') ? 'style="font-variation-settings: \'FILL\' 1;"' : '' !!}>person</span>
        <span class="font-label-caps text-label-caps mt-1" style="font-size: 10px;">Profil</span>
    </a>
</nav>
