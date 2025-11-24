@props([
    'variant' => 'primary',
    'size' => 'md',
    'type' => 'button',
    'href' => null,
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-medium transition';

    $variants = [
        'primary' => 'bg-amber-950 text-white hover:bg-amber-900',
        'secondary' => 'bg-amber-600 text-gray-900 hover:bg-amber-500',
        'outline' => 'outline-2 -outline-offset-2 border-amber-950 text-amber-950 hover:bg-amber-50',
    ];

    $sizes = [
        'sm' => 'px-4 py-1.5 text-sm',
        'md' => 'px-6 py-2 text-base',
        'lg' => 'px-8 py-3 text-lg',
    ];

    $classes = $baseClasses . ' ' . $variants[$variant] . ' ' . $sizes[$size];
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
