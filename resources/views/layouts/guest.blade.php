<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title . ' — NgodingAJG' : 'NgodingAJG - Authentication' }}</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;800&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">
    
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background min-h-screen flex items-center justify-center relative overflow-hidden font-body-md text-body-md text-on-surface">
    <!-- Deep Space Background Layer -->
    <div class="absolute inset-0 z-0 bg-cover bg-center bg-no-repeat opacity-40 mix-blend-screen" data-alt="A mesmerizing deep space nebula background for a futuristic sci-fi user interface. Swirling clouds of luminescent cyan and deep violet cosmic dust drift against a pitch-black void. The lighting is dark and moody, punctuated by scattered bright stars and a soft, ethereal glow from the gas formations. The aesthetic is highly polished, cinematic, and perfectly suited for a dark glassmorphism overlay." style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDSM4rkscJ82I4513xrKApoUdIhgpPB8zA03XUMtIL9rjqDiTnElaysyyUgXRmrNAUUhq24w1G9atomwVqNRYlP812-oQIt_KQKpjD9isnNro2R_tuhfuxWUQRkPGyRLJiTXWC1c9T8nAbp0at5Z0UaiyD1omROtL3cLjy4hrqlvjpMQjqEZrfXCvGRoE-NXKwRNN1Gf_8zC9mxCpMepbTmqdN6bdqakvN2_-xj57vjJGVrn1E1Mh4G67wQLIKMW8mLmgwpS5iOPN8');">
    </div>
    <!-- Tonal Layering Overlay -->
    <div class="absolute inset-0 z-0 bg-gradient-to-b from-background/80 via-background/90 to-background"></div>

    {{ $slot }}
</body>
</html>
