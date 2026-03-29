<x-layouts.employer title="Applicants">

    <div class="mb-7">
        <p class="font-light uppercase text-ink-4 tracking-widest text-sm mb-2">Dashboard</p>
        <h1 class="font-display text-3xl font-semibold">Applicants</h1>
        <p class="mt-2 text-base text-ink-3 font-light">
            You have {{ $applicants->total() }} {{ Str::plural('applicant', $applicants->total()) }} total.
        </p>
    </div>

    {{-- Filters --}}
    <form method="GET" action="{{ route('employer.applicants') }}"
        class="flex flex-col md:flex-row items-end gap-3 mb-8 rounded-2xl">

        <div class="flex-1 w-full min-w-60">
            <input type="text" placeholder="Search applicants by name..."
                class="input outline-none input-sm w-full" />
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:flex items-center gap-3 w-full md:w-auto">
            @php
                $jobOptions = is_array($jobs) ? $jobs : $jobs->toArray();
            @endphp

            <select name="job_id" class="select outline-none w-full max-w-xs select-sm"
                @change="$el.closest('form').submit()">
                <option value="">All jobs</option>
                @foreach ($jobOptions as $id => $title)
                    <option value="{{ $id }}" @selected(request('job_id') == $id)>
                        {{ $title }}
                    </option>
                @endforeach
            </select>

            <select name="status" class="select outline-none w-full max-w-xs select-sm"
                @change="$el.closest('form').submit()">
                <option value="">All statuses</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status }}" @selected(request('status') == $status)>
                        {{ ucfirst($status) }}
                    </option>
                @endforeach
            </select>

            <div class="flex items-center gap-2">
                <button type="submit" class="btn btn-ghost btn-sm">
                    Search
                </button>
                @if (count($filters))
                    <a href="{{ route('employer.applicants') }}" class="btn btn-neutral btn-sm">
                        Clear
                    </a>
                @endif
            </div>
        </div>
    </form>

    {{-- Table Container --}}
    <div class="bg-surface border border-border rounded-3xl overflow-hidden shadow-sm">
        {{-- Table Header --}}
        <div
            class="hidden lg:grid grid-cols-[2fr_1.5fr_1fr_1.5fr_0.8fr] gap-4 px-6 py-4 bg-surface-2/50 border-b border-border">
            @foreach (['Applicant', 'Position', 'Applied Date', 'Current Status', 'Action'] as $th)
                <div class="text-[11px] font-bold uppercase tracking-widest text-ink-4">{{ $th }}</div>
            @endforeach
        </div>

        {{-- Table Body --}}
        <div class="divide-y divide-border/60">
            @forelse($applicants as $applicant)
                <div
                    class="group grid grid-cols-1 lg:grid-cols-[2fr_1.5fr_1fr_1.5fr_0.8fr] gap-4 px-6 py-5 items-center hover:bg-surface-2/30 transition-all duration-200 hover:cursor-pointer">

                    {{-- Applicant Info --}}
                    <div class="flex items-center gap-4">
                        <div class="avatar avatar-placeholder">
                            <div class="{{ fake()->randomElement(['bg-slate-bg', 'bg-teal-bg']) }} w-12 rounded">
                                <span class="text-sm text-ink">
                                    {{ strtoupper(substr($applicant->seeker->user->first_name, 0, 2)) }}
                                    {{ strtoupper(substr($applicant->seeker->user->first_last, 0, 2)) }}
                                </span>
                            </div>
                        </div>
                        <div class="min-w-0">
                            <p class="font-bold text-ink truncate group-hover:text-primary transition-colors">
                                {{ $applicant->seeker->user->first_name }} {{ $applicant->seeker->user->last_name }}
                            </p>
                            <p class="text-xs text-ink-3 truncate mt-0.5">
                                {{ $applicant->seeker->skills->take(2)->pluck('name')->join(' • ') ?: 'No skills listed' }}
                            </p>
                        </div>
                    </div>

                    {{-- Job Title --}}
                    <div class="text-sm font-medium text-ink-2">
                        <span class="lg:hidden text-2xs text-ink-4 block uppercase font-bold mb-1">Position</span>
                        {{ $applicant->job->title }}
                    </div>

                    {{-- Date --}}
                    <div class="text-sm text-ink-3">
                        <span class="lg:hidden text-2xs text-ink-4 block uppercase font-bold mb-1">Applied</span>
                        {{ $applicant->created_at->format('M d, Y') }}
                    </div>

                    <x-ui.badge type="{{ $applicant->status->value }}">
                        {{ $applicant->status->label() }}
                    </x-ui.badge>


                    {{-- Actions --}}
                    <div class="flex lg:justify-end gap-2 mt-2 lg:mt-0">
                        <a href="{{ route('employer.applicants.show', $applicant->id) }}"
                            class="btn btn-xs bg-gray-100 border-gray-300">
                            Profile
                        </a>
                        <a href="{{ route('employer.applicants.show', $applicant->id) }}"
                            class="btn btn-xs btn-success btn-soft border border-success">
                            Accept
                        </a>
                        <a href="{{ route('employer.applicants.show', $applicant->id) }}"
                            class="btn btn-xs btn-error btn-soft border border-error">
                            Delete
                        </a>
                    </div>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center py-20 px-4">
                    <div class="p-4 bg-surface-2 rounded-full mb-4">
                        <x-heroicon-o-users class="w-10 h-10 text-ink-4" />
                    </div>
                    <p class="text-ink-2 font-semibold">No applicants found</p>
                    <p class="text-sm text-ink-4">Try adjusting your filters or search terms.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Pagination --}}
    {{ $applicants->links() }}
</x-layouts.employer>
