<x-layouts.employer :title="$applicant->seeker->user->first_name . ' — Applicant'" :heading="$applicant->seeker->user->first_name . ' ' . $applicant->seeker->user->last_name">

    <div class="mb-7">
        <a href="{{ route('employer.applicants') }}"
            class="flex items-center gap-1 font-light uppercase text-ink-4 text-sm mb-2 hover:underline hover:text-primary">
            <x-heroicon-m-arrow-left class="w-4 h-4" /> Back to applicants
        </a>
        <h1 class="font-display text-3xl font-semibold">Applicant Profile</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-[1fr_350px] gap-5 items-start">

        {{-- Left --}}
        <div class="flex flex-col gap-5">

            {{-- Hero card --}}
            <div class="rounded-xl bg-surface border border-border overflow-hidden">
                <div class="p-5 lg:p-6">
                    <div class="flex items-start gap-4 mb-5">
                        <div class="avatar avatar-placeholder">
                            <div class="{{ fake()->randomElement(['bg-slate-bg', 'bg-teal-bg']) }} w-16 rounded-full">
                                <span class="text-lg text-ink">
                                    {{ strtoupper(substr($applicant->seeker->user->first_name, 0, 2)) }}
                                    {{ strtoupper(substr($applicant->seeker->user->first_last, 0, 2)) }}
                                </span>
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-1 flex-wrap">
                                <h2 class="font-display text-3xl">
                                    {{ $applicant->seeker->user->first_name }}
                                    {{ $applicant->seeker->user->last_name }}
                                </h2>
                                <x-ui.badge :type="$applicant->status->value">
                                    {{ $applicant->status->label() }}
                                </x-ui.badge>
                            </div>
                            <p class="mb-3 text-base text-ink-3">
                                Applied for:
                                <strong class="text-ink">{{ $applicant->job->title }}</strong>
                                · {{ $applicant->created_at->format('M d, Y') }}
                            </p>
                            <div class="flex flex-wrap gap-3">
                                <span class="flex items-center gap-1.5 text-sm text-ink-3">
                                    <x-heroicon-m-envelope class="w-3.5 h-3.5" />
                                    {{ $applicant->seeker->user->email }}
                                </span>
                                @if ($applicant->seeker->phone)
                                    <span class="flex items-center gap-1.5 text-sm text-ink-3">
                                        <x-heroicon-m-phone class="w-3.5 h-3.5" />
                                        {{ $applicant->seeker->phone }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-2 pt-5 border-t border-border">
                        @if ($applicant->attachment)
                            <a target="_blank" href="{{ asset('storage/' . $applicant->attachment) }}"
                                class="btn btn-neutral btn-sm">
                                <x-heroicon-m-arrow-down-tray class="w-4 h-4" />
                                Download CV
                            </a>
                        @endif
                        <a href="{{ route('employer.applicants') }}" class="btn btn-sm btn-ghost btn-outline">
                            <x-heroicon-m-list-bullet class="w-4 h-4" />
                            All applicants
                        </a>
                    </div>
                </div>
            </div>

            {{-- Bio --}}
            @if ($applicant->seeker->bio)
                <div class="rounded-xl bg-surface border border-border">
                    <h4 class="font-medium text-md border-b border-border p-5">About</h4>
                    <div class="p-5 lg:p-6">
                        <p class="text-base/relaxed text-ink-2">{{ $applicant->seeker->bio }}</p>
                    </div>
                </div>
            @endif

            {{-- Cover letter --}}
            @if ($applicant->cover_letter)
                <div class="rounded-xl bg-surface border border-border">
                    <h4 class="font-medium text-md border-b border-border p-5">Cover letter</h4>
                    <div class="p-5 lg:p-6">
                        <p class="text-base/relaxed text-ink-2">{{ $applicant->cover_letter }}</p>
                    </div>
                </div>
            @endif

            {{-- Skills --}}
            @if ($applicant->seeker->skills->isNotEmpty())
                <div class="rounded-xl bg-surface border border-border">
                    <h4 class="font-medium text-md border-b border-border p-5">Skills</h4>
                    <div class="p-5 lg:p-6 flex flex-wrap gap-2">
                        @foreach ($applicant->seeker->skills as $skill)
                            <x-ui.badge>{{ $skill->name }}</x-ui.badge>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Experience --}}
            @if ($applicant->seeker->experiences->isNotEmpty())
                <div class="rounded-xl bg-surface border border-border">
                    <h4 class="font-medium text-md border-b border-border p-5">Work experience</h4>
                    <div class="px-5 lg:px-6">
                        @foreach ($applicant->seeker->experiences->sortByDesc('start_date') as $exp)
                            <div class="flex gap-3 py-4 border-b border-border last:border-none">
                                <div class="avatar avatar-placeholder self-start">
                                    <div
                                        class="{{ fake()->randomElement(['bg-slate-bg', 'bg-teal-bg']) }} w-16 rounded">
                                        <span class="text-lg text-ink">
                                            {{ strtoupper(substr($exp->company, 0, 2)) }}
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <p class="font-medium text-base text-ink">{{ $exp->position }}</p>
                                    <p class="text-sm text-ink-3">{{ $exp->company }} · {{ $exp->job_type }}</p>
                                    <p class="text-xs text-ink-4">
                                        {{ $exp->start_date->format('M Y') }} —
                                        {{ $exp->end_date ? $exp->end_date->format('M Y') : 'Present' }}
                                    </p>
                                    @if ($exp->description)
                                        <p class="mt-1.5 text-sm/normal text-ink-2">{{ $exp->description }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Education --}}
            @if ($applicant->seeker->educations->isNotEmpty())
                <div class="rounded-xl bg-surface border border-border">
                    <h4 class="font-medium text-md border-b border-border p-5">Education</h4>
                    <div class="px-5 lg:px-6">
                        @foreach ($applicant->seeker->educations->sortByDesc('start_year') as $edu)
                            <div class="flex gap-3 py-4 border-b border-border last:border-none">
                                <div class="avatar avatar-placeholder self-start">
                                    <div
                                        class="{{ fake()->randomElement(['bg-slate-bg', 'bg-teal-bg']) }} w-16 rounded">
                                        <span class="text-lg text-ink">
                                            {{ strtoupper(substr($edu->school, 0, 2)) }}
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <p class="font-medium text-base text-ink">{{ $edu->degree }}</p>
                                    <p class="text-sm text-ink-3">{{ $edu->school }} · {{ $edu->field_of_study }}</p>
                                    <p class="text-xs text-ink-4">{{ $edu->start_year }} —
                                        {{ $edu->end_year ?? 'Present' }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>

        {{-- Right sidebar --}}
        <div class="flex flex-col gap-5 lg:sticky lg:top-5">

            {{-- Status update --}}
            <div class="rounded-xl bg-surface border border-border overflow-hidden">
                <h4 class="font-medium text-base border-b border-border p-5">Update status</h4>
                <div class="p-5">
                    <form id="statusForm" action="{{ route('employer.applicants.status', $applicant->id) }}"
                        method="POST" class="flex flex-col gap-3">
                        @csrf @method('PATCH')

                        <select name="status" class="select select-bordered outline-none w-full"
                            onchange="this.form.submit()">
                            @foreach ($statuses as $status)
                                <option value="{{ $status }}" @selected($applicant->status->value === $status)>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>

                        <button type="submit" class="btn btn-neutral btn-sm w-full">
                            Update status
                        </button>
                    </form>

                    <div class="grid grid-cols-2 gap-2 mt-3">
                        <button type="button" class="btn btn-success btn-soft border-success btn-sm"
                            onclick="document.querySelector('#statusForm select').value='accepted'; document.getElementById('statusForm').submit()">
                            Accept
                        </button>

                        <button type="button" class="btn btn-error btn-soft btn-sm border-error"
                            onclick="if(confirm('Reject this candidate?')){document.querySelector('#statusForm select').value='rejected'; document.getElementById('statusForm').submit()}">
                            Reject
                        </button>
                    </div>
                </div>
            </div>

            {{-- Application info --}}
            <div class="rounded-xl bg-surface border border-border overflow-hidden">
                <h4 class="font-medium text-base border-b border-border p-5">Application info</h4>
                <div class="px-5 pb-2">
                    @foreach ([['label' => 'Applied for', 'value' => $applicant->job->title], ['label' => 'Applied on', 'value' => $applicant->created_at->format('M d, Y')], ['label' => 'Salary expect.', 'value' => '$' . number_format($applicant->expected_salary)]] as $row)
                        <div
                            class="flex items-start justify-between gap-3 py-3 border-b border-border last:border-none">
                            <span class="text-sm text-ink-4">{{ $row['label'] }}</span>
                            <span class="font-medium text-right text-sm text-ink">{{ $row['value'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Attachments --}}
            @if ($applicant->seeker->attachments->isNotEmpty())
                <div class="rounded-xl bg-surface border border-border overflow-hidden">
                    <h4 class="font-medium text-base border-b border-border p-5">Documents</h4>
                    <div class="p-5 flex flex-col gap-2">
                        @foreach ($applicant->seeker->attachments as $attachment)
                            <a href="{{ asset('storage/' . $attachment->path) }}" target="_blank"
                                class="flex items-center gap-2.5 p-2.5 rounded-xl bg-surface-2 border border-border hover:border-ink-4 transition-colors">
                                <div
                                    class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 bg-danger-bg text-danger">
                                    <x-heroicon-o-document class="w-4 h-4" />
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="truncate font-medium text-sm text-ink">{{ $attachment->name }}</p>
                                    <p class="text-xs text-ink-4">{{ strtoupper($attachment->type) }}</p>
                                </div>
                                <x-heroicon-m-arrow-down-tray class="w-3.5 h-3.5 shrink-0 text-ink-4" />
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-layouts.employer>
