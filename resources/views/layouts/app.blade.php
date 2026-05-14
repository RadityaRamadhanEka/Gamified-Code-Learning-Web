<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'NgodingAJG') }}</title>

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

    <!-- SideNavBar -->
    @include('layouts.app-sidebar')

    <!-- BottomNavBar (Mobile) -->
    @include('layouts.app-bottombar')

    <!-- Main Content Wrapper -->
    <div class="flex-1 lg:ml-64 flex flex-col min-h-screen">
        
        <!-- TopNavBar -->
        @include('layouts.app-topbar')

        <!-- Main Area Grid -->
        <main class="flex-1 p-gutter pb-32 lg:pb-gutter max-w-container-max mx-auto w-full grid grid-cols-1 xl:grid-cols-12 gap-8">
            {{ $slot }}
        </main>
    </div>

</body>
</html>
