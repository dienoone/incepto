@props([
    'name' => 'tabs_' . Str::random(8),
    'tabs' => [], // => ['tab_id' => 'Tab Label']
    'active' => null,
])

<div {{ $attributes->merge(['class' => 'tabs tabs-border space-y-6 w-full h-auto']) }}>
    @foreach ($tabs as $id => $label)
        @php
            $isActive = $active === $id || (is_null($active) && $loop->first);
        @endphp

        <input type="radio" name="{{ $name }}" role="tab" class="tab" aria-label="{{ $label }}"
            @checked($isActive) />

        <div role="tabpanel" class="tab-content border-base-300 bg-base-100 p-10">
            {{ ${$id} ?? "Content for {$label} is missing." }}
        </div>
    @endforeach
</div>
