<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Dashboard' }} — NgodingAJG</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

{{-- ===== SIDEBAR LAYOUT ===== --}}
<div class="app-shell" x-data="{ sidebarOpen: false }">

    {{-- Overlay (mobile) --}}
    <div
        class="sidebar-overlay"
        x-show="sidebarOpen"
        @click="sidebarOpen = false"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        style="display:none;"
    ></div>

    {{-- Sidebar --}}
    <aside class="sidebar" :class="{ 'sidebar--open': sidebarOpen }">

        {{-- Logo --}}
        <div class="sidebar__logo">
            <a href="/" class="sidebar__logo-link">
                <div class="sidebar__logo-icon">⚡</div>
                <span class="sidebar__logo-text" x-show="sidebarOpen" x-cloak>NgodingAJG</span>
            </a>
        </div>

        {{-- User Card (collapsed: hanya avatar) --}}
        <div class="sidebar__user-wrap">
            <div class="sidebar__avatar" title="{{ Auth::user()->name }}">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="sidebar__user-info" x-show="sidebarOpen" x-cloak>
                <div class="sidebar__user-name">{{ Auth::user()->name }}</div>
                <div class="sidebar__user-level">
                    <span style="color: var(--accent-emerald);">⚡</span>
                    <span style="color: var(--text-muted); font-size: var(--text-xs);">Lv.1 · 0 XP</span>
                </div>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="sidebar__nav">
            <a href="{{ url('/dashboard') }}" class="sidebar__nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                <span class="sidebar__nav-icon">📊</span>
                <span class="sidebar__nav-label" x-show="sidebarOpen" x-cloak>Dashboard</span>
            </a>
            <a href="{{ url('/courses') }}" class="sidebar__nav-item {{ request()->is('courses*') ? 'active' : '' }}">
                <span class="sidebar__nav-icon">📚</span>
                <span class="sidebar__nav-label" x-show="sidebarOpen" x-cloak>Kursus</span>
            </a>
            <a href="{{ url('/leaderboard') }}" class="sidebar__nav-item {{ request()->is('leaderboard') ? 'active' : '' }}">
                <span class="sidebar__nav-icon">🏆</span>
                <span class="sidebar__nav-label" x-show="sidebarOpen" x-cloak>Leaderboard</span>
            </a>
            <a href="{{ url('/profile') }}" class="sidebar__nav-item {{ request()->is('profile') ? 'active' : '' }}">
                <span class="sidebar__nav-icon">👤</span>
                <span class="sidebar__nav-label" x-show="sidebarOpen" x-cloak>Profil</span>
            </a>
            <a href="{{ url('/badges') }}" class="sidebar__nav-item {{ request()->is('badges') ? 'active' : '' }}">
                <span class="sidebar__nav-icon">🎖️</span>
                <span class="sidebar__nav-label" x-show="sidebarOpen" x-cloak>Badge</span>
            </a>
        </nav>

        {{-- Bottom: Logout --}}
        <div class="sidebar__bottom">
            <div class="sidebar__divider"></div>
            <a href="{{ route('logout.get') }}" class="sidebar__nav-item sidebar__logout" title="Keluar">
                <span class="sidebar__nav-icon">🚪</span>
                <span class="sidebar__nav-label" x-show="sidebarOpen" x-cloak>Keluar</span>
            </a>
        </div>
    </aside>

    {{-- Main Content Area --}}
    <div class="app-main" :class="{ 'app-main--shifted': sidebarOpen }">

        {{-- Top Bar --}}
        <header class="topbar">
            <div class="topbar__left">
                {{-- Sidebar Toggle --}}
                <button class="topbar__toggle" @click="sidebarOpen = !sidebarOpen" aria-label="Toggle sidebar">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="3" y1="6" x2="21" y2="6"/>
                        <line x1="3" y1="12" x2="21" y2="12"/>
                        <line x1="3" y1="18" x2="21" y2="18"/>
                    </svg>
                </button>
                @isset($header)
                    <div class="topbar__title">{{ $header }}</div>
                @endisset
            </div>

            <div class="topbar__right">
                {{-- XP Badge --}}
                <div class="topbar__xp">
                    <span>⚡ 0 XP</span>
                </div>

                {{-- User name --}}
                <span class="topbar__username">{{ Auth::user()->name }}</span>

                {{-- LOGOUT — link GET, tidak butuh JS/Alpine --}}
                <a href="{{ route('logout.get') }}" class="topbar__logout-btn">
                    🚪 Keluar
                </a>
            </div>
        </header>

        {{-- Page Content --}}
        <main class="app-content">
            {{ $slot }}
        </main>
    </div>

    {{-- Mobile Bottom Nav --}}
    <nav class="mobile-nav">
        <a href="{{ url('/dashboard') }}" class="mobile-nav__item {{ request()->is('dashboard') ? 'active' : '' }}">
            <span>📊</span><span>Home</span>
        </a>
        <a href="{{ url('/courses') }}" class="mobile-nav__item {{ request()->is('courses*') ? 'active' : '' }}">
            <span>📚</span><span>Kursus</span>
        </a>
        <a href="{{ url('/leaderboard') }}" class="mobile-nav__item {{ request()->is('leaderboard') ? 'active' : '' }}">
            <span>🏆</span><span>Rank</span>
        </a>
        <a href="{{ url('/profile') }}" class="mobile-nav__item {{ request()->is('profile') ? 'active' : '' }}">
            <span>👤</span><span>Profil</span>
        </a>
    </nav>
</div>

</body>
</html>
