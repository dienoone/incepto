<x-layouts.seeker title="My Applications">
    <div class="mb-7">
        <p class="font-light uppercase text-ink-4 tracking-widest text-sm mb-2">Dashboard</p>
        <h1 class="font-display text-3xl font-semibold">My Applications</h1>
        <p class="mt-2 text-base text-ink-3 font-light">
            You have {{ $applications->total() }} {{ Str::plural('application', $applications->total()) }} in total.
        </p>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-7">
        <x-shared.stat-card label="Total Applications" :value="$applications->total()" trend="+4 this week" :trendUp="true"
            color="blue" icon="document-text" />

        <x-shared.stat-card label="Interviews scheduled" :value="$applications->getCollection()->where('status->value', 'Interview')->count()" trend="+1 today" :trendUp="true"
            color="purple" icon="star" />

        <x-shared.stat-card label="Reviewed by employer" :value="$applications
            ->getCollection()
            ->whereIn('status->value', ['Reviewed', 'Accepted'])
            ->count()" trend="Same as last week" :trendUp="false"
            color="green" icon="check-circle" />
        <x-shared.stat-card label="Response rate" :value="'42%'" trend="Avg. 3 days" :trendUp="false" color="amber"
            icon="clock" />
    </div>

    {{-- Filter tabs --}}
    <div class="flex items-center justify-between mb-4 flex-wrap gap-3">
        <div>
            <h2 class="text-md font-medium text-ink">All applications</h2>
            <p class="text-sm text-ink-3">Click any row to view full details</p>
        </div>
        <div class="flex gap-1 bg-surface-2 rounded-full p-0.5">
            <a href="" class="badge badge-neutral">
                All ({{ $applications->count() }})
            </a>
            <a href="" class="badge badge-neutral ">
                Pending
            </a>
            <a href="" class="badge badge-neutral">
                Interviewing
            </a>
            <a href="" class="badge badge-neutral">
                Reviewed
            </a>
        </div>
    </div>

    {{-- Applications table --}}
    @if ($applications->isEmpty())
        <div class="bg-surface border border-border rounded-xl overflow-hidden p-12 text-center">
            <x-heroicon-o-document-text class="w-12 h-12 mx-auto mb-4 text-ink-4" />
            <h3 class="font-display mb-2 text-2xl">No applications yet</h3>
            <p class="mb-6 text-ink-3">Start exploring jobs and apply to positions that match your skills.</p>
            <a href="{{ route('jobs.index') }}" class="btn btn-primary btn-sm">
                Browse jobs
                <x-heroicon-m-arrow-right class="w-3.5 h-3.5" />
            </a>
        </div>
    @else
        <div class="bg-surface border border-border rounded-xl overflow-hidden">
            <div
                class="hidden lg:grid grid-cols-[2fr_1.2fr_0.9fr_1fr_0.8fr] gap-3 px-5 py-3 bg-surface-2 border-b border-border">
                <div class="text-2xs text-ink-4 uppercase tracking-widest font-medium">Job</div>
                <div class="text-2xs text-ink-4 uppercase tracking-widest font-medium">Company</div>
                <div class="text-2xs text-ink-4 uppercase tracking-widest font-medium">Applied</div>
                <div class="text-2xs text-ink-4 uppercase tracking-widest font-medium">Status</div>
                <div></div>
            </div>

            @foreach ($applications as $application)
                <div
                    class="grid grid-cols-1 lg:grid-cols-[2fr_1.2fr_0.9fr_1fr_0.8fr] gap-3 px-5 py-4 items-center transition-colors border-b border-border hover:bg-surface-2">

                    {{-- Job --}}
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="avatar">
                            <div class="w-10 rounded">
                                <img src="{{ asset('storage/' . $application->job->company->logo) }}"
                                    alt="{{ $application->job->company->name }}" />
                            </div>
                        </div>
                        <div class="min-w-0">
                            <a href="{{ route('jobs.show', $application->job->slug) }}"
                                class="text-base text-ink font-medium no-underline truncate block hover:text-accent transition-colors">
                                {{ $application->job->title }}
                            </a>
                            <p class="text-sm text-ink-3">
                                {{ $application->job->type->value }} · {{ $application->job->arrangement->value }}
                            </p>
                        </div>
                    </div>

                    {{-- Company --}}
                    <div class="text-sm text-ink-2">
                        {{ $application->job->company->name }}
                    </div>

                    {{-- Applied date --}}
                    <div class="text-sm text-ink-3">
                        {{ $application->created_at->format('M d') }}
                    </div>

                    {{-- Status badge --}}
                    <div>
                        <x-ui.badge type="{{ $application->status->value }}" :dot="true" class="text-xs">
                            {{ $application->status->value }}
                        </x-ui.badge>
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center justify-end gap-2">
                        @if ($application->status->value === 'interview')
                            <div class="btn btn-neutral btn-sm">
                                Prepare
                            </div>
                        @else
                            <div class="btn btn-ghost btn-sm">
                                Details
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach

            {{-- Pagination --}}
            @if (!empty($applications->links()))
                <div class="px-5 py-3 border-t border-border">
                    {{ $applications->links() }}
                </div>
            @endif
        </div>
    @endif

    @php
        $latestInterview = $applications->firstWhere('status', 'interview');

        $timeline = [
            ['label' => 'Applied', 'date' => $latestInterview?->created_at->format('M d'), 'key' => 'applied'],
            ['label' => 'Reviewed', 'date' => $latestInterview?->updated_at->format('M d'), 'key' => 'reviewed'],
            ['label' => 'Shortlisted', 'date' => $latestInterview?->updated_at->format('M d'), 'key' => 'shortlisted'],
            ['label' => 'Interview', 'date' => $latestInterview?->interview_date ?? 'Upcoming', 'key' => 'interview'],
            ['label' => 'Offer', 'date' => 'Pending', 'key' => 'offer'],
        ];

        $currentStepIndex = 3;
    @endphp

    @if ($latestInterview)
        <div class="mt-6 bg-base-100 border border-base-300 rounded-xl p-6 shadow-sm">
            <div class="flex items-center justify-between mb-8">
                <h3 class="font-semibold text-ink flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                    {{ $latestInterview->job->title }} — Application Progress
                </h3>
                <span class="text-xs font-medium px-2.5 py-0.5 rounded-full bg-primary/10 text-primary">Active</span>
            </div>

            <ul class="steps steps-vertical lg:steps-horizontal w-full">
                @foreach ($timeline as $index => $step)
                    <li @class(['step', 'step-primary' => $index <= $currentStepIndex]) @if ($index < $currentStepIndex) data-content="✓" @endif>
                        <div class="flex flex-col text-left lg:text-center">
                            <span class="font-medium text-sm">{{ $step['label'] }}</span>
                            <span class="text-xs opacity-50">{{ $step['date'] }}</span>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</x-layouts.seeker>
