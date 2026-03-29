<x-layouts.employer>
    <div class="mb-7">
        <p class="font-light uppercase text-ink-4 tracking-widest text-sm mb-2">Dashboard</p>
        <h1 class="font-display text-3xl font-semibold">Employer Dashboard</h1>
        <p class="mt-2 text-base text-ink-3 font-light">
            Good morning, {{ auth()->user()->first_name }} Here's what's happening today.
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 mb-7">
        <x-shared.stat-card label="Active Jobs" :value="$stats['active_jobs']" trend="+4 this week" :trendUp="true" color="blue"
            icon="briefcase" />

        <x-shared.stat-card label="Total applicants" :value="$stats['total_applicants']" trend="+4 this week" :trendUp="true"
            color="purple" icon="users" />

        <x-shared.stat-card label="New today" :value="$stats['new_today']" trend="+4 this week" :trendUp="true" color="green"
            icon="sparkles" />

        <x-shared.stat-card label="Interviewing" :value="$stats['interviews']" trend="+4 this week" :trendUp="true" color="amber"
            icon="star" />
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-5">

        <div class="lg:col-span-3">
            <div class="flex items-center justify-between mb-4">
                <div class="space-y-0 5">
                    <h4 class="font-medium text-md">Active job postings</h4>
                    <p class="text-sm text-ink-3">Manage your current openings and performance</p>
                </div>
                <a href="{{ route('employer.jobs.create') }}" class="btn btn-neutral btn-sm">
                    <x-heroicon-m-plus class="w-3.5 h-3.5" />
                    Post a job
                </a>
            </div>

            @if ($jobs->isEmpty())
                <div class="bg-surface border border-border rounded-xl overflow-hidden p-12 text-center">
                    <x-heroicon-o-document-text class="w-12 h-12 mx-auto mb-4 text-ink-4" />
                    <h3 class="font-display mb-2 text-2xl">No jobs yet</h3>
                    <p class="mb-6 text-ink-3">Start creating jobs for seekers to apply.</p>
                    <a href="{{ route('employer.jobs.create') }}" class="btn btn-primary btn-sm">
                        Browse jobs
                        <x-heroicon-m-arrow-right class="w-3.5 h-3.5" />
                    </a>
                </div>
            @else
                <div class="bg-surface border border-border rounded-xl overflow-hidden">
                    <div
                        class="hidden lg:grid grid-cols-[2fr_1fr_2fr_1fr] gap-3 px-5 py-3 bg-surface-2 border-b border-border">
                        <div class="text-2xs text-ink-4 uppercase tracking-widest font-medium">Job</div>
                        <div class="text-2xs text-ink-4 uppercase tracking-widest font-medium">Status</div>
                        <div class="text-2xs text-ink-4 uppercase tracking-widest font-medium">Applicants</div>
                        <div class="text-2xs text-ink-4 uppercase tracking-widest font-medium">Actions</div>
                    </div>

                    @foreach ($jobs as $job)
                        <div
                            class="grid grid-cols-1 lg:grid-cols-[2fr_1fr_2fr_1fr] gap-3 px-5 py-4 items-center transition-colors border-b border-border hover:bg-surface-2 {{ $loop->last ? 'border-none' : '' }}">

                            <div class="flex items-center gap-3 min-w-0">
                                <div class="avatar avatar-placeholder">
                                    <div
                                        class="{{ fake()->randomElement(['bg-slate-bg', 'bg-teal-bg']) }} w-12 rounded">
                                        <span class="text-lg text-ink">
                                            {{ strtoupper(substr($job->title, 0, 2)) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="min-w-0">
                                    <a href="{{ route('jobs.show', $job->slug) }}"
                                        class="text-base text-ink font-medium no-underline truncate block hover:text-primary transition-colors">
                                        {{ $job->title }}
                                    </a>
                                    <p class="text-sm text-ink-3">
                                        {{ $job->type->value }} ·
                                        {{ $job->arrangement->value }}
                                    </p>
                                </div>
                            </div>

                            <x-ui.badge type="{{ $job->status->value }}" class="text-xs">
                                {{ $job->status->label() }}
                            </x-ui.badge>

                            <div class="flex items-center gap-1">
                                @if ($job->applications->count() > 0)
                                    <div class="avatar-group -space-x-3">
                                        @foreach ($job->applications->take(3) as $application)
                                            <div class="avatar avatar-placeholder">
                                                <div
                                                    class="{{ fake()->randomElement(['bg-slate-bg', 'bg-teal-bg']) }} w-8 rounded-full">
                                                    <span class="text-xs text-ink">
                                                        {{ strtoupper(substr($application->seeker->user->first_name, 0, 2)) }}
                                                        {{ strtoupper(substr($application->seeker->user->first_last, 0, 2)) }}
                                                    </span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    @if ($job->applications->count() > 3)
                                        <span class="text-xs text-ink-3">
                                            +{{ $job->applications->count() - 3 }} more
                                        </span>
                                    @endif
                                @else
                                    <span class="text-sm text-ink-3">No applicants yet</span>
                                @endif
                            </div>

                            <div class="flex items-center justify-end gap-2">
                                <a href="" class="btn btn-neutral btn-xs">
                                    Applicants
                                </a>

                                <a href="" class="btn btn-ghost btn-xs">
                                    Edit
                                </a>
                            </div>
                        </div>
                    @endforeach

                    {{-- Pagination --}}
                    @if (!empty($jobs->links()))
                        <div class="px-5 py-3 border-t border-border">
                            {{ $jobs->links() }}
                        </div>
                    @endif
                </div>
            @endif
        </div>

        {{-- Recent applicants --}}
        <div class="space-y-4">
            {{-- Header --}}
            <div class="flex items-center justify-between">
                <div>
                    <h4 class="text-lg font-semibold text-ink">Recent applicants</h4>
                    <p class="text-xs text-ink-4">Latest submissions for your active roles</p>
                </div>
                <a href="{{ route('employer.applicants') }}"
                    class="inline-flex items-center gap-1 text-sm font-medium text-primary transition-colors group">
                    View all
                    <x-heroicon-m-arrow-long-right class="w-4 h-4 transition-transform group-hover:translate-x-1" />
                </a>
            </div>

            {{-- List Container --}}
            <div class="grid gap-3">
                @forelse($applicants->take(4) as $applicant)
                    <a href="{{ route('employer.applicants.show', $applicant->id) }}"
                        class="group flex items-center gap-4 p-3 bg-surface border border-border rounded-2xl transition-all duration-200 hover:border-primary/30 hover:bg-surface-2 hover:shadow-sm hover:-translate-y-0.5">

                        <div class="relative">
                            <div class="avatar avatar-placeholder">
                                <div
                                    class="{{ fake()->randomElement(['bg-slate-bg', 'bg-teal-bg']) }} w-12 rounded-xl">
                                    <span class="text-xs text-ink">
                                        {{ strtoupper(substr($applicant->seeker->user->first_name, 0, 2)) }}
                                        {{ strtoupper(substr($applicant->seeker->user->first_last, 0, 2)) }}
                                    </span>
                                </div>
                            </div>
                            @if ($applicant->created_at->gt(now()->subDay()))
                                <span
                                    class="absolute -top-0.5 -right-0.5 w-3 h-3 bg-primary border-2 border-surface rounded-full"></span>
                            @endif
                        </div>

                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between mb-0.5">
                                <p
                                    class="font-semibold text-sm text-ink truncate group-hover:text-primary transition-colors">
                                    {{ $applicant->seeker->user->first_name }}
                                    {{ $applicant->seeker->user->last_name }}
                                </p>
                                <span class="text-[11px] font-medium text-ink-4 whitespace-nowrap">
                                    {{ $applicant->created_at->diffForHumans(short: true) }}
                                </span>
                            </div>

                            <p class="text-xs text-ink-3 truncate mb-2">
                                Applied for <span class="text-ink-2 font-medium">{{ $applicant->job->title }}</span>
                            </p>

                            <div class="flex items-center justify-between">
                                <x-ui.badge :type="$applicant->status->value">
                                    {{ $applicant->status->value }}
                                </x-ui.badge>

                                <x-heroicon-m-chevron-right
                                    class="w-4 h-4 text-ink-4 opacity-0 -translate-x-2 transition-all group-hover:opacity-100 group-hover:translate-x-0" />
                            </div>
                        </div>
                    </a>
                @empty
                    <div
                        class="flex flex-col items-center justify-center py-12 px-4 border border-dashed border-border rounded-2xl bg-surface-2/30">
                        <div class="p-3 bg-surface border border-border rounded-full mb-3">
                            <x-heroicon-o-user-group class="w-6 h-6 text-ink-4" />
                        </div>
                        <p class="text-sm font-medium text-ink-3">No applicants yet.</p>
                        <p class="text-xs text-ink-4">New applications will appear here.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-layouts.employer>
