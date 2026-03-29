{{--
|--------------------------------------------------------------------------
| Select Component
|--------------------------------------------------------------------------
| Props:
| @param string      $name          - Select name & id.
| @param string|null $label         - Fieldset legend label.
| @param string      $size          - Select size (xs|sm|md|lg). Default: sm.
| @param array       $options       - Associative array of [value => label] options.
| @param mixed       $selected      - Currently selected value (uses old() automatically).
| @param string|null $placeholder   - Optional empty first option label.
| @param string|null $error         - Validation error message.
--}}
@props([
    'name' => '',
    'label' => null,
    'size' => 'sm',
    'options' => [],
    'selected' => null,
    'placeholder' => null,
    'error' => null,
])
@php
    $id = $name;
    $hasError = $error || $errors->has($name);
    $errorMsg = $error ?? $errors->first($name);
    $oldValue = old($name, $selected);
@endphp

<fieldset class="fieldset my-0">
    @if ($label)
        <legend class="fieldset-legend text-xs font-normal">{{ $label }}</legend>
    @endif

    <select id="{{ $id }}" name="{{ $name }}" {{ $attributes->except(['class', 'name']) }}
        class="select select-{{ $size }} outline-none -mt-1 w-full {{ $hasError ? 'select-error' : '' }}">

        @if ($placeholder)
            <option value="" disabled @selected($oldValue === null || $oldValue === '')>
                {{ $placeholder }}
            </option>
        @endif

        @foreach ($options as $key => $optionLabel)
            <option value="{{ $key }}" @selected((string) $oldValue === (string) $key)>
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>

    @if ($hasError)
        <div class="text-xs text-error flex items-center gap-1 -mt-0.5">
            <x-heroicon-o-exclamation-circle class="w-3.5 h-3.5 shrink-0" />
            {{ $errorMsg }}
        </div>
    @endif
</fieldset>
