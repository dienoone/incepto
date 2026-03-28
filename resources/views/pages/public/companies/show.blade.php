<x-layouts.public :title="$company->name">
    <div class="max-w-7xl mx-auto px-4 lg:px-8 py-6 lg:py-8">
        <div class="breadcrumbs text-sm mb-5">
            <ul>
                <li><a href="{{ route('home') }}" class="text-ink-3 hover:text-primary">Home</a></li>
                <li><a href="{{ route('companies.index') }}" class="text-ink-3 hover:text-primary">Companies</a></li>
                <li class="text-ink-2 truncate max-w-50">{{ $company->name }}</li>
            </ul>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-[1fr_340px] gap-6 items-start">
            <div class="min-w-0">
                <div class="card bg-surface border border-border overflow-hidden mb-5 company-hero">
                    <div class="relative h-36 sm:h-44 lg:h-48 group overflow-hidden"
                        style="@if ($company->cover) background: url('{{ asset('storage/' . $company->cover) }}') center/cover; @else background: linear-gradient(135deg, var(--color-ink) 0%, #1a2a6c 50%, var(--color-accent) 100%); @endif">
                        <div class="absolute inset-0 bg-linear-to-t from-black/60 via-black/10 to-transparent"></div>
                        <div
                            class="absolute inset-0 bg-black/15 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>

                        <div class="absolute top-4 right-4 sm:top-5 sm:right-5 flex items-center gap-2 z-10">
                            @auth
                                @if (auth()->user()->role->value === 'seeker')
                                    <form action="#" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-sm btn-outline border-white/30 bg-black/20 backdrop-blur text-white hover:bg-white/20 hover:border-white/50">
                                            @if ($isFollowing)
                                                <x-heroicon-s-check class="w-3.5 h-3.5" />
                                                Following
                                            @else
                                                <x-heroicon-m-plus class="w-3.5 h-3.5" />
                                                Follow
                                            @endif
                                        </button>
                                    </form>
                                @endif
                            @endauth
                            <a href="{{ route('jobs.index', ['q' => $company->name]) }}"
                                class="btn btn-sm btn-outline border-white/30 bg-black/20 backdrop-blur text-white hover:bg-white/20 hover:border-white/50">
                                <x-heroicon-o-briefcase class="w-3.5 h-3.5" />
                                <span class="hidden sm:inline">View jobs</span>
                                <span class="sm:hidden">Jobs</span>
                            </a>
                        </div>
                    </div>

                    <div class="px-5 lg:px-8 pb-5 lg:pb-6">
                        <div class="-mt-9 mb-4">
                            <div class="avatar">
                                <div class="w-16 h-16 rounded-xl ring-3 ring-white shadow-sm">
                                    <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }}" />
                                </div>
                            </div>
                        </div>

                        <div class="mb-4 flex flex-col md:flex-row justify-between">
                            <div>
                                <div class="flex items-center gap-2.5 mb-1 flex-wrap">
                                    <h1 class="font-display text-xl md:text-3xl lg:text-4xl tracking-tight text-ink">
                                        {{ $company->name }}
                                    </h1>
                                    <div
                                        class="w-4 h-4 p-1 rounded-full bg-primary flex items-center justify-center shrink-0">
                                        <x-heroicon-m-check class="w-3 h-3 text-white" />
                                    </div>
                                </div>
                                <p class="text-sm sm:text-base text-ink-3 font-light">{{ $company->industry }}</p>
                            </div>

                            <div class="flex items-center gap-6 pt-4">
                                <div class="text-center">
                                    <p class="font-display text-2xl leading-none text-ink">{{ $company->jobs_count }}
                                    </p>
                                    <p class="text-xs text-ink-4 mt-0.5">Open jobs</p>
                                </div>
                                <div class="w-px h-8 bg-border"></div>
                                <div class="text-center">
                                    <p class="font-display text-2xl leading-none text-ink">
                                        {{ $company->follows_count }}
                                    </p>
                                    <p class="text-xs text-ink-4 mt-0.5">Followers</p>
                                </div>
                                <div class="w-px h-8 bg-border"></div>
                                <div class="text-center">
                                    <p class="font-display text-2xl leading-none text-ink">
                                        {{ number_format($company->reviews_avg_rate ?? 0, 1) }}</p>
                                    <p class="text-xs text-ink-4 mt-0.5">Rating</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-x-5 gap-y-2 pt-4 border-t border-border">
                            <span class="flex items-center gap-1.5 text-sm text-ink-3">
                                <x-heroicon-o-map-pin class="w-3.5 h-3.5 shrink-0 text-ink-4" />
                                {{ $company->address }}
                            </span>
                            @if ($company->website)
                                <a href="{{ $company->website }}" target="_blank"
                                    class="flex items-center gap-1.5 no-underline transition-colors text-sm text-primary hover:underline">
                                    <x-heroicon-o-globe-alt class="w-3.5 h-3.5 shrink-0" />
                                    {{ parse_url($company->website, PHP_URL_HOST) }}
                                </a>
                            @endif
                            <span class="flex items-center gap-1.5 text-sm text-ink-3">
                                <x-heroicon-o-calendar class="w-3.5 h-3.5 shrink-0 text-ink-4" />
                                Founded
                                <strong class="font-medium text-ink-2">
                                    {{ $company->founded_year }}
                                </strong>
                            </span>
                            <span class="flex items-center gap-1 text-sm text-ink-3">
                                <x-heroicon-o-users class="w-3.5 h-3.5 shrink-0 text-ink-4" />
                                <strong class="font-medium text-ink-2">{{ $company->size }}</strong>
                                <span>employees</span>
                            </span>
                            <span class="flex items-center gap-1 text-sm text-ink-3">
                                <x-heroicon-o-star class="w-3.5 h-3.5 shrink-0 text-ink-4" />
                                <strong class="font-medium text-ink-2">
                                    {{ number_format($company->reviews_avg_rate ?? 0, 1) }}
                                </strong>
                                <span>rating ({{ $company->reviews_count }} reviews)</span>
                            </span>
                        </div>
                    </div>
                </div>
                {{-- /company hero --}}

                {{-- ── TABS ─────────────────────────────────── --}}
                <div x-data="{ tab: '{{ request('tab', 'about') }}' }">

                    {{-- Tab nav --}}
                    <div class="rounded-xl bg-surface border border-border mb-5 overflow-x-auto scrollbar-none">
                        <div class="flex gap-0 min-w-max border-b border-border">
                            @php
                                $tabs = [
                                    'about' => ['label' => 'About', 'count' => null],
                                    'jobs' => ['label' => 'Jobs', 'count' => $company->jobs_count],
                                    'teams' => ['label' => 'Teams', 'count' => $company->teams->count()],
                                    'reviews' => ['label' => 'Reviews', 'count' => $company->reviews_count],
                                    'members' => ['label' => 'Team members', 'count' => null],
                                ];
                                if ($company->benefits->isNotEmpty()) {
                                    $tabs['benefits'] = ['label' => 'Benefits', 'count' => null];
                                }
                            @endphp
                            @foreach ($tabs as $key => $tab)
                                <button @click="tab = '{{ $key }}'"
                                    class="px-5 py-3.5 font-medium transition-all duration-150 relative border-0 bg-transparent cursor-pointer whitespace-nowrap text-sm"
                                    :class="tab === '{{ $key }}' ? 'text-ink' : 'text-ink-3 hover:text-ink'">
                                    {{ $tab['label'] }}
                                    @if ($tab['count'] !== null)
                                        <span class="text-xs px-1.5 py-0.5 rounded-full bg-surface-2 text-ink-3 ml-1.5"
                                            :class="tab === '{{ $key }}' ? 'bg-surface-3 text-ink-2' : ''">
                                            {{ $tab['count'] }}
                                        </span>
                                    @endif
                                    <div class="absolute bottom-0 left-0 right-0 h-0.5 rounded-full transition-all duration-150"
                                        :class="tab === '{{ $key }}' ? 'bg-ink opacity-100' : 'opacity-0'">
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    {{-- ── ABOUT ─────────────────────────────── --}}
                    <div x-show="tab === 'about'" x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">

                        {{-- Bio --}}
                        <div class="rounded-xl bg-surface border border-border p-5 lg:p-8 mb-4">
                            <h3 class="font-display text-xl mb-3 text-ink">About {{ $company->name }}</h3>
                            <p class="text-xs sm:text-base text-ink-2 leading-loose">{{ $company->bio }}</p>
                        </div>

                        {{-- Missions / Values --}}
                        @if ($company->missions->isNotEmpty())
                            <div class="rounded-xl bg-surface border border-border p-5 lg:p-8 mb-4">
                                <h4 class="font-medium text-xl font-display mb-3 text-ink">Our values</h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    @foreach ($company->missions as $mission)
                                        <div class="p-4 rounded-xl bg-surface-2 border border-border">
                                            @if ($mission->icon)
                                                <div
                                                    class="w-8 h-8 rounded-lg flex items-center justify-center bg-surface border border-border text-ink-3 mb-3">
                                                    @php echo \Blade::render("<x-heroicon-o-{$mission->icon} class=\"w-4 h-4\" />") @endphp
                                                </div>
                                            @endif
                                            <p class="font-medium text-sm text-ink mb-1">{{ $mission->title }}</p>
                                            @if ($mission->body)
                                                <p class="text-xs text-ink-3 leading-relaxed">{{ $mission->body }}</p>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Company photos --}}
                        @if ($company->companyImages->isNotEmpty())
                            <div class="rounded-xl bg-surface border border-border p-5 lg:p-8 shadow">
                                <h4 class="font-medium font-display text-xl mb-3 text-ink">
                                    Life at {{ $company->name }}
                                </h4>
                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5">
                                    @foreach ($company->companyImages as $index => $image)
                                        <div
                                            class="group aspect-video rounded-xl overflow-hidden bg-surface-2 relative cursor-pointer">
                                            <img src="{{ asset('storage/' . $image->path) }}" alt="Company photo"
                                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                            <div
                                                class="absolute inset-0 bg-linear-to-t from-black/50 via-black/5 to-transparent">
                                            </div>
                                            <div
                                                class="absolute inset-0 bg-black/25 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                            </div>
                                            <div
                                                class="absolute inset-0 p-4 opacity-0 group-hover:opacity-100 transition-all duration-300 translate-y-1 group-hover:translate-y-0">
                                                <div class="px-3 py-1.5 rounded-full text-white text-xs font-medium tracking-widest uppercase inline-block"
                                                    style="background: rgba(255,255,255,0.12); backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,0.2);">
                                                    <span
                                                        class="opacity-60 text-[0.6rem]">#</span>{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                    {{-- /about tab --}}

                    {{-- ── JOBS ──────────────────────────────── --}}
                    <div x-show="tab === 'jobs'" x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-cloak>
                        @if ($company->jobs->isEmpty())
                            <div class="py-16 text-center">
                                <x-heroicon-o-briefcase class="w-10 h-10 mx-auto mb-3 text-ink-4" />
                                <p class="text-sm text-ink-3">No open positions right now.</p>
                            </div>
                        @else
                            <div class="flex flex-col gap-3">
                                @foreach ($company->jobs as $job)
                                    <x-shared.job-card :job="$job" />
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- ── TEAMS ───────────────────────────────────────── --}}
                    <div role="tabpanel" x-show="tab === 'teams'" x-transition x-cloak>
                        @if ($company->teams->isEmpty())
                            <div class="card bg-surface border border-base-200 p-10 text-center">
                                <p class="text-sm text-ink-3">No teams listed yet.</p>
                            </div>
                        @else
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach ($company->teams as $team)
                                    <label for="team-modal-{{ $team->id }}"
                                        class="card bg-base-100 border border-base-200 overflow-hidden cursor-pointer transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md hover:border-base-300">
                                        <div class="h-20 relative overflow-hidden bg-neutral">
                                            @if ($team->cover)
                                                <img src="{{ asset('storage/' . $team->cover) }}"
                                                    alt="{{ $team->name }}"
                                                    class="absolute inset-0 w-full h-full object-cover" />
                                            @else
                                                <div
                                                    class="absolute inset-0 bg-[radial-gradient(ellipse_80%_80%_at_110%_50%,rgba(45,91,227,0.6),transparent)]">
                                                </div>
                                            @endif
                                            <div class="absolute inset-0 bg-black/30"></div>
                                            <div class="absolute bottom-3 left-4 z-10">
                                                <p class="text-sm font-semibold text-white">{{ $team->name }}</p>
                                            </div>
                                        </div>
                                        <div class="p-4">
                                            <p class="line-clamp-2 mb-3 text-sm text-base-content/50 leading-normal">
                                                {{ $team->description }}
                                            </p>
                                            <div class="flex items-center gap-2">
                                                <div class="flex -space-x-1.5">
                                                    @foreach ($team->members->take(4) as $member)
                                                        <div class="avatar avatar-placeholder">
                                                            <div
                                                                class="w-6 bg-neutral text-neutral-content rounded-full border-2 border-ink-3">
                                                                <span class="text-2xs">
                                                                    {{ strtoupper(substr($member->name, 0, 2)) }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <span class="text-xs text-base-content/40">
                                                    {{ $team->members->count() }} members
                                                </span>
                                            </div>
                                        </div>
                                    </label>

                                    {{-- DaisyUI modal --}}
                                    <input type="checkbox" id="team-modal-{{ $team->id }}"
                                        class="modal-toggle" />
                                    <div class="modal modal-bottom sm:modal-middle" role="dialog">
                                        <div
                                            class="modal-box p-0 max-w-2xl max-h-[85vh] flex flex-col overflow-hidden rounded-2xl">
                                            {{-- Modal header --}}
                                            <div
                                                class="flex items-start justify-between gap-4 p-6 shrink-0 border-b border-border">
                                                <div>
                                                    <h3 class="font-medium font-display text-2xl">{{ $team->name }}
                                                    </h3>
                                                    <p class="mt-1 text-sm text-base-content/50">
                                                        {{ $team->description }}
                                                    </p>
                                                </div>
                                                <label for="team-modal-{{ $team->id }}"
                                                    class="btn btn-sm btn-square btn-ghost rounded-lg shrink-0">
                                                    <x-heroicon-m-x-mark class="w-4 h-4" />
                                                </label>
                                            </div>
                                            {{-- Members list --}}
                                            <div
                                                class="overflow-y-auto flex-1 p-6 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                    @foreach ($team->members as $member)
                                                        <div
                                                            class="flex items-start gap-3 p-4 rounded-xl bg-surface-3 border border-border">
                                                            <div class="avatar avatar-placeholder shrink-0">
                                                                <div
                                                                    class="w-10 rounded-full bg-neutral text-neutral-content">
                                                                    <span
                                                                        class="text-xs font-semibold">{{ strtoupper(substr($member->name, 0, 2)) }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="min-w-0">
                                                                <p class="font-semibold truncate text-sm">
                                                                    {{ $member->name }}</p>
                                                                <p
                                                                    class="truncate mb-1.5 text-xs text-base-content/50">
                                                                    {{ $member->position }}</p>
                                                                <p
                                                                    class="line-clamp-2 text-xs text-base-content/40 leading-normal">
                                                                    {{ $member->bio }}</p>
                                                                @if ($member->linkedin)
                                                                    <a href="{{ $member->linkedin }}" target="_blank"
                                                                        class="inline-flex items-center gap-1 mt-2 text-xs text-primary hover:underline">
                                                                        <x-heroicon-m-link class="w-3 h-3" />
                                                                        LinkedIn
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <label class="modal-backdrop"
                                            for="team-modal-{{ $team->id }}">Close</label>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- ── REVIEWS ───────────────────────────── --}}
                    <div x-show="tab === 'reviews'" x-transition x-cloak>
                        @if ($company->reviews->isEmpty())
                            <div class="card p-10 text-center">
                                <p class="text-sm text-ink-3">No reviews yet.</p>
                            </div>
                        @else
                            {{-- Rating summary --}}
                            <div
                                class="card bg-surface p-6 mb-5 flex items-center flex-row gap-8 border border-border shadow">
                                <div class="text-center">
                                    <p class="font-display leading-none mb-1 text-7xl text-ink">
                                        {{ number_format($company->reviews_avg_rate ?? 0, 1) }}
                                    </p>
                                    <div class="flex items-center gap-0.5 justify-center mb-1">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= round($company->reviews_avg_rate ?? 0))
                                                <x-heroicon-s-star class="w-4 h-4 text-warning" />
                                            @else
                                                <x-heroicon-o-star class="w-4 h-4 text-ink-4" />
                                            @endif
                                        @endfor
                                    </div>
                                    <p class="text-sm text-ink-4">
                                        {{ $company->reviews_count }} reviews
                                    </p>
                                </div>
                                <div class="flex-1 min-w-48">
                                    @foreach ([5, 4, 3, 2, 1] as $star)
                                        @php
                                            $count = $company->reviews
                                                ->where('rate', '>=', $star)
                                                ->where('rate', '<', $star + 1)
                                                ->count();
                                        @endphp
                                        <div class="flex items-center gap-2 mb-1.5">
                                            <span class="text-xs text-ink-4 w-4">{{ $star }}</span>
                                            <x-heroicon-s-star class="w-3 h-3 shrink-0 text-warning" />
                                            <div class="flex-1 rounded-full overflow-hidden h-1 bg-surface-3">
                                                <div class="h-full rounded-full transition-all duration-300"
                                                    style="width: {{ $company->reviews_count > 0 ? ($count / $company->reviews_count) * 100 : 0 }}%; background: var(--color-warning);">
                                                </div>
                                            </div>
                                            <span class="text-xs text-ink-4 w-6">{{ $count }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="flex flex-col gap-4">
                                @foreach ($company->reviews as $review)
                                    <div class="rounded-xl bg-surface border border-border p-5 lg:p-6 shadow">
                                        <div class="flex items-start justify-between gap-4 mb-4">
                                            <div class="flex items-center gap-3">
                                                <div class="avatar avatar-placeholder">
                                                    <div class="bg-neutral text-neutral-content w-10 rounded-full">
                                                        <span>AN</span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <p class="font-medium text-base text-ink">Anonymous</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center gap-1 shrink-0">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $review->rate)
                                                        <x-heroicon-s-star class="w-3.5 h-3.5 text-warning" />
                                                    @else
                                                        <x-heroicon-o-star class="w-3.5 h-3.5 text-ink-4" />
                                                    @endif
                                                @endfor
                                                <span class="ml-1 font-medium text-sm text-ink">
                                                    {{ $review->rate }}
                                                </span>
                                            </div>
                                        </div>

                                        <h4 class="font-medium mb-3 text-md">
                                            {{ $review->title }}
                                        </h4>

                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                                            <div
                                                class="p-3 rounded-xl bg-success-bg border border-[rgba(26,158,107,0.15)]">
                                                <p class="font-medium mb-1 text-xs text-success uppercase"
                                                    style="letter-spacing: 0.05em;">
                                                    Pros
                                                </p>
                                                <p class="text-sm/normal text-ink-2">
                                                    {{ $review->pros }}
                                                </p>
                                            </div>
                                            <div
                                                class="p-3 rounded-xl bg-danger-bg border border-[rgba(214,59,59,0.15)]">
                                                <p class="font-medium mb-1 text-xs text-danger uppercase"
                                                    style="letter-spacing: 0.05em;">
                                                    Cons
                                                </p>
                                                <p class="text-sm/normal text-ink-2">{{ $review->cons }}
                                                </p>
                                            </div>
                                        </div>

                                        <p class="text-sm/normal text-ink-3">
                                            {{ $review->details }}
                                        </p>

                                        <div
                                            class="flex items-center justify-between mt-4 pt-4 border-t border-border">
                                            <span class="text-xs text-ink-4">
                                                {{ $review->created_at->diffForHumans() }}
                                            </span>
                                            <div class="flex items-center gap-1.5 text-xs text-ink-4">
                                                <x-heroicon-m-hand-thumb-up class="w-3.5 h-3.5" />
                                                {{ $review->likes }} found this helpful
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- MEMBERS --}}
                    <div x-show="tab === 'members'" x-transition x-cloak>
                        @if ($company->members->isEmpty())
                            <div class="rounded-xl bg-surface border border-border p-10 shadow">
                                <p class="text-sm text-ink-3">No team members listed yet.</p>
                            </div>
                        @else
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach ($company->members as $member)
                                    <div
                                        class="rounded-xl bg-surface border border-border p-4 flex items-start gap-3 shadow">
                                        <div class="avatar">
                                            <div class="w-12 rounded-xl!">
                                                <img src="{{ asset('storage/' . $member->avatar) }}"
                                                    alt="{{ $member->name }}">
                                            </div>
                                        </div>
                                        <div class="min-w-0">
                                            <p class="font-medium truncate text-sm text-ink">{{ $member->name }}
                                            </p>
                                            <p class="mb-2 text-xs text-ink-3">{{ $member->position }}</p>
                                            <p class="line-clamp-2 text-xs text-ink-4 leading-relaxed">
                                                {{ $member->bio }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- ── BENEFITS ──────────────────────────── --}}
                    @if ($company->benefits->isNotEmpty())
                        <div x-show="tab === 'benefits'" x-transition x-cloak>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach ($company->benefits as $benefit)
                                    <div class="rounded-xl bg-surface border border-border p-5 shadow">
                                        @if ($benefit->icon)
                                            <div
                                                class="w-10 h-10 rounded-xl bg-surface-3 border border-border flex items-center justify-center text-ink-2 mb-4">
                                                <x-dynamic-component :component="'heroicon-o-' . $benefit->icon" class="w-5 h-5" />
                                            </div>
                                        @endif
                                        <p class="font-medium text-sm text-ink mb-1.5">{{ $benefit->title }}</p>
                                        @if ($benefit->body)
                                            <p class="text-xs text-ink-3 leading-relaxed">{{ $benefit->body }}</p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                {{-- /tabs --}}

            </div>
            {{-- /left column --}}

            {{-- ── RIGHT SIDEBAR ──────────────────────────────── --}}
            <div class="flex flex-col gap-4 lg:sticky lg:top-[calc(var(--spacing-nav)+1.5rem)]">

                <div class="rounded-2xl p-5 text-center bg-ink">
                    <h4 class="font-display text-lg text-white mb-2">Want to work here?</h4>
                    <p class="text-xs mb-4 leading-relaxed text-[rgba(255,255,255,0.5)]">
                        Get notified when new roles match your skills and preferences.
                    </p>
                    <button class="btn btn-white btn-sm md:btn-md w-full rounded-xl">
                        Get job alerts
                    </button>
                </div>

                <div class="rounded-xl bg-surface border border-border p-4 sm:p-5">
                    <h4 class="text-xs font-medium tracking-widest uppercase text-ink-4 mb-4">Quick facts</h4>
                    <div class="flex flex-col">
                        @foreach ([['icon' => 'map-pin', 'label' => 'HQ', 'value' => $company->address, 'highlight' => false], ['icon' => 'calendar', 'label' => 'Founded', 'value' => $company->founded_year, 'highlight' => false], ['icon' => 'users', 'label' => 'Size', 'value' => $company->company_size . ' employees', 'highlight' => false], ['icon' => 'banknotes', 'label' => 'Revenue', 'value' => '$' . number_format($company->revenue_min) . 'k–$' . number_format($company->revenue_max) . 'k', 'highlight' => false], ['icon' => 'briefcase', 'label' => 'Industry', 'value' => $company->industry, 'highlight' => false], ['icon' => 'star', 'label' => 'Open roles', 'value' => $company->jobs_count . ' hiring', 'highlight' => true]] as $fact)
                            <div
                                class="flex items-center justify-between gap-3 py-2 border-b border-border last:border-b-0">
                                <span class="flex items-center gap-2 text-xs text-ink-3 shrink-0">
                                    <x-dynamic-component :component="'heroicon-m-' . $fact['icon']" class="w-3.5 h-3.5 text-ink-4 shrink-0" />
                                    {{ $fact['label'] }}
                                </span>
                                <span
                                    class="font-medium text-xs text-right truncate {{ $fact['highlight'] ? 'text-success' : 'text-ink' }}">
                                    {{ $fact['value'] }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Rating breakdown --}}
                @if ($company->reviews_count > 0)
                    <div class="rounded-xl bg-surface border border-border p-4 sm:p-5">
                        <h4 class="text-xs font-medium tracking-widest uppercase text-ink-4 mb-4">Rating breakdown</h4>
                        <div class="flex flex-col">
                            @php
                                $breakdown = [
                                    'Work / life balance' => number_format($company->reviews_avg_rate ?? 0, 1),
                                    'Compensation' => number_format($company->reviews_avg_rate ?? 0, 1),
                                    'Culture' => number_format($company->reviews_avg_rate ?? 0, 1),
                                    'Career growth' => number_format($company->reviews_avg_rate ?? 0, 1),
                                    'Management' => number_format($company->reviews_avg_rate ?? 0, 1),
                                ];
                            @endphp
                            @foreach ($breakdown as $label => $score)
                                <div
                                    class="flex items-center justify-between gap-3 py-2 border-b border-border last:border-b-0">
                                    <span class="text-xs text-ink-3">{{ $label }}</span>
                                    <span class="font-medium text-xs text-ink">{{ $score }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="rounded-xl bg-surface border border-border p-4 sm:p-5">
                    <h4 class="text-xs font-medium tracking-widest uppercase text-ink-4 mb-3">Share</h4>
                    <div class="flex  gap-2">
                        <button class="btn flex-1 btn-neutral btn-sm"
                            @click="navigator.clipboard.writeText(window.location.href).then(() => alert('Link copied!'))">
                            <x-heroicon-m-link class="w-3.5 h-3.5" />
                            Copy link
                        </button>

                        <button class="btn btn-neutral btn-sm flex-1">
                            <x-heroicon-m-share class="w-3.5 h-3.5" />
                            LinkedIn
                        </button>
                    </div>
                </div>

            </div>
            {{-- /right sidebar --}}

        </div>
        {{-- /two-column grid --}}

    </div>

    <style>
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .company-hero {
            animation: fadeUp 0.4s ease both;
        }
    </style>
</x-layouts.public>
