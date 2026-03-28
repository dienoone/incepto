@props(['company'])

<a href="{{ route('companies.show', $company->slug) }}"
    class="card rounded-xl bg-surface shadow hover:-translate-y-0.5 hover:shadow-md transition-all duration-150">
    <div class="relative h-20 overflow-hidden rounded-xl rounded-b-none"
        style="background: linear-gradient(135deg, #0E0E10 0%, #1a1a2e 50%, #16213e 100%);">
        <div class="absolute inset-0 opacity-[0.15]"
            style="background-image: linear-gradient(rgba(255,255,255,0.3) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.3) 1px, transparent 1px); background-size: 32px 32px;">
        </div>
    </div>

    <div class="p-4">
        <div class="avatar shrink-0 -mt-15">
            <div class="w-12 h-12 rounded-xl bg-base-200">
                @if ($company->logo)
                    <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }}" />
                @else
                    <span class="text-ink-3 font-bold text-sm flex items-center justify-center w-full h-full">
                        {{ strtoupper(substr($company->name, 0, 2)) }}
                    </span>
                @endif
            </div>
        </div>
        <div class="flex items-center gap-2 mb-1">
            <h4 class="font-medium text-md text-ink">{{ $company->name }}</h4>
            <x-heroicon-s-check-badge class="w-4 h-4 shrink-0 text-primary" />
        </div>
        <p class="uppercase tracking-wider font-medium mb-2 text-2xs text-ink-4">
            {{ $company->industry }}
        </p>

        <div class="my-3">
            <div class="flex items-center gap-1">
                <div class="flex items-center gap-0.5">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= round($company->reviews_avg_rate ?? 0))
                            <x-heroicon-s-star class="w-4 h-4 text-warning" />
                        @else
                            <x-heroicon-o-star class="w-4 h-4 text-ink-4" />
                        @endif
                    @endfor
                </div>
                <p class="text-warning text-sm">
                    {{ number_format($company->reviews_avg_rate ?? 0, 1) }}
                </p>
                <p class="text-sm text-ink-4">
                    ({{ $company->reviews_count }} reviews)
                </p>
            </div>
        </div>


        <p class="line-clamp-2 mb-3 text-sm/normal text-ink-3">
            {{ $company->bio }}
        </p>
        <div class="flex items-center justify-between pt-3 border-t border-border">
            <span class="flex items-center gap-1 text-xs text-ink-2">
                <x-heroicon-o-map-pin class="w-3 h-3 text-ink-3" />
                {{ $company->address }}
            </span>
            <span class="font-medium rounded-full px-2.5 py-0.5 text-xs bg-primary/10 text-primary">
                {{ $company->jobs_count ?? $company->jobs()->count() }} open roles
            </span>
        </div>
    </div>
</a>
