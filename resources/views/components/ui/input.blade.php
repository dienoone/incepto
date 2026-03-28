{{--
|--------------------------------------------------------------------------
| Input Component (DaisyUI)
|--------------------------------------------------------------------------
| Props:
| @param string      $name          - Input name & id.
| @param string      $type          - Input type (text|email|password|...). Default: text.
| @param string      $label         - Fieldset legend label.
| @param string      $placeholder   - Input placeholder.
| @param mixed       $value         - Input value (uses old() automatically).
| @param string|null $icon          - Heroicon name for left icon (e.g. "envelope").
| @param bool        $showToggle    - Show password visibility toggle (password only).
| @param string|null $error         - Validation error message.
| @param string|null $autocomplete  - Autocomplete attribute.
--}}
@props([
    'name' => '',
    'type' => 'text',
    'label' => '',
    'placeholder' => '',
    'value' => '',
    'icon' => null,
    'showToggle' => false,
    'error' => null,
    'autocomplete' => null,
])

@php
    $id = $name;
    $hasError = $error || $errors->has($name);
    $errorMsg = $error ?? $errors->first($name);
    $isPassword = $type === 'password';
    $oldValue = old($name, $value);
@endphp

<fieldset class="fieldset my-0" @if ($isPassword && $showToggle) x-data="{ showPass: false }" @endif>

    @if ($label)
        <legend class="fieldset-legend text-xs font-normal">{{ $label }}</legend>
    @endif

    <label
        class="input input-sm rounded-lg -mt-1 outline-none focus-within:outline-none {{ $hasError ? 'input-error' : '' }} w-full">

        {{-- Left icon --}}
        @if ($icon)
            @switch($icon)
                @case('envelope')
                    <x-heroicon-o-envelope class="w-4 h-4 opacity-50 shrink-0" />
                @break

                @case('lock-closed')
                    <x-heroicon-c-lock-closed class="w-3.5 h-3.5 opacity-50 shrink-0" />
                @break

                @case('building-office-2')
                    <x-heroicon-o-building-office-2 class="w-4 h-4 opacity-50 shrink-0" />
                @break

                @case('user')
                    <x-heroicon-o-user class="w-4 h-4 opacity-50 shrink-0" />
                @break

                @default
                    <x-dynamic-component :component="'heroicon-o-' . $icon" class="w-4 h-4 opacity-50 shrink-0" />
            @endswitch
        @endif

        {{-- Input --}}
        @if ($isPassword && $showToggle)
            <input id="{{ $id }}" name="{{ $name }}" :type="showPass ? 'text' : 'password'"
                placeholder="{{ $placeholder }}"
                @if ($autocomplete) autocomplete="{{ $autocomplete }}" @endif
                {{ $attributes->except(['class', 'name', 'type', 'placeholder', 'value', 'autocomplete']) }}
                class="grow" />
        @else
            <input id="{{ $id }}" name="{{ $name }}" type="{{ $type }}"
                placeholder="{{ $placeholder }}" value="{{ $oldValue }}"
                @if ($autocomplete) autocomplete="{{ $autocomplete }}" @endif
                {{ $attributes->except(['class', 'name', 'type', 'placeholder', 'value', 'autocomplete']) }}
                class="grow" />
        @endif

        {{-- Password toggle --}}
        @if ($isPassword && $showToggle)
            <label class="swap">
                <input type="checkbox" x-model="showPass" />
                <x-heroicon-m-eye-slash class="w-3.5 h-3.5 swap-on" />
                <x-heroicon-m-eye class="w-3.5 h-3.5 swap-off" />
            </label>
        @endif

    </label>

    {{-- Error message --}}
    @if ($hasError)
        <div class="text-xs text-error flex items-center gap-1 -mt-0.5">
            <x-heroicon-o-exclamation-circle class="w-3.5 h-3.5 shrink-0" />
            {{ $errorMsg }}
        </div>
    @endif

</fieldset>
