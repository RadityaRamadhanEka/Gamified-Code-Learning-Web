<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'NgodingAJG') }} - Master the Void of Code</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;800&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">
    
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-on-background min-h-screen flex flex-col relative overflow-x-hidden selection:bg-primary-container selection:text-on-primary-container">
    
    <!-- Ambient Background Effects -->
    <div class="fixed inset-0 z-0 pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-secondary-container/10 blur-[100px]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] rounded-full bg-primary-container/10 blur-[100px]"></div>
    </div>

    <!-- TopNavBar -->
    <header class="sticky top-0 w-full z-50 flex justify-between items-center px-gutter py-4 bg-surface/80 dark:bg-surface/80 backdrop-blur-xl border-b border-white/10 shadow-[0_0_15px_rgba(0,219,233,0.15)]">
        <div class="flex items-center gap-4">
            <span class="font-headline-lg text-headline-lg font-black text-primary tracking-tighter">NgodingAJG</span>
        </div>
        <nav class="hidden md:flex gap-8">
            <a class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary transition-colors duration-200" href="#">Fitur</a>
            <a class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary transition-colors duration-200" href="#">Kursus</a>
            <a class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary transition-colors duration-200" href="#">Leaderboard</a>
        </nav>
        <div class="flex items-center gap-4">
            @auth
                <a class="bg-gradient-to-r from-primary to-secondary text-surface px-6 py-2 rounded-full font-label-caps text-label-caps hover:shadow-[0_0_15px_rgba(0,219,233,0.3)] transition-all" href="{{ url('/dashboard') }}">Dashboard</a>
            @else
                <a class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary transition-colors hidden md:block" href="{{ route('login') }}">Masuk</a>
                @if (Route::has('register'))
                    <a class="bg-gradient-to-r from-primary to-secondary text-surface px-6 py-2 rounded-full font-label-caps text-label-caps hover:shadow-[0_0_15px_rgba(0,219,233,0.3)] transition-all" href="{{ route('register') }}">Daftar</a>
                @endif
            @endauth
        </div>
    </header>

    <main class="flex-grow z-10">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="w-full py-12 px-gutter flex flex-col md:flex-row justify-between items-center gap-6 bg-surface-container-lowest dark:bg-surface-container-lowest border-t border-white/5 relative z-10">
        <div class="font-headline-lg-mobile text-headline-lg-mobile text-primary">NgodingAJG</div>
        <nav class="flex flex-wrap justify-center gap-6">
            <a class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary-fixed transition-colors opacity-80 hover:opacity-100" href="#">Fitur</a>
            <a class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary-fixed transition-colors opacity-80 hover:opacity-100" href="#">Kursus</a>
            <a class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary-fixed transition-colors opacity-80 hover:opacity-100" href="#">Leaderboard</a>
            <a class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary-fixed transition-colors opacity-80 hover:opacity-100" href="#">Privasi</a>
            <a class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary-fixed transition-colors opacity-80 hover:opacity-100" href="#">Termos</a>
        </nav>
        <div class="font-body-md text-body-md text-on-surface-variant text-center md:text-right">© {{ date('Y') }} NgodingAJG (Ngoding Asik Jadi Gampang).</div>
    </footer>

</body>
</html>
