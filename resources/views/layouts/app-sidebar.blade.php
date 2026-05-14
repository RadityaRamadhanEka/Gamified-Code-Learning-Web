<nav class="hidden lg:flex flex-col h-screen w-64 fixed left-0 top-0 bg-surface-container dark:bg-surface-container backdrop-blur-2xl border-r border-white/10 shadow-2xl z-40 transition-all duration-300 ease-in-out py-8">
    <div class="px-gutter mb-8">
        <a href="{{ route('dashboard') }}">
            <h1 class="font-headline-lg text-headline-lg font-bold text-primary">NgodingAJG</h1>
        </a>
    </div>
    <div class="px-4 mb-8">
        <div class="glass-panel rounded-xl p-4 flex items-center gap-4">
            <img alt="User Profile Picture" class="w-12 h-12 rounded-full border border-primary/50" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAERVSDcUfij6RUXG2Hyf2n3tydP2cj5745yW3nmzDfsVADsv7FmFGk4jlw4TswjjBZWERBsTa-BCV_S1Aoy0bLgUfiMbhkIaKMA0TcnPrSyALfqHDo5Dv7UbuwPJ05WTOOpC8YJJfm9YvKsw2OlpYx3LuhjDOZhX09eZ9S73tIERtH6vr4299Z41aQ8aeXArR1ln2L2eSzuzrXM4m2-uh-nTRWZAX5io5mTxaio-al4IQc6oYN3q-Na6jisJBo4hZoM6MDi2Gy4aY">
            <div>
                <h2 class="font-bold text-on-surface truncate w-32" title="{{ Auth::user()->name ?? 'Alpha Dev' }}">{{ Auth::user()->name ?? 'Alpha Dev' }}</h2>
                <p class="font-label-caps text-label-caps text-primary mt-1">Level 42 Master</p>
            </div>
        </div>
    </div>
    <ul class="flex-1 px-4 space-y-2">
        <li>
            <a class="{{ request()->routeIs('dashboard') ? 'bg-primary/10 text-primary border-r-4 border-primary rounded-l-lg' : 'text-on-surface-variant hover:bg-white/5 hover:bg-surface-bright/20 hover:text-primary rounded-lg' }} px-4 py-3 flex items-center gap-3 transition-all duration-300" href="{{ route('dashboard') }}">
                <span class="material-symbols-outlined" {!! request()->routeIs('dashboard') ? 'style="font-variation-settings: \'FILL\' 1;"' : '' !!}>dashboard</span>
                <span class="font-label-caps text-label-caps">Dashboard</span>
            </a>
        </li>
        <li>
            <a class="{{ request()->routeIs('courses.*') ? 'bg-primary/10 text-primary border-r-4 border-primary rounded-l-lg' : 'text-on-surface-variant hover:bg-white/5 hover:bg-surface-bright/20 hover:text-primary rounded-lg' }} px-4 py-3 flex items-center gap-3 transition-all duration-300" href="{{ route('courses.index') }}">
                <span class="material-symbols-outlined" {!! request()->routeIs('courses.*') ? 'style="font-variation-settings: \'FILL\' 1;"' : '' !!}>school</span>
                <span class="font-label-caps text-label-caps">Kursus</span>
            </a>
        </li>
        <li>
            <a class="{{ request()->routeIs('leaderboard.*') ? 'bg-primary/10 text-primary border-r-4 border-primary rounded-l-lg' : 'text-on-surface-variant hover:bg-white/5 hover:bg-surface-bright/20 hover:text-primary rounded-lg' }} px-4 py-3 flex items-center gap-3 transition-all duration-300" href="{{ route('leaderboard.index') }}">
                <span class="material-symbols-outlined" {!! request()->routeIs('leaderboard.*') ? 'style="font-variation-settings: \'FILL\' 1;"' : '' !!}>leaderboard</span>
                <span class="font-label-caps text-label-caps">Leaderboard</span>
            </a>
        </li>
        <li>
            <a class="text-on-surface-variant hover:bg-white/5 px-4 py-3 flex items-center gap-3 rounded-lg hover:bg-surface-bright/20 hover:text-primary transition-all duration-300" href="#">
                <span class="material-symbols-outlined">code</span>
                <span class="font-label-caps text-label-caps">Proyek</span>
            </a>
        </li>
        <li>
            <a class="text-on-surface-variant hover:bg-white/5 px-4 py-3 flex items-center gap-3 rounded-lg hover:bg-surface-bright/20 hover:text-primary transition-all duration-300" href="#">
                <span class="material-symbols-outlined">help</span>
                <span class="font-label-caps text-label-caps">Bantuan</span>
            </a>
        </li>
    </ul>
    <div class="px-4 mt-auto space-y-4">
        <button class="w-full bg-gradient-to-r from-primary to-secondary-container text-on-primary font-label-caps text-label-caps py-3 rounded-lg font-bold shadow-[0_0_15px_rgba(0,240,255,0.3)] hover:opacity-90 transition-opacity">
            Upgrade to Pro
        </button>
        <ul class="space-y-2">
            <li>
                <a class="{{ request()->routeIs('profile.*') ? 'bg-primary/10 text-primary border-r-4 border-primary rounded-l-lg' : 'text-on-surface-variant hover:bg-white/5 hover:bg-surface-bright/20 hover:text-primary rounded-lg' }} px-4 py-2 flex items-center gap-3 transition-all duration-300" href="{{ route('profile.edit') }}">
                    <span class="material-symbols-outlined" {!! request()->routeIs('profile.*') ? 'style="font-variation-settings: \'FILL\' 1;"' : '' !!}>settings</span>
                    <span class="font-label-caps text-label-caps">Settings</span>
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left text-on-surface-variant hover:bg-white/5 px-4 py-2 flex items-center gap-3 rounded-lg hover:bg-surface-bright/20 hover:text-error transition-all duration-300">
                        <span class="material-symbols-outlined">logout</span>
                        <span class="font-label-caps text-label-caps">Logout</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>
