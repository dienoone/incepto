{{--
|--------------------------------------------------------------------------
| Radio Card Component (DaisyUI)
|--------------------------------------------------------------------------
| Props:
| @param string $label   - The main title of the card.
| @param string $desc    - Optional smaller description text.
| @param string $value   - The value submitted with the form.
| @param bool   $checked - Initial checked state.
--}}
@props([
    'label' => '',
    'desc' => '',
    'value' => '',
    'checked' => false,
])

@php
    $name = $attributes->get('name', 'radio');
    $id = $name . '_' . $value;
    $isChecked = $checked || old($name) == $value;
@endphp

<label for="{{ $id }}" class="relative cursor-pointer block group">

    <input type="radio" id="{{ $id }}" name="{{ $name }}" value="{{ $value }}"
        @checked($isChecked) {{ $attributes->except(['class', 'id', 'name', 'value', 'checked']) }}
        class="sr-only" />

    <div
        class="flex flex-col items-center gap-3 h-full rounded-xl p-4 text-center
                transition-all duration-200 border-[1.5px] relative overflow-hidden
                bg-base-100 border-base-300
                group-has-checked:border-primary group-has-checked:bg-primary/5 group-has-checked:shadow-sm">

        {{-- Check badge --}}
        <div
            class="absolute top-2 right-2 z-10 opacity-0 scale-75 transition-all duration-200
                    group-has-checked:opacity-100 group-has-checked:scale-100">
            <x-heroicon-s-check-circle class="w-5 h-5 text-primary" />
        </div>

        {{-- Icon slot --}}
        <div
            class="w-10 h-10 rounded-lg flex items-center justify-center transition-all duration-200 shrink-0
                    bg-base-200 text-base-content/40
                    group-has-checked:bg-primary group-has-checked:text-primary-content group-has-checked:scale-110">
            {{ $slot }}
        </div>

        {{-- Text --}}
        <div class="space-y-0.5">
            <p
                class="font-medium text-sm transition-colors duration-200
                       text-base-content/70 group-has-checked:text-primary">
                {{ $label }}
            </p>
            @if ($desc)
                <p class="text-xs text-base-content/40 leading-relaxed group-has-checked:text-primary/70">
                    {{ $desc }}
                </p>
            @endif
        </div>

    </div>
</label>
