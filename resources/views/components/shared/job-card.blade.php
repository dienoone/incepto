@props(['job', 'first' => false])

@php
    $isNew = $job->created_at->diffInHours() < 48;
@endphp

<article
    class="card bg-surface group border border-border transition-all duration-200 hover:shadow-md hover:translate-x-0.5">
    <div @class([
        'absolute left-0 top-3 bottom-3 w-[3px] rounded-r-sm bg-primary transition-opacity duration-200',
        'opacity-100' => $first,
        'opacity-0 group-hover:opacity-100' => !$first,
    ])></div>

    {{-- DESKTOP LAYOUT --}}
    <div class="hidden sm:grid sm:grid-cols-[auto_1fr_auto_auto] sm:gap-4 sm:items-center p-5 pl-6">
        <div class="avatar shrink-0">
            <div class="w-12 h-12 rounded-xl bg-base-200">
                @if ($job->company->logo)
                    <img src="{{ asset('storage/' . $job->company->logo) }}" alt="{{ $job->company->name }}" />
                @else
                    <span class="text-base-content/40 font-bold text-sm flex items-center justify-center w-full h-full">
                        {{ strtoupper(substr($job->company->name, 0, 2)) }}
                    </span>
                @endif
            </div>
        </div>

        <div class="min-w-0">
            <div class="flex items-center gap-2 flex-wrap mb-1">
                <h3 class="font-semibold text-base text-base-content truncate">
                    {{ $job->title }}
                </h3>
                @if ($isNew)
                    <x-ui.badge type="success" :dot="false">
                        New
                    </x-ui.badge>
                @endif
                <x-ui.badge type="info">
                    {{ $job->type->value }}
                </x-ui.badge>
                <x-ui.badge type="success">
                    {{ $job->arrangement->value }}
                </x-ui.badge>
            </div>

            <div class="flex items-center gap-3 flex-wrap mb-2">
                <span class="flex items-center gap-1 text-sm  text-ink-2">
                    <x-heroicon-o-briefcase class="w-3 h-3 shrink-0 text-ink-3" />
                    {{ $job->company->name }}
                </span>
                @if ($job->address)
                    <span class="flex items-center gap-1 text-sm text-ink-2">
                        <x-heroicon-o-map-pin class="w-3 h-3 shrink-0 text-ink-3" />
                        {{ $job->address }}
                    </span>
                @endif
                @if ($job->level)
                    <span class="text-sm text-ink-2">{{ $job->level }}</span>
                @endif
            </div>

            @if ($job->skills->isNotEmpty())
                <div class="flex flex-wrap gap-1.5">
                    @foreach ($job->skills->take(4) as $skill)
                        <x-ui.badge>
                            {{ $skill->name }}
                        </x-ui.badge>
                    @endforeach
                    @if ($job->skills->count() > 4)
                        <x-ui.badge>
                            +{{ $job->skills->count() - 4 }} more
                        </x-ui.badge>
                    @endif
                </div>
            @endif
        </div>

        <div class="text-right shrink-0">
            <div class="font-semibold text-base text-base-content">
                @if ($job->salary_min && $job->salary_max)
                    ${{ number_format($job->salary_min / 1000) }}k - ${{ number_format($job->salary_max / 1000) }}k
                @else
                    <span class="text-base-content/30">Undisclosed</span>
                @endif
            </div>
            <div class="text-xs text-base-content/40">
                per year · {{ $job->published_at?->diffForHumans() ?? $job->created_at->diffForHumans() }}
            </div>
        </div>

        <div class="flex items-center gap-2 shrink-0" @click.stop>
            <a href="{{ route('jobs.show', $job->slug) }}" class="btn btn-neutral btn-sm rounded-lg">
                Apply now
            </a>
            @auth
                @if (auth()->user()->role === 'seeker')
                    <form action="{{ route('seeker.bookmark', $job) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="btn btn-sm btn-square rounded-lg
                            {{ $job->isBookmarkedBy(auth()->user()) ? 'btn-neutral' : 'btn-outline' }}">
                            @if ($job->isBookmarkedBy(auth()->user()))
                                <x-heroicon-s-bookmark class="w-3.5 h-3.5" />
                            @else
                                <x-heroicon-o-bookmark class="w-3.5 h-3.5" />
                            @endif
                        </button>
                    </form>
                @endif
            @endauth
        </div>
    </div>

    {{-- MOBILE LAYOUT --}}
    <div class="sm:hidden p-4 pl-5 flex flex-col gap-3">
        <div class="flex items-start gap-3">
            <div class="avatar shrink-0">
                <div class="w-9 h-9 rounded-lg bg-base-200">
                    @if ($job->company->logo)
                        <img src="{{ asset('storage/' . $job->company->logo) }}" alt="{{ $job->company->name }}" />
                    @else
                        <span class="text-ink-3 font-bold text-xs flex items-center justify-center w-full h-full">
                            {{ strtoupper(substr($job->company->name, 0, 2)) }}
                        </span>
                    @endif
                </div>
            </div>
            <div class="flex-1 min-w-0">
                <div class="flex items-start justify-between gap-2">
                    <h3 class="font-semibold text-base text-ink-2">
                        {{ $job->title }}
                    </h3>
                    @auth
                        @if (auth()->user()->role === 'seeker')
                            <form action="{{ route('seeker.bookmark', $job) }}" method="POST" @click.stop>
                                @csrf
                                <button type="submit"
                                    class="btn btn-xs btn-square rounded-lg shrink-0
                                    {{ $job->isBookmarkedBy(auth()->user()) ? 'btn-neutral' : 'btn-outline' }}">
                                    @if ($job->isBookmarkedBy(auth()->user()))
                                        <x-heroicon-s-bookmark class="w-3 h-3" />
                                    @else
                                        <x-heroicon-o-bookmark class="w-3 h-3" />
                                    @endif
                                </button>
                            </form>
                        @endif
                    @endauth
                </div>
                <span class="text-sm text-ink-3 mt-0">{{ $job->company->name }}</span>
            </div>
        </div>

        <div class="flex flex-wrap gap-1.5">
            @if ($isNew)
                <x-ui.badge type="success" :dot="false">
                    New
                </x-ui.badge>
            @endif
            <x-ui.badge type="info">{{ $job->type->value }}</x-ui.badge>
            <x-ui.badge type="success">{{ $job->arrangement->value }}</x-ui.badge>
        </div>

        <div class="flex flex-wrap gap-x-3 gap-y-1">
            @if ($job->address)
                <span class="flex items-center gap-1 text-sm text-ink-2">
                    <x-heroicon-o-map-pin class="w-3 h-3 shrink-0 text-ink-3" />
                    {{ $job->address }}
                </span>
            @endif
            @if ($job->level)
                <span class="text-sm  text-ink-2">{{ $job->level }}</span>
            @endif
        </div>

        @if ($job->skills->isNotEmpty())
            <div class="flex flex-wrap gap-1.5">
                @foreach ($job->skills->take(3) as $skill)
                    <x-ui.badge> {{ $skill->name }} </x-ui.badge>
                @endforeach
                @if ($job->skills->count() > 3)
                    <x-ui.badge> +{{ $job->skills->count() - 4 }} more </x-ui.badge>
                @endif
            </div>
        @endif

        <div class="flex items-center justify-between pt-2.5 border-t border-border">
            <div>
                <div class="font-semibold text-base text-ink-2">
                    @if ($job->salary_min && $job->salary_max)
                        ${{ number_format($job->salary_min / 1000) }}k –
                        ${{ number_format($job->salary_max / 1000) }}k
                    @else
                        <span class="text-ink-3">Undisclosed</span>
                    @endif
                </div>
                <div class="text-xs text-ink-3">
                    {{ $job->published_at?->diffForHumans() ?? $job->created_at->diffForHumans() }}
                </div>
            </div>
            <a href="{{ route('jobs.show', $job->slug) }}" class="btn btn-neutral btn-sm rounded-lg">
                Apply now
            </a>
        </div>
    </div>
</article>
