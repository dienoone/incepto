@props([
    'href',
    'icon' => 'document-text',
    'badge' => false,
    'badgeValue' => 0,
    'active' => false,
    'type' => 'info',
])

@php
    $color = match ($type) {
        'success' => 'bg-success-bg text-success',
        'warning' => 'bg-warning-bg text-warning',
        default => 'bg-primary/5 text-primary',
    };

    $baseClasses =
        'font-body text-sm font-normal py-2 px-2.5 mb-px flex items-center gap-2.5 rounded-lg no-underline cursor-pointer transition-all duration-150';

    $activeClasses = $active
        ? 'bg-primary/5 text-primary font-medium'
        : 'text-ink-3 hover:bg-surface-2 hover:text-ink-2';

    $iconClasses = $active ? 'text-primary' : 'text-ink-4';
@endphp

@if (isset($href))
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $baseClasses . ' ' . $activeClasses]) }}>
        <x-dynamic-component :component="'heroicon-o-' . $icon"
            class="w-4 h-4 shrink-0 transition-colors duration-150 {{ $iconClasses }}" />
        {{ $slot }}
        @if ($badge)
            <x-ui.badge class="text-xs py-[0.1rem] px-[0.4rem] ml-auto rounded-full font-medium {{ $color }}">
                {{ $badgeValue }}
            </x-ui.badge>
        @endif
    </a>
@else
    <button type="submit" {{ $attributes->merge(['class' => $baseClasses]) }}>
        <x-dynamic-component :component="'heroicon-o-' . $icon"
            class="w-4 h-4 shrink-0 transition-colors duration-150 {{ $iconClasses }}" />
        {{ $slot }}
    </button>
@endif
