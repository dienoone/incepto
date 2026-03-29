<x-layouts.public title="Find Your Next Role — Workopia">

    {{-- ── HERO ───────────────────────────────────────────────── --}}
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden px-4 sm:px-6 lg:px-10"
        style="padding-top: calc(var(--spacing-nav) + 80px); padding-bottom: 100px;">

        {{-- Background radial glows --}}
        <div class="absolute inset-0 pointer-events-none"
            style="background: radial-gradient(ellipse 80% 60% at 60% 30%, rgba(45,91,227,0.06) 0%, transparent 70%), radial-gradient(ellipse 50% 50% at 20% 70%, rgba(26,158,107,0.04) 0%, transparent 60%);">
        </div>

        {{-- Grid lines --}}
        <div class="absolute inset-0 pointer-events-none opacity-30"
            style="background-image: linear-gradient(var(--color-border) 1px, transparent 1px), linear-gradient(90deg, var(--color-border) 1px, transparent 1px); background-size: 60px 60px; mask-image: radial-gradient(ellipse 70% 60% at 50% 40%, black 20%, transparent 80%);">
        </div>

        {{-- Hero content --}}
        <div class="relative z-10 max-w-3xl w-full text-center">

            {{-- Live badge --}}
            <div class="inline-flex items-center gap-2 bg-surface border border-border-md rounded-full px-4 py-1.5 text-sm text-ink-2 mb-8 shadow-sm hero-item"
                style="animation-delay: 0s;">
                <span class="w-1.5 h-1.5 rounded-full bg-success hero-pulse"></span>
                <span>{{ $stats['jobs'] }} active roles available today</span>
            </div>

            {{-- Headline --}}
            <h1 class="font-display text-ink mb-6 hero-item"
                style="font-size: clamp(48px, 7vw, 80px); line-height: 1.08; letter-spacing: -0.02em; animation-delay: 0.1s;">
                The home for<br><em class="not-italic text-primary">exceptional</em> talent.
            </h1>

            {{-- Subheading --}}
            <p class="text-lg sm:text-xl font-light text-ink-3 leading-relaxed max-w-lg mx-auto mb-12 hero-item"
                style="animation-delay: 0.2s;">
                Connect with industry-defining companies. Find the role that changes everything.
            </p>

            {{-- Search bar --}}
            <form action="{{ route('jobs.index') }}" method="GET"
                class="flex items-center bg-surface border border-border-md rounded-2xl px-5 py-1.5 gap-3 shadow-lg max-w-2xl mx-auto mb-12 hero-item"
                style="animation-delay: 0.3s;">
                <x-heroicon-m-magnifying-glass class="w-5 h-5 text-ink-3 shrink-0" />
                <input type="text" name="q" placeholder="Job title, skill, or company…"
                    class="flex-1 border-0 outline-none bg-transparent font-body text-base text-ink placeholder:text-ink-4 py-2.5" />
                <div class="w-px h-6 bg-border-md shrink-0"></div>
                <div class="flex items-center gap-1.5 text-sm text-ink-3 px-3 shrink-0">
                    <x-heroicon-m-map-pin class="w-3.5 h-3.5 text-ink-4" />
                    Remote / Anywhere
                </div>
                <button type="submit"
                    class="bg-ink text-white text-sm font-medium px-5 py-2.5 rounded-xl transition-all duration-150 hover:bg-ink-2 hover:-translate-y-px active:translate-y-0 shrink-0 whitespace-nowrap">
                    Search
                </button>
            </form>

            {{-- Category tags --}}
            <div class="flex flex-wrap gap-2 justify-center mb-16 hero-item" style="animation-delay: 0.4s;">
                @foreach (['Design', 'Engineering', 'Product', 'Marketing', 'Data', 'Remote'] as $tag)
                    <a href="{{ route('jobs.index', ['q' => $tag]) }}"
                        class="text-sm text-ink-3 bg-surface-2 border border-border rounded-full px-3 py-1 no-underline transition-all duration-150 hover:bg-primary-bg hover:text-primary hover:border-primary/20">
                        {{ $tag }}
                    </a>
                @endforeach
            </div>

            {{-- Stats strip --}}
            <div class="flex items-center justify-center gap-8 sm:gap-12 pt-10 border-t border-border hero-item"
                style="animation-delay: 0.5s;">
                <div class="text-center">
                    <p class="font-display leading-none mb-1" style="font-size: clamp(28px, 4vw, 36px);">
                        {{ number_format($stats['jobs']) }}
                    </p>
                    <p class="text-sm text-ink-3">Active roles</p>
                </div>
                <div class="w-px h-10 bg-border shrink-0"></div>
                <div class="text-center">
                    <p class="font-display leading-none mb-1" style="font-size: clamp(28px, 4vw, 36px);">
                        {{ number_format($stats['companies']) }}+
                    </p>
                    <p class="text-sm text-ink-3">Companies hiring</p>
                </div>
                <div class="w-px h-10 bg-border shrink-0"></div>
                <div class="text-center">
                    <p class="font-display leading-none mb-1" style="font-size: clamp(28px, 4vw, 36px);">
                        {{ number_format($stats['hired']) }}
                    </p>
                    <p class="text-sm text-ink-3">Professionals placed</p>
                </div>
            </div>

        </div>
    </section>

    {{-- ── FEATURED JOBS ───────────────────────────────────────── --}}
    <section class="bg-surface py-24 px-4 sm:px-6 lg:px-10">
        <div class="max-w-7xl mx-auto">

            {{-- Section header --}}
            <div class="flex items-end justify-between gap-6 mb-12 flex-wrap">
                <div>
                    <p class="text-xs font-medium tracking-widest uppercase text-ink-4 mb-3">Open positions</p>
                    <h2 class="font-display text-ink mb-3"
                        style="font-size: clamp(32px, 4vw, 48px); line-height: 1.1; letter-spacing: -0.02em;">
                        Latest opportunities
                    </h2>
                    <p class="text-base font-light text-ink-3 max-w-md">
                        Hand-picked roles from companies building the future.
                    </p>
                </div>
                <a href="{{ route('jobs.index') }}"
                    class="text-sm font-medium text-ink-2 no-underline transition-all hover:text-ink shrink-0">
                    View all jobs →
                </a>
            </div>

            {{-- Jobs grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($featuredJobs as $job)
                    <a href="{{ route('jobs.show', $job->slug) }}"
                        class="group bg-surface border border-border rounded-2xl p-6 no-underline transition-all duration-200 hover:shadow-md hover:border-border-md hover:-translate-y-0.5 relative overflow-hidden block">

                        {{-- primary top bar on hover --}}
                        <div
                            class="absolute top-0 left-0 right-0 h-0.5 bg-primary scale-x-0 group-hover:scale-x-100 origin-left transition-transform duration-300 rounded-full">
                        </div>

                        {{-- Card top: logo + bookmark --}}
                        <div class="flex items-start justify-between gap-3 mb-4">
                            <div class="flex items-center gap-3">
                                {{-- Avatar --}}
                                <div
                                    class="w-10 h-10 rounded-lg overflow-hidden bg-surface-2 shrink-0 flex items-center justify-center border border-border">
                                    @if ($job->company->logo)
                                        <img src="{{ asset('storage/' . $job->company->logo) }}"
                                            alt="{{ $job->company->name }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-sm font-bold text-ink-3">
                                            {{ Str::upper(Str::substr($job->company->name, 0, 1)) }}
                                        </span>
                                    @endif
                                </div>
                                <div class="min-w-0">
                                    <h3 class="font-medium text-base text-ink leading-tight truncate">
                                        {{ $job->title }}
                                    </h3>
                                    <p class="text-sm text-ink-3 truncate">{{ $job->company->name }}</p>
                                </div>
                            </div>
                            @auth
                                @if (auth()->user()->role->value === 'seeker')
                                    @php
                                        $isBookmarked = auth()->user()->seeker
                                            ? $job
                                                ->bookmarks()
                                                ->where('seeker_id', auth()->user()->seeker->id)
                                                ->exists()
                                            : false;
                                    @endphp
                                    <div
                                        class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 transition-all duration-150 {{ $isBookmarked ? 'bg-primary-bg text-primary' : 'bg-surface-2 text-ink-4 hover:bg-primary-bg hover:text-primary' }}">
                                        @if ($isBookmarked)
                                            <x-heroicon-s-bookmark class="w-3.5 h-3.5" />
                                        @else
                                            <x-heroicon-o-bookmark class="w-3.5 h-3.5" />
                                        @endif
                                    </div>
                                @endif
                            @endauth
                        </div>

                        {{-- Meta pills --}}
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span
                                class="inline-flex items-center text-xs font-medium px-2.5 py-1 rounded-full bg-primary-bg text-primary">
                                {{ $job->type->value }}
                            </span>
                            <span
                                class="inline-flex items-center gap-1 text-xs text-ink-3 bg-surface-2 border border-border rounded-full px-2.5 py-1">
                                <x-heroicon-m-map-pin class="w-3 h-3 text-ink-4" />
                                {{ $job->arrangement->value }}
                            </span>
                            <span
                                class="inline-flex items-center text-xs text-ink-3 bg-surface-2 border border-border rounded-full px-2.5 py-1">
                                {{ $job->level }}
                            </span>
                        </div>

                        {{-- Skill tags --}}
                        @if ($job->skills->isNotEmpty())
                            <div class="flex flex-wrap gap-1.5 mb-4">
                                @foreach ($job->skills->take(3) as $skill)
                                    <span class="text-xs text-ink-3 bg-surface-3 rounded px-2 py-0.5">
                                        {{ $skill->name }}
                                    </span>
                                @endforeach
                                @if ($job->skills->count() > 3)
                                    <span class="text-xs text-ink-4 bg-surface-3 rounded px-2 py-0.5">
                                        +{{ $job->skills->count() - 3 }}
                                    </span>
                                @endif
                            </div>
                        @endif

                        {{-- Footer: salary + date --}}
                        <div class="flex items-center justify-between pt-4 border-t border-border">
                            <span class="font-medium text-sm text-ink">
                                ${{ number_format($job->salary_min) }} – ${{ number_format($job->salary_max) }}
                            </span>
                            <span class="text-xs text-ink-4">
                                {{ $job->published_at->diffForHumans() }}
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>

        </div>
    </section>

    {{-- ── FEATURED COMPANIES ──────────────────────────────────── --}}
    <section class="bg-surface-2 py-24 px-4 sm:px-6 lg:px-10">
        <div class="max-w-7xl mx-auto">

            <p class="text-xs font-medium tracking-widest uppercase text-ink-4 mb-3">Top employers</p>
            <h2 class="font-display text-ink mb-3"
                style="font-size: clamp(32px, 4vw, 48px); line-height: 1.1; letter-spacing: -0.02em;">
                Companies worth working for
            </h2>
            <p class="text-base font-light text-ink-3 max-w-md mb-12">
                Explore culture, mission, and open roles at industry-leading teams.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($featuredCompanies as $company)
                    <a href="{{ route('companies.show', $company->slug) }}"
                        class="group bg-surface border border-border rounded-2xl p-6 no-underline transition-all duration-200 hover:shadow-md hover:border-border-md hover:-translate-y-0.5 block">

                        {{-- Logo --}}
                        <div
                            class="w-14 h-14 rounded-xl overflow-hidden bg-surface-2 shrink-0 flex items-center justify-center border border-border mb-4">
                            @if ($company->logo)
                                <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }}"
                                    class="w-full h-full object-cover">
                            @else
                                <span class="text-lg font-bold text-ink-3">
                                    {{ Str::upper(Str::substr($company->name, 0, 1)) }}
                                </span>
                            @endif
                        </div>

                        <h3 class="font-medium text-base text-ink mb-1 group-hover:text-primary transition-colors">
                            {{ $company->name }}
                        </h3>
                        <p class="text-xs font-medium tracking-widest uppercase text-ink-4 mb-3">
                            {{ $company->industry }}
                        </p>
                        <p class="text-sm text-ink-3 leading-relaxed mb-4 line-clamp-2">
                            {{ $company->bio }}
                        </p>

                        <div class="flex items-center justify-between pt-4 border-t border-border">
                            <div class="flex items-center gap-1.5 text-xs text-ink-3">
                                <x-heroicon-m-map-pin class="w-3 h-3 text-ink-4" />
                                {{ $company->address }}
                            </div>
                            <span class="text-xs font-medium text-primary bg-primary-bg rounded-full px-3 py-1">
                                {{ $company->jobs_count ?? $company->jobs()->count() }} jobs
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>

        </div>
    </section>

    {{-- ── HOW IT WORKS ────────────────────────────────────────── --}}
    <section class="bg-surface py-24 px-4 sm:px-6 lg:px-10">
        <div class="max-w-7xl mx-auto">

            <div class="text-center max-w-lg mx-auto mb-16">
                <p class="text-xs font-medium tracking-widest uppercase text-ink-4 mb-3">How it works</p>
                <h2 class="font-display text-ink"
                    style="font-size: clamp(32px, 4vw, 48px); line-height: 1.1; letter-spacing: -0.02em;">
                    From search to hired,<br>in three steps
                </h2>
            </div>

            <div
                class="grid grid-cols-1 sm:grid-cols-3 divide-y sm:divide-y-0 sm:divide-x divide-border border border-border rounded-2xl overflow-hidden">
                @foreach ([['num' => '01', 'icon' => 'magnifying-glass', 'title' => 'Discover your role', 'body' => 'Search and filter thousands of positions by skill, location, salary, and work style. Find opportunities that match who you are.'], ['num' => '02', 'icon' => 'document-text', 'title' => 'Apply with confidence', 'body' => 'Submit your resume and a tailored cover letter in minutes. Track every application in one clean dashboard.'], ['num' => '03', 'icon' => 'check', 'title' => 'Get hired', 'body' => 'Receive real-time status updates as employers review your profile. From interview to offer — all in Workopia.']] as $step)
                    <div class="bg-surface p-8 sm:p-10 relative">
                        <p class="font-display text-5xl text-surface-3 leading-none mb-6 select-none">
                            {{ $step['num'] }}
                        </p>
                        <div class="w-11 h-11 bg-ink rounded-xl flex items-center justify-center mb-5">
                            <x-dynamic-component :component="'heroicon-o-' . $step['icon']" class="w-5 h-5 text-white" />
                        </div>
                        <h3 class="font-medium text-base text-ink mb-2">{{ $step['title'] }}</h3>
                        <p class="text-sm text-ink-3 leading-relaxed">{{ $step['body'] }}</p>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    {{-- ── CTA ──────────────────────────────────────────────────── --}}
    <section class="relative bg-ink py-28 px-4 sm:px-6 lg:px-10 overflow-hidden text-center">

        {{-- Background glows --}}
        <div class="absolute inset-0 pointer-events-none"
            style="background: radial-gradient(ellipse 60% 60% at 30% 50%, rgba(45,91,227,0.3) 0%, transparent 70%), radial-gradient(ellipse 50% 50% at 70% 50%, rgba(26,158,107,0.2) 0%, transparent 60%);">
        </div>

        <div class="relative z-10 max-w-xl mx-auto">
            <h2 class="font-display text-white mb-5"
                style="font-size: clamp(36px, 5vw, 56px); line-height: 1.1; letter-spacing: -0.02em;">
                Ready to find your<br><em class="not-italic" style="color: rgba(255,255,255,0.45);">next chapter?</em>
            </h2>
            <p class="text-lg font-light mb-10" style="color: rgba(255,255,255,0.5);">
                Join thousands of professionals who found their dream role through Workopia.
            </p>
            <div class="flex items-center justify-center gap-3 flex-wrap">
                <a href="{{ route('jobs.index') }}"
                    class="btn btn-lg bg-white text-ink hover:bg-white/90 border-0 font-medium rounded-xl">
                    Browse jobs
                </a>
                <a href="{{ route('register') }}"
                    class="btn btn-lg btn-outline border-white/30 text-white hover:bg-white/10 hover:border-white/50 font-medium rounded-xl">
                    Post a job
                </a>
            </div>
        </div>
    </section>

    {{-- ── ANIMATIONS ───────────────────────────────────────────── --}}
    <style>
        @keyframes heroFadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes heroPulse {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.6;
                transform: scale(1.3);
            }
        }

        .hero-item {
            opacity: 0;
            animation: heroFadeUp 0.6s ease both;
        }

        .hero-pulse {
            animation: heroPulse 2s ease infinite;
        }
    </style>

</x-layouts.public>
