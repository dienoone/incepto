{{--
|--------------------------------------------------------------------------
| Alert Component
|--------------------------------------------------------------------------
| Props:
| @param string  $type        - info, success, warning, danger.
| @param string  $title       - Bold heading.
| @param bool    $dismissible - Show close button.
--}}

@props([
    'type' => 'info',
    'title' => null,
    'dismissible' => false,
])

@php
    $config = match ($type) {
        'success' => [
            'class' => 'alert-success',
            'icon' => 'check-circle',
            'border' => 'border-success',
            'btn' => 'btn-success',
        ],
        'warning' => [
            'class' => 'alert-warning',
            'icon' => 'exclamation-triangle',
            'border' => 'border-warning',
            'btn' => 'btn-warning',
        ],
        'danger', 'error' => [
            'class' => 'alert-error',
            'icon' => 'exclamation-circle',
            'border' => 'border-error',
            'btn' => 'btn-error',
        ],
        default => [
            'class' => 'alert-info',
            'icon' => 'information-circle',
            'border' => 'border-info',
            'btn' => 'btn-info',
        ],
    };

    $baseClasses = "alert alert-soft items-start {$config['class']} border {$config['border']}";
    $buttonClasses = "btn btn-sm btn-outline btn-circle {$config['btn']}";
@endphp

<div x-data="{ show: true }" x-show="show" role="alert" {{ $attributes->merge(['class' => $baseClasses]) }}>
    <x-dynamic-component :component="'heroicon-o-' . $config['icon']" class="w-5 h-5 shrink-0" />

    <div class="flex-1 space-y-1">
        @if ($title)
            <h3 class="font-bold">{{ $title }}</h3>
        @endif
        <div class="text-sm">
            {{ $slot }}
        </div>
    </div>

    @if ($dismissible)
        <button type="button" @click="show = false" class="{{ $buttonClasses }}" aria-label="Close alert">
            <x-heroicon-m-x-mark class="w-4 h-4" />
        </button>
    @endif
</div>
