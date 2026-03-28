<x-layouts.public :title="$job->title">

    <div class="max-w-7xl mx-auto px-4 lg:px-8 py-6 lg:py-8">

        <div class="breadcrumbs text-sm mb-5">
            <ul>
                <li><a href="{{ route('home') }}" class="text-ink-3 hover:text-primary">Home</a></li>
                <li><a href="{{ route('jobs.index') }}" class="text-ink-3 hover:text-primary">Jobs</a></li>
                <li class="text-ink-2 truncate max-w-50">{{ $job->title }}</li>
            </ul>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-[1fr_340px] gap-6 items-start">
            <div class="min-w-0">
                <div class="card bg-surface border border-border overflow-hidden mb-5 job-hero">
                    <div class="relative h-28 sm:h-32 overflow-hidden"
                        style="background: linear-gradient(135deg, #0E0E10 0%, #1a1a2e 50%, #16213e 100%);">
                        <div class="absolute inset-0 opacity-[0.15]"
                            style="background-image: linear-gradient(rgba(255,255,255,0.3) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.3) 1px, transparent 1px); background-size: 32px 32px;">
                        </div>
                    </div>

                    <div class="card-body px-5 lg:px-8 pb-6 lg:pb-8 pt-0">
                        <div class="-mt-9 mb-4 relative z-10">
                            <div class="avatar">
                                <div class="w-16 h-16 rounded-xl ring-3 ring-white shadow-sm">
                                    <img src="{{ asset('storage/' . $job->company->logo) }}"
                                        alt="{{ $job->company->name }}" />
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col md:flex-row items-start justify-between gap-4 flex-wrap mb-5">
                            <div class="min-w-0 flex-1">
                                <h1 class="text-xl sm:text-3xl font-medium font-display  tracking-tight mb-1.5">
                                    {{ $job->title }}
                                </h1>
                                <div class="flex items-center gap-1.5 flex-wrap text-xs md:text-sm text-ink-3">
                                    {{-- {{ route('companies.show', $job->company->slug) }} --}}
                                    <a href="" class="font-medium text-primary/80 hover:underline">
                                        {{ $job->company->name }}
                                    </a>
                                    <div
                                        class="w-4 h-4 rounded-full bg-primary/80 flex items-center justify-center shrink-0">
                                        <x-heroicon-m-check class="w-2.5 h-2.5 text-white" />
                                    </div>
                                    <span>·</span>
                                    <span class="text-ink-2">{{ $job->address }}</span>
                                    <span>·</span>
                                    <x-ui.badge type="success">
                                        Open
                                    </x-ui.badge>
                                </div>
                            </div>

                            <div class="flex flex-col items-end gap-2 shrink-0">
                                <a href="#apply" class="btn btn-neutral btn-sm rounded-lg gap-2 whitespace-nowrap">
                                    Apply now
                                    <x-heroicon-m-arrow-right class="w-3.5 h-3.5" />
                                </a>
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
                                        <form action="" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="btn btn-sm rounded-lg gap-1.5 whitespace-nowrap
                                                {{ $isBookmarked ? 'btn-neutral' : 'btn-outline' }}">
                                                @if ($isBookmarked)
                                                    <x-heroicon-s-bookmark class="w-3.5 h-3.5" />
                                                    Saved
                                                @else
                                                    <x-heroicon-o-bookmark class="w-3.5 h-3.5" />
                                                    Save job
                                                @endif
                                            </button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </div>

                        <div class="flex flex-col md:flex-row gap-4 pt-5 border-t border-border">
                            @foreach ([['icon' => 'briefcase', 'label' => 'Job type', 'value' => $job->type->label()], ['icon' => 'map-pin', 'label' => 'Location', 'value' => $job->address], ['icon' => 'chart-bar', 'label' => 'Experience', 'value' => $job->level], ['icon' => 'banknotes', 'label' => 'Salary', 'value' => '$' . number_format($job->salary_min) . ' – $' . number_format($job->salary_max)], ['icon' => 'clock', 'label' => 'Posted', 'value' => $job->published_at->diffForHumans()]] as $meta)
                                <div class="flex items-center flex-wrap gap-2.5">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-border flex items-center justify-center shrink-0 text-base-content/40">
                                        <x-dynamic-component :component="'heroicon-o-' . $meta['icon']" class="w-3.5 h-3.5" />
                                    </div>
                                    <div>
                                        <p
                                            class="text-[0.65rem] uppercase tracking-widest text-base-content/40 leading-none mb-0.5">
                                            {{ $meta['label'] }}
                                        </p>
                                        <p class="text-sm font-medium leading-none">{{ $meta['value'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>


                <div class="card bg-surface border border-border mb-5 content-card" x-data="{ tab: 'description' }">
                    <div class="border-b border-base-200">
                        <div
                            class="tabs tabs-border  border-border border-px w-full flex-nowrap overflow-x-auto [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                            @foreach (['description' => 'Description', 'requirements' => 'Requirements', 'responsibilities' => 'Responsibilities', 'benefits' => 'Benefits'] as $key => $label)
                                <button @click="tab = '{{ $key }}'"
                                    class="tab h-auto py-4 text-sm font-medium transition-all duration-150 whitespace-nowrap px-6"
                                    :class="tab === '{{ $key }}' ?
                                        'tab-active border-border! text-ink-3' :
                                        'text-ink-3 hover:text-ink-3 border-transparent'">
                                    {{ $label }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="card-body p-5 lg:p-8">
                        {{-- Description Tab --}}
                        <div x-show="tab === 'description'" x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                            <div class="job-prose text-sm sm:text-base text-ink-3 leading-loose">
                                {{ $job->description }}
                            </div>

                            @if ($job->skills->isNotEmpty())
                                <div class="mt-7 pt-7 border-t border-base-200">
                                    <h3 class="font-bold text-lg mb-4">Skills & tools</h3>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($job->skills as $i => $skill)
                                            <x-ui.badge type="{{ $i < 3 ? 'neutral' : '' }}">
                                                {{ $skill->name }}
                                            </x-ui.badge>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        {{-- Requirements Tab --}}
                        <div x-show="tab === 'requirements'" x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-cloak>
                            @if ($job->requirements->isNotEmpty())
                                <ul class="flex flex-col divide-y divide-base-200">
                                    @foreach ($job->requirements as $req)
                                        <li class="flex items-start gap-3 py-3 first:pt-0 last:pb-0">
                                            <div class="w-1.5 h-1.5 rounded-full bg-primary/60 shrink-0 mt-2.5"></div>
                                            <span class="text-sm text-ink-3 leading-relaxed">{{ $req->title }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-sm text-ink-3/40">No requirements listed.</p>
                            @endif
                        </div>

                        {{-- Responsibilities Tab --}}
                        <div x-show="tab === 'responsibilities'" x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-cloak>
                            @if ($job->responsibilities->isNotEmpty())
                                <ul class="flex flex-col divide-y divide-base-200">
                                    @foreach ($job->responsibilities as $resp)
                                        <li class="flex items-start gap-3 py-3 first:pt-0 last:pb-0">
                                            <div class="w-1.5 h-1.5 rounded-full bg-primary/60 shrink-0 mt-2.5"></div>
                                            <span class="text-sm text-ink-3 leading-relaxed">{{ $resp->title }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-sm text-ink-3/40">No responsibilities listed.</p>
                            @endif
                        </div>

                        {{-- Benefits Tab --}}
                        <div x-show="tab === 'benefits'" x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-cloak>
                            @if ($job->benefits->isNotEmpty())
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    @foreach ($job->benefits as $benefit)
                                        <div
                                            class="flex items-start gap-3 p-4 rounded-xl bg-surface-2 border border-border">
                                            @if ($benefit->icon)
                                                <div
                                                    class="w-9 h-9 rounded-lg flex items-center justify-center shrink-0 bg-surface border border-border text-ink-3/50">
                                                    <x-dynamic-component :component="'heroicon-o-' . $benefit->icon" class="w-4 h-4 shrink-0" />
                                                </div>
                                            @endif
                                            <div class="min-w-0">
                                                <p class="font-semibold text-sm mb-0.5">{{ $benefit->title }}</p>
                                                @if ($benefit->body)
                                                    <p class="text-xs text-ink-3 leading-relaxed">
                                                        {{ $benefit->body }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-sm text-base-content/40">No benefits listed.</p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- ── APPLY FORM ────────────────────────────── --}}
                <div class="card bg-base-100 border border-base-200 apply-form" id="apply">
                    <div class="card-body p-5 lg:p-8">
                        <h2 class="text-xl sm:text-2xl font-medium font-display">Apply for this role</h2>
                        <p class="text-sm text-ink-3 mb-6">
                            {{ $job->title }} at {{ $job->company->name }}
                        </p>

                        @guest
                            <div class="rounded-xl p-5 sm:p-6 text-center bg-surface-3 border border-ink-4">
                                <x-heroicon-o-lock-closed class="w-8 h-8 mx-auto mb-3 text-base-content/30" />
                                <h4 class="font-semibold mb-1 text-base">Sign in to apply</h4>
                                <p class="mb-4 text-sm text-base-content/50">
                                    Create a free account or sign in to submit your application.
                                </p>
                                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                                    <a href="{{ route('login') }}" class="btn btn-outline btn-sm rounded-lg">Sign in</a>
                                    <a href="{{ route('register') }}" class="btn btn-neutral btn-sm rounded-lg">Create
                                        account</a>
                                </div>
                            </div>
                        @endguest

                        @auth
                            @if (auth()->user()->role->value !== 'seeker')
                                <div role="alert" class="alert alert-info text-sm">
                                    <x-heroicon-m-information-circle class="w-4 h-4 shrink-0" />
                                    <span>Employers cannot apply for jobs. Switch to a seeker account to apply.</span>
                                </div>
                            @else
                                @if (session('success'))
                                    <div role="alert" class="alert alert-success text-sm mb-5">
                                        <x-heroicon-m-check-circle class="w-4 h-4 shrink-0" />
                                        <span>{{ session('success') }}</span>
                                    </div>
                                @endif
                                @if ($errors->has('general'))
                                    <div role="alert" class="alert alert-error text-sm mb-5">
                                        <x-heroicon-m-exclamation-circle class="w-4 h-4 shrink-0" />
                                        <span>{{ $errors->first('general') }}</span>
                                    </div>
                                @endif

                                <form action="" method="POST" enctype="multipart/form-data"
                                    class="flex flex-col gap-5">
                                    @csrf

                                    {{-- Applicant info --}}
                                    <div
                                        class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-4 rounded-xl bg-base-200/50 border border-base-200">
                                        <div>
                                            <p class="text-xs font-medium text-base-content/40 mb-1">Applying as</p>
                                            <p class="font-semibold text-sm">
                                                {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-xs font-medium text-base-content/40 mb-1">Email</p>
                                            <p class="text-sm text-ink-3 break-all">{{ auth()->user()->email }}
                                            </p>
                                        </div>
                                    </div>

                                    {{-- Expected salary --}}
                                    <fieldset class="fieldset my-0">
                                        <legend class="fieldset-legend text-xs font-normal">
                                            Expected salary
                                            <span class="font-normal text-xs text-base-content/40 ml-1">
                                                Budget: ${{ number_format($job->salary_min) }} –
                                                ${{ number_format($job->salary_max) }}
                                            </span>
                                        </legend>
                                        <label
                                            class="input input-sm rounded-lg -mt-1 outline-none {{ $errors->has('expected_salary') ? 'input-error' : '' }}">
                                            <x-heroicon-m-banknotes class="w-3.5 h-3.5 opacity-50 shrink-0" />
                                            <input type="number" name="expected_salary"
                                                value="{{ old('expected_salary') }}"
                                                placeholder="{{ $job->salary_min }}" min="0" class="grow" />
                                        </label>
                                        @error('expected_salary')
                                            <div class="text-xs text-error flex items-center gap-1 -mt-0.5">
                                                <x-heroicon-o-exclamation-circle class="w-3.5 h-3.5 shrink-0" />
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </fieldset>

                                    {{-- CV upload --}}
                                    {{-- <div>
                                        <x-ui.upload-zone name="attachment" accept=".pdf,.doc,.docx" label="CV / Resume"
                                            hint="Click to upload or drag and drop" sub="PDF, DOC, DOCX · Max 5MB" />
                                        @error('attachment')
                                            <div class="text-xs text-error flex items-center gap-1 mt-1">
                                                <x-heroicon-o-exclamation-circle class="w-3.5 h-3.5 shrink-0" />
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div> --}}

                                    {{-- Cover letter --}}
                                    {{-- <x-ui.textarea name="cover_letter" label="Cover letter" :optional="true"
                                        :rows="4" :counter="true" maxlength="3000"
                                        placeholder="Tell the employer why you're a great fit for this role…"
                                        :error="$errors->first('cover_letter')" /> --}}

                                    {{-- Message --}}
                                    {{-- <x-ui.textarea name="message" label="Additional message" :optional="true"
                                        :rows="3" :counter="true" maxlength="2000"
                                        placeholder="Any additional information you'd like to share…" :error="$errors->first('message')" /> --}}

                                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                        <p class="text-xs text-base-content/40 sm:max-w-xs">
                                            By submitting, your profile and application will be shared with
                                            {{ $job->company->name }}.
                                        </p>
                                        <button type="submit"
                                            class="btn btn-neutral btn-sm rounded-lg w-full sm:w-auto gap-2 shrink-0">
                                            <x-heroicon-m-paper-airplane class="w-4 h-4" />
                                            Submit application
                                        </button>
                                    </div>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>

            </div>
            {{-- /left --}}

            {{-- ── RIGHT SIDEBAR ──────────────────────────────── --}}
            <div class="flex flex-col gap-4 lg:sticky lg:top-24">

                <div class="card bg-surface border border-border-md p-5 sidebar-card shadow-xs">
                    <h4 class="text-xs font-semibold tracking-widest uppercase text-base-content/40 mb-4">Job overview
                    </h4>
                    <div class="flex flex-col">
                        @foreach ([['icon' => 'clock', 'label' => 'Posted', 'value' => $job->published_at->format('M d, Y'), 'class' => ''], ['icon' => 'calendar-days', 'label' => 'Deadline', 'value' => $job->expires_at->format('M d, Y'), 'class' => ''], ['icon' => 'map-pin', 'label' => 'Location', 'value' => $job->address, 'class' => ''], ['icon' => 'briefcase', 'label' => 'Job type', 'value' => $job->type->label(), 'class' => ''], ['icon' => 'banknotes', 'label' => 'Salary', 'value' => '$' . number_format($job->salary_min) . ' – $' . number_format($job->salary_max), 'class' => 'text-success'], ['icon' => 'users', 'label' => 'Applicants', 'value' => number_format($job->applications_count ?? 0) . ' applied', 'class' => 'text-primary']] as $fact)
                            <div
                                class="flex items-center justify-between gap-3 py-2.5 border-b border-border last:border-b-0">
                                <span class="flex items-center gap-2 text-xs text-ink-3 shrink-0">
                                    <x-dynamic-component :component="'heroicon-o-' . $fact['icon']" class="w-3.5 h-3.5 text-ink-4" />
                                    {{ $fact['label'] }}
                                </span>
                                <span class="font-semibold text-xs text-right {{ $fact['class'] ?: 'text-ink-2' }}">
                                    {{ $fact['value'] }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Company card --}}
                <div class="card bg-surface border border-border p-5 sidebar-card">
                    <h4 class="text-xs md:text-sm tracking-widest uppercase text-ink-4 mb-4">
                        About the company
                    </h4>

                    <div class="flex items-center gap-3 pb-4 mb-4 border-b border-border">
                        <div class="avatar">
                            <div class="w-10 h-10 rounded-lg">
                                <img src="{{ asset('storage/' . $job->company->logo) }}"
                                    alt="{{ $job->company->name }}" />
                            </div>
                        </div>
                        <div class="min-w-0">
                            {{-- {{ route('companies.show', $job->company->slug) }} --}}
                            <a href=""
                                class="font-semibold text-sm hover:text-primary transition-colors truncate block">
                                {{ $job->company->name }}
                            </a>
                            <p class="text-xs text-ink-3 truncate">
                                {{ $job->company->industry }}
                                @if ($job->company->funding)
                                    · {{ $job->company->funding }}
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-2 mb-4">
                        <div class="text-center p-2 rounded-lg flex flex-col justify-center">
                            <p class="font-semibold text-md md:text-lg leading-none">{{ $job->company->size ?? '—' }}
                            </p>
                            <p class="text-[0.65rem] text-ink-4 mt-0.5">Employees</p>
                        </div>
                        <div class="text-center p-2 rounded-lg flex flex-col justify-center">
                            <p class="font-semibold text-md md:text-lg leading-none">
                                {{ number_format($job->company->reviews_avg_rate ?? 0, 1) }}★</p>
                            <p class="text-[0.65rem] text-base-content/40 mt-0.5">Rating</p>
                        </div>
                        <div class="text-center p-2 rounded-lg flex flex-col justify-center">
                            <p class="font-semibold text-md md:text-lg leading-none">
                                {{ $job->company->jobs()->count() }}</p>
                            <p class="text-xs text-ink-4 mt-0.5">Open roles</p>
                        </div>
                    </div>

                    {{-- {{ route('companies.show', $job->company->slug) }} --}}
                    <a href="" class="btn  btn-sm w-full rounded-lg">
                        View company profile →
                    </a>
                </div>

                {{-- Similar jobs --}}
                @if ($related->isNotEmpty())
                    <div class="card bg-surface border border-base-200 p-5 sidebar-card">
                        <h4 class="text-xs font-semibold tracking-widest uppercase text-base-content/40 mb-1">Similar
                            roles</h4>
                        <div class="flex flex-col">
                            @foreach ($related->take(4) as $relatedJob)
                                <a href="{{ route('jobs.show', $relatedJob->slug) }}"
                                    class="flex items-start gap-3 py-3 border-b border-base-200 last:border-b-0 no-underline group">
                                    <div class="avatar shrink-0 mt-0.5">
                                        <div class="w-8 h-8 rounded-lg">
                                            <img src="{{ asset('storage/' . $relatedJob->company->logo) }}"
                                                alt="{{ $relatedJob->company->name }}" />
                                        </div>
                                    </div>
                                    <div class="min-w-0">
                                        <p
                                            class="font-semibold text-sm group-hover:text-primary transition-colors leading-tight mb-0.5 truncate">
                                            {{ $relatedJob->title }}
                                        </p>
                                        <p class="text-xs text-base-content/40 mb-0.5">
                                            {{ $relatedJob->company->name }} · {{ $relatedJob->arrangement->value }}
                                        </p>
                                        <p class="text-xs font-semibold text-ink-3">
                                            ${{ number_format($relatedJob->salary_min) }} –
                                            ${{ number_format($relatedJob->salary_max) }}
                                        </p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Share --}}
                <div class="card bg-base-100 border border-base-200 p-3 sidebar-card">
                    <h4 class="text-xs font-semibold tracking-widest uppercase text-ink-3 mb-3">
                        Share this role
                    </h4>
                    <div class="flex gap-2">
                        <button class="btn btn-xs btn-outline" x-data
                            @click="navigator.clipboard.writeText(window.location.href).then(() => alert('Link copied!'))"
                            class="btn btn-outline btn-xs rounded-lg flex-1 gap-1.5 font-medium">
                            <x-heroicon-m-link class="w-3.5 h-3.5" />
                            Copy link
                        </button>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}"
                            target="_blank" class="btn btn-outline btn-xs flex-1 gap-1.5 font-medium">
                            <x-heroicon-m-share class="w-3.5 h-3.5" />
                            LinkedIn
                        </a>
                        <a href="mailto:?subject={{ urlencode($job->title . ' at ' . $job->company->name) }}&body={{ urlencode(request()->url()) }}"
                            class="btn btn-outline btn-xs  flex-1 gap-1.5 font-medium">
                            <x-heroicon-m-envelope class="w-3.5 h-3.5" />
                            Email
                        </a>
                    </div>
                </div>

            </div>
            {{-- /sidebar --}}

        </div>
    </div>

    <style>
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .job-hero {
            animation: fadeUp 0.4s ease both;
        }

        .content-card {
            animation: fadeUp 0.4s 0.08s ease both;
        }

        .apply-form {
            animation: fadeUp 0.4s 0.14s ease both;
        }

        .sidebar-card {
            animation: fadeUp 0.4s 0.05s ease both;
        }
    </style>

</x-layouts.public>
