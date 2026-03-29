<x-layouts.employer title="Manage Teams">
    <div class="mb-7">
        <p class="font-light uppercase text-ink-4 tracking-widest text-sm mb-2">Company</p>
        <h1 class="font-display text-3xl font-semibold">Manage Teams</h1>
        <p class="mt-2 text-base text-ink-3 font-light">
            Add teams and members to showcase your company culture on your public profile.
        </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
        @foreach ($teams as $team)
            <div class="rounded-xl border border-border bg-surface overflow-hidden flex flex-col shadow-sm">
                <div class="h-24 relative group">
                    @if ($team->cover)
                        <img src="{{ asset('storage/' . $team->cover) }}"
                            class="absolute inset-0 w-full h-full object-cover">
                    @else
                        <div class="absolute inset-0 bg-linear-to-br from-ink to-accent-dark"></div>
                    @endif
                    <div class="absolute inset-0 bg-black/30"></div>
                    <div
                        class="absolute bottom-3 left-4 text-white text-2xs font-bold uppercase tracking-widest opacity-80">
                        {{ $team->name }}
                    </div>
                </div>

                <div class="p-5 flex flex-col flex-1">
                    <h3 class="font-display text-lg text-ink mb-1">{{ $team->name }}</h3>
                    <p class="text-sm text-ink-3 line-clamp-2 mb-4 leading-relaxed">{{ $team->description }}</p>

                    <div class="flex items-center gap-1">
                        @if ($team->members->count() > 0)
                            <div class="avatar-group -space-x-3">
                                @foreach ($team->members->take(3) as $member)
                                    <div class="avatar avatar-placeholder">
                                        <div
                                            class="{{ fake()->randomElement(['bg-slate-bg', 'bg-teal-bg']) }} w-6 rounded-full">
                                            <span class="text-xs text-ink">
                                                {{ strtoupper(substr($member->name, 0, 2)) }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            @if ($team->members->count() > 3)
                                <span class="text-xs text-ink-3">
                                    +{{ $team->members->count() - 3 }} more
                                </span>
                            @endif
                        @else
                            <span class="text-sm text-ink-3">No members yet</span>
                        @endif
                    </div>

                    <div class="grid grid-cols-3 gap-2 mt-5 pt-4 border-t border-border">
                        <button x-data
                            @click.stop="
                                document.getElementById('addMember').showModal();
                                window.dispatchEvent(new CustomEvent('set-team-context', { detail: { id: '{{ $team->id }}', name: '{{ $team->name }}' } }));
                            "
                            class="btn btn-sm btn-outline col-span-1 px-0" title="Add Member">
                            Add member
                        </button>

                        <form action="{{ route('employer.teams.destroy', $team->id) }}" method="POST"
                            class="col-span-1">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-error w-full"
                                onclick="return confirm('Delete team?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

        <button x-data @click.stop="document.getElementById('addTeam').showModal()"
            class="group rounded-xl border-2 border-dashed border-border p-6 flex flex-col items-center justify-center text-center hover:border-primary hover:bg-primary-bg/30 transition-all min-h-70">
            <div
                class="w-12 h-12 rounded-full bg-surface-2 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-ink-4 group-hover:text-primary"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </div>
            <p class="font-bold text-ink group-hover:text-primary">Add a new team</p>
            <p class="text-xs text-ink-4 mt-1 max-w-50">Showcase another team on your public company profile</p>
        </button>
    </div>

    {{-- All Members Table --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-xl font-display text-ink">All team members</h2>
            <p class="text-sm text-ink-3">{{ $allMembers->count() }} members across {{ $teams->count() }} teams</p>
        </div>
    </div>

    <div class="rounded-xl border border-border bg-surface overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full border-collapse text-left">
                <thead>
                    <tr class="bg-surface-2 border-b border-border">
                        <th class="px-4 sm:px-6 py-4 text-[11px] font-bold uppercase tracking-wider text-ink-4">Member
                        </th>
                        <th class="px-4 sm:px-6 py-4 text-[11px] font-bold uppercase tracking-wider text-ink-4">Role
                        </th>
                        <th class="px-4 sm:px-6 py-4 text-[11px] font-bold uppercase tracking-wider text-ink-4">Team
                        </th>
                        <th
                            class="px-4 sm:px-6 py-4 text-[11px] font-bold uppercase tracking-wider text-ink-4 text-right">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @foreach ($allMembers as $member)
                        <tr class="hover:bg-surface-2/50 transition-colors group">
                            <td class="px-4 sm:px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="min-w-0">
                                        <p class="font-bold text-ink text-sm">{{ $member->name }}</p>
                                        <p class="text-xs text-ink-4 line-clamp-1 max-w-45 sm:max-w-xs">
                                            {{ $member->bio }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 sm:px-6 py-4">
                                <span class="text-sm text-ink-2 font-medium">{{ $member->position }}</span>
                            </td>
                            <td class="px-4 sm:px-6 py-4">
                                <x-ui.badge type="{{ fake()->randomElement(['fancy', 'success', 'warning', 'info']) }}"
                                    size="sm">
                                    {{ $member->team->name }}
                                </x-ui.badge>
                            </td>
                            <td class="px-4 sm:px-6 py-4 text-right">
                                <div
                                    class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <form
                                        action="{{ route('employer.teams.members.destroy', [$member->team_id, $member->id]) }}"
                                        method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-ghost btn-sm h-8 w-8 p-0 text-error hover:bg-error/10">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- MODAL: Add Team --}}
    <dialog id="addTeam" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold mb-4">Add a new team</h3>
            <form action="{{ route('employer.teams.store') }}" method="POST" class="space-y-4"
                enctype="multipart/form-data">
                @csrf
                <x-ui.input name="name" label="Team name" placeholder="e.g. Core Engineering" required />
                <x-ui.select name="category" label="Category" :options="[
                    'engineering' => 'Engineering',
                    'design' => 'Design',
                    'product' => 'Product',
                    'marketing' => 'Marketing',
                    'data' => 'Data',
                    'operations' => 'Operations',
                ]" placeholder="Pick a category..." />
                <fieldset class="fieldset my-0">
                    <legend class="fieldset-legend text-xs font-normal">Team description</legend>
                    <textarea name="description" placeholder="What does this team do?"
                        class="textarea textarea-sm w-full @error('description') textarea-error @enderror"></textarea>
                    @error('description')
                        <div class="text-xs text-error flex items-center gap-1 -mt-0.5">{{ $message }}</div>
                    @enderror
                </fieldset>
                <fieldset class="fieldset my-0">
                    <legend class="fieldset-legend text-xs font-normal">Team banner</legend>
                    <input type="file" name="banner" class="file-input file-input-sm w-full" accept="image/*" />
                </fieldset>

                <div class="modal-action mt-6">
                    <button type="button" class="btn btn-ghost btn-sm"
                        onclick="document.getElementById('addTeam').close()">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm">Create team</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop"><button>close</button></form>
    </dialog>

    {{-- MODAL: Add Member --}}
    <dialog id="addMember" class="modal">
        <div class="modal-box" x-data="{ teamId: '', teamName: 'Select a team' }"
            @set-team-context.window="teamId = $event.detail.id; teamName = $event.detail.name">
            <h3 class="text-lg font-bold mb-4">Add team member</h3>
            <form
                x-bind:action="'{{ route('employer.teams.members.store', '__TEAM_ID__') }}'.replace('__TEAM_ID__', teamId)"
                method="POST" class="space-y-4">
                @csrf
                <div class="p-3 bg-surface-2 rounded-lg border border-border mb-4">
                    <p class="text-2xs uppercase tracking-widest text-ink-4 font-bold">Adding to</p>
                    <p class="text-sm font-bold text-accent" x-text="teamName"></p>
                    <input type="hidden" name="team_id" :value="teamId">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <x-ui.input name="first_name" label="First Name" placeholder="Jane" required />
                    <x-ui.input name="last_name" label="Last Name" placeholder="Doe" required />
                </div>
                <x-ui.input name="position" label="Job title / role" placeholder="e.g. Senior Engineer" required />
                <fieldset class="fieldset my-0">
                    <legend class="fieldset-legend text-xs font-normal">Short bio</legend>
                    <textarea name="bio" placeholder="A short sentence about background..."
                        class="textarea textarea-sm w-full @error('bio') textarea-error @enderror"></textarea>
                    @error('bio')
                        <div class="text-xs text-error flex items-center gap-1 -mt-0.5">{{ $message }}</div>
                    @enderror
                </fieldset>

                <div class="modal-action mt-6">
                    <button type="button" class="btn btn-ghost btn-sm"
                        onclick="document.getElementById('addMember').close()">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm">Add member</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop"><button>close</button></form>
    </dialog>
</x-layouts.employer>
