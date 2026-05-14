@props(['value', 'label', 'color' => 'primary'])

@php
    $colorClass = match ($color) {
        'primary' => 'text-primary',
        'secondary' => 'text-secondary',
        'tertiary' => 'text-tertiary-container',
        'primary-fixed' => 'text-primary-fixed',
        default => 'text-primary',
    };
@endphp

<div class="flex flex-col items-center">
    <span class="font-headline-lg text-headline-lg {{ $colorClass }}">{{ $value }}</span>
    <span class="font-label-caps text-label-caps text-on-surface-variant mt-2">{{ $label }}</span>
</div>
