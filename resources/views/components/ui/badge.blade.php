{{--
|--------------------------------------------------------------------------
| Badge Component
|--------------------------------------------------------------------------
| Props:
| @param string $type - primary, secondary, warning, success, info, fancy,
|                       full-time, part-time, remote, hybrid, on-site,
|                       contract, freelance, internship, chip
| @param bool   $dot  - Shows a small decorative dot before the text.
--}}

@props([
    'type' => 'chip',
    'dot' => false,
])

@php
    $daisyClass = match ($type) {
        'pending', 'part-time', 'warning' => 'badge-warning badge-soft',
        'reviewed', 'full-time', 'hybrid', 'primary', 'info' => 'badge-primary badge-soft',
        'accepted', 'remote', 'success' => 'badge-success badge-soft',
        'interview', 'internship', 'fancy' => 'badge-secondary badge-soft',
        'rejected', 'declined', 'contract', 'temporary', 'closed' => 'badge-ghost bg-base-200 text-base-content/70',
        'neutral' => 'badge-neutral text-surface',
        default => 'badge-ghost bg-base-200 text-ink-3',
    };

    $showDot = $dot || in_array($type, ['pending', 'reviewed', 'interview', 'accepted', 'rejected', 'declined']);

    $dotColor = match (true) {
        str_contains($daisyClass, 'badge-warning') => 'bg-warning',
        str_contains($daisyClass, 'badge-primary') => 'bg-primary',
        str_contains($daisyClass, 'badge-success') => 'bg-success',
        str_contains($daisyClass, 'badge-secondary') => 'bg-secondary',
        default => 'bg-current opacity-50',
    };
@endphp

<div {{ $attributes->merge(['class' => "badge badge-sm gap-1.5 {$daisyClass}"]) }}>
    @if ($showDot)
        <span class="w-1.5 h-1.5 rounded-full shrink-0 {{ $dotColor }}"></span>
    @endif

    <span>
        {{ $slot }}
    </span>
</div>
