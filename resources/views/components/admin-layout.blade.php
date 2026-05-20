<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin - {{ config('app.name', 'NgodingAJG') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;800&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .glass-panel {
            background-color: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .glow-active {
            box-shadow: 0 0 15px rgba(0, 240, 255, 0.3);
        }
    </style>
</head>
<body class="bg-background text-on-surface font-body-md text-body-md min-h-screen flex selection:bg-primary/30">

    <!-- Admin SideNavBar -->
    @include('layouts.admin-sidebar')

    <!-- Main Content Wrapper -->
    <div class="flex-1 lg:ml-64 flex flex-col min-h-screen">
        
        <!-- TopNavBar -->
        <header class="sticky top-0 w-full z-30 flex justify-between items-center px-gutter py-4 bg-surface/80 dark:bg-surface/80 backdrop-blur-xl border-b border-white/10 shadow-[0_0_15px_rgba(255,84,73,0.15)]">
            <div class="flex items-center gap-4">
                <h2 class="font-headline-lg text-headline-lg md:text-headline-lg-mobile font-bold hidden md:block text-error">
                    {{ $header ?? 'Admin Panel' }}
                </h2>
            </div>
            <div class="flex items-center gap-4">
                <button class="text-on-surface-variant hover:text-error transition-colors duration-200">
                    <span class="material-symbols-outlined">notifications</span>
                </button>
                
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center focus:outline-none">
                            <div class="w-10 h-10 rounded-full border border-error/50 bg-error/10 text-error flex items-center justify-center cursor-pointer hover:border-error transition-colors">
                                <span class="material-symbols-outlined text-sm">admin_panel_settings</span>
                            </div>
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

        <!-- Main Area Grid -->
        <main class="flex-1 p-gutter pb-32 lg:pb-gutter max-w-container-max mx-auto w-full grid grid-cols-1 xl:grid-cols-12 gap-8">
            {{ $slot }}
        </main>
    </div>

@stack('scripts')
</body>
</html>
