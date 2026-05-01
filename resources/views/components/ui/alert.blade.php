{{--
    Component: ui/alert
    Props:
        $type    : 'success' | 'error' | 'warning' | 'info'
        $message : string
        $dismissible : bool
--}}
@props([
    'type'        => 'info',
    'message'     => '',
    'dismissible' => true,
])

@php
    $configs = [
        'success' => [
            'bg'   => 'bg-emerald-50 border-emerald-200',
            'text' => 'text-emerald-800',
            'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
            'iconColor' => 'text-emerald-500',
        ],
        'error' => [
            'bg'   => 'bg-red-50 border-red-200',
            'text' => 'text-red-800',
            'icon' => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z',
            'iconColor' => 'text-red-500',
        ],
        'warning' => [
            'bg'   => 'bg-amber-50 border-amber-200',
            'text' => 'text-amber-800',
            'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z',
            'iconColor' => 'text-amber-500',
        ],
        'info' => [
            'bg'   => 'bg-brand-50 border-brand-200',
            'text' => 'text-brand-800',
            'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
            'iconColor' => 'text-brand-500',
        ],
    ];

    $cfg = $configs[$type] ?? $configs['info'];
@endphp

<div
    {{ $attributes->merge(['class' => "flex items-start gap-3 rounded-xl border px-4 py-3 text-sm {$cfg['bg']} {$cfg['text']}"]) }}
    @if($dismissible) x-data="{ show: true }" x-show="show" @endif
    role="alert"
>
    <svg class="w-5 h-5 flex-shrink-0 mt-0.5 {{ $cfg['iconColor'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $cfg['icon'] }}"/>
    </svg>

    <p class="flex-1 leading-snug">{{ $message }}</p>

    @if ($dismissible)
        <button
            @click="show = false"
            class="flex-shrink-0 opacity-60 hover:opacity-100 transition-opacity"
            aria-label="Tutup"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    @endif
</div>