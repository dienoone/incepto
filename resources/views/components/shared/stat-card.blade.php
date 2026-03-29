{{--
|--------------------------------------------------------------------------
| Stat Card Component
|--------------------------------------------------------------------------
| Props:
| @param string $label    - The title of the metric.
| @param string $value    - The main numeric or text value.
| @param string $trend    - Optional badge text (e.g., +12%).
| @param bool   $trendUp  - true (green), false (red), null (gray).
| @param string $color    - Icon box color: blue, green, amber, purple.
--}}

@props([
    'label' => '',
    'value' => '0',
    'trend' => null,
    'trendUp' => null,
    'color' => 'blue',
    'icon',
])

@php
    $iconClasses = match ($color) {
        'green' => 'bg-success-bg text-success',
        'amber' => 'bg-warning-bg text-warning',
        'purple' => 'bg-purple-bg text-purple',
        default => 'bg-primary/8 text-primary',
    };

    $trendClasses = match (true) {
        $trendUp === true => 'bg-success-bg text-success',
        $trendUp === false => 'bg-danger-bg text-danger',
        default => 'bg-surface-2 text-ink-4',
    };
@endphp

<div {{ $attributes->merge(['class' => 'bg-surface rounded-xl p-4 lg:p-5 border border-border']) }}>
    <div class="flex items-center justify-between mb-3">
        <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 {{ $iconClasses }}">
            <x-dynamic-component :component="'heroicon-o-' . $icon" class="w-5 h-5" />
        </div>

        @if ($trend)
            <span class="rounded-full font-medium text-xs py-[0.1rem] px-[0.4rem] {{ $trendClasses }}">
                {{ $trend }}
            </span>
        @endif
    </div>

    <div class="text-4xl text-ink font-display leading-none mb-1">{{ $value }}</div>
    <div class="text-sm text-ink-3">{{ $label }}</div>
</div>
