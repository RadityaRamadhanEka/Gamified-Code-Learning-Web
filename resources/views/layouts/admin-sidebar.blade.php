<nav class="hidden lg:flex flex-col h-screen w-64 fixed left-0 top-0 bg-surface-container dark:bg-surface-container backdrop-blur-2xl border-r border-white/10 shadow-2xl z-40 transition-all duration-300 ease-in-out py-8">
    <div class="px-gutter mb-8">
        <a href="{{ route('admin.dashboard') }}">
            <h1 class="font-headline-lg text-headline-lg font-bold text-error">Admin Panel</h1>
            <p class="text-sm text-on-surface-variant">NgodingAJG</p>
        </a>
    </div>
    <div class="px-4 mb-8">
        <div class="glass-panel rounded-xl p-4 flex items-center gap-4 border border-error/30">
            <div class="w-12 h-12 rounded-full border border-error bg-error/20 flex items-center justify-center text-error">
                <span class="material-symbols-outlined">admin_panel_settings</span>
            </div>
            <div>
                <h2 class="font-bold text-on-surface truncate w-32" title="{{ Auth::user()->name ?? 'Administrator' }}">{{ Auth::user()->name ?? 'Administrator' }}</h2>
                <p class="font-label-caps text-label-caps text-error mt-1">Super Admin</p>
            </div>
        </div>
    </div>
    <ul class="flex-1 px-4 space-y-2">
        <li>
            <a class="{{ request()->routeIs('admin.dashboard') ? 'bg-error/10 text-error border-r-4 border-error rounded-l-lg' : 'text-on-surface-variant hover:bg-white/5 hover:bg-surface-bright/20 hover:text-error rounded-lg' }} px-4 py-3 flex items-center gap-3 transition-all duration-300" href="{{ route('admin.dashboard') }}">
                <span class="material-symbols-outlined" {!! request()->routeIs('admin.dashboard') ? 'style="font-variation-settings: \'FILL\' 1;"' : '' !!}>dashboard</span>
                <span class="font-label-caps text-label-caps">Dashboard</span>
            </a>
        </li>
        <li>
            <a class="{{ request()->routeIs('admin.courses.*') ? 'bg-error/10 text-error border-r-4 border-error rounded-l-lg' : 'text-on-surface-variant hover:bg-white/5 hover:bg-surface-bright/20 hover:text-error rounded-lg' }} px-4 py-3 flex items-center gap-3 transition-all duration-300" href="{{ route('admin.courses.index') }}">
                <span class="material-symbols-outlined" {!! request()->routeIs('admin.courses.*') ? 'style="font-variation-settings: \'FILL\' 1;"' : '' !!}>menu_book</span>
                <span class="font-label-caps text-label-caps">Kelola Kursus</span>
            </a>
        </li>
        <li>
            <a class="{{ request()->routeIs('admin.quizzes.*') ? 'bg-error/10 text-error border-r-4 border-error rounded-l-lg' : 'text-on-surface-variant hover:bg-white/5 hover:bg-surface-bright/20 hover:text-error rounded-lg' }} px-4 py-3 flex items-center gap-3 transition-all duration-300" href="{{ route('admin.quizzes.index') }}">
                <span class="material-symbols-outlined" {!! request()->routeIs('admin.quizzes.*') ? 'style="font-variation-settings: \'FILL\' 1;"' : '' !!}>quiz</span>
                <span class="font-label-caps text-label-caps">Kelola Kuis</span>
            </a>
        </li>
        <li>
            <a class="{{ request()->routeIs('admin.materials.*') ? 'bg-error/10 text-error border-r-4 border-error rounded-l-lg' : 'text-on-surface-variant hover:bg-white/5 hover:bg-surface-bright/20 hover:text-error rounded-lg' }} px-4 py-3 flex items-center gap-3 transition-all duration-300" href="{{ route('admin.materials.index') }}">
                <span class="material-symbols-outlined" {!! request()->routeIs('admin.materials.*') ? 'style="font-variation-settings: \'FILL\' 1;"' : '' !!}>library_books</span>
                <span class="font-label-caps text-label-caps">Kelola Materi</span>
            </a>
        </li>
    </ul>
    <div class="px-4 mt-auto space-y-4">
        <ul class="space-y-2">
            <li>
                <a class="text-on-surface-variant hover:bg-white/5 px-4 py-2 flex items-center gap-3 rounded-lg hover:bg-surface-bright/20 hover:text-primary transition-all duration-300" href="{{ route('dashboard') }}">
                    <span class="material-symbols-outlined">arrow_back</span>
                    <span class="font-label-caps text-label-caps">Ke User App</span>
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
