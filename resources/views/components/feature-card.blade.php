@props(['title', 'icon', 'iconColor' => 'primary'])

@php
    $colorClass = match ($iconColor) {
        'primary' => 'text-primary',
        'secondary' => 'text-secondary',
        'tertiary' => 'text-tertiary-container',
        default => 'text-primary',
    };
    
    $borderHoverClass = match ($iconColor) {
        'primary' => 'hover:border-primary/50',
        'secondary' => 'hover:border-secondary/50',
        'tertiary' => 'hover:border-tertiary-container/50',
        default => 'hover:border-primary/50',
    };
    
    $gradientClass = match ($iconColor) {
        'primary' => 'from-primary/10',
        'secondary' => 'from-secondary/10',
        'tertiary' => 'from-tertiary-container/10',
        default => 'from-primary/10',
    };
@endphp

<div {{ $attributes->merge(['class' => 'p-8 rounded-xl bg-surface-container/50 backdrop-blur-xl border border-white/10 transition-colors group relative overflow-hidden ' . $borderHoverClass]) }}>
    <div class="absolute inset-0 bg-gradient-to-br {{ $gradientClass }} to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
    <span class="material-symbols-outlined text-4xl {{ $colorClass }} mb-6" style="font-variation-settings: 'FILL' 1;">{{ $icon }}</span>
    <h3 class="font-headline-lg-mobile text-headline-lg-mobile text-on-surface mb-4">{{ $title }}</h3>
    <div class="font-body-md text-body-md text-on-surface-variant mb-6">
        {{ $slot }}
    </div>
</div>
