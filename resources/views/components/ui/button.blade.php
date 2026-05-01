@props([
    'type'    => 'button',
    'variant' => 'primary',   {{-- primary | secondary | danger --}}
    'href'    => null,
    'full'    => false,
])

@php
    $base = 'inline-flex items-center justify-center gap-2 font-semibold rounded-full px-6 py-3 text-sm transition focus-brand';

    $variants = [
        'primary'   => 'bg-brand-600 hover:bg-brand-700 text-white shadow-sm',
        'secondary' => 'bg-slate-100 hover:bg-slate-200 text-slate-800',
        'danger'    => 'bg-red-600 hover:bg-red-700 text-white',
    ];

    $classes = $base . ' ' . ($variants[$variant] ?? $variants['primary']) . ($full ? ' w-full' : '');
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