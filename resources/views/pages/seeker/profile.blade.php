<x-layouts.seeker title="My Profile">

    <div class="mb-7">
        <p class="font-light uppercase text-ink-4 tracking-widest text-sm mb-2">Account</p>
        <h1 class="font-display text-3xl font-semibold">My Profile</h1>
        <p class="mt-2 text-base text-ink-3 font-light">
            Keep your profile updated to attract the right opportunities.
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6">
        <div class="lg:col-span-2 space-y-4 md:space-y-6">
            <div class="bg-surface border border-border rounded-xl overflow-hidden" x-data="{ editing: false }">
                <div class="flex items-center justify-between px-4 py-3 md:px-6 md:py-4 border-b border-border">
                    <h3 class="text-md md:text-lg font-medium text-ink">Personal information</h3>
                    <button @click="editing = !editing" class="btn btn-sm btn-neutral px-3 py-1">
                        <span x-text="editing ? 'Cancel' : 'Edit'"></span>
                    </button>
                </div>

                <div class="p-4 md:p-6">
                    <div x-show="!editing" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0">
                        <div class="flex flex-col md:flex-row items-start md:items-center gap-4 mb-6 md:mb-8">
                            <div class="avatar">
                                <div class="w-16 rounded">
                                    <img src="{{ $seeker->avatar ? asset('storage/' . $seeker->avatar) : $seeker->user->name }}"
                                        alt="{{ $seeker->user->first_name }}" />
                                </div>
                            </div>
                            <div class="space-y-1">
                                <h2 class="font-display text-lg md:text-xl text-ink mb-0">
                                    {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                                </h2>
                                <span class="text-sm md:text-base text-ink-3 block">
                                    {{ $seeker->headline ?? 'Senior UX Designer · 8+ years experience' }}
                                </span>
                                <div class="flex flex-wrap gap-2">
                                    <x-ui.badge class="border border-border">Open to work</x-ui.badge>
                                    <x-ui.badge class="border border-border">Full-time</x-ui.badge>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-6">
                            <div class="space-y-0.5">
                                <div class="text-2x md:text-xs text-ink-4 uppercase tracking-wider font-semibold">First
                                    name</div>
                                <div class="text-sm md:text-base text-ink-2">
                                    {{ auth()->user()->first_name }}
                                </div>
                            </div>
                            <div class="space-y-0.5">
                                <div class="text-2xs md:text-xs text-ink-4 uppercase tracking-wider font-semibold">Last
                                    name</div>
                                <div class="text-sm md:text-base text-ink-2">
                                    {{ auth()->user()->last_name }}
                                </div>
                            </div>
                            <div class="space-y-0.5">
                                <div class="text-2xs md:text-xs text-ink-4 uppercase tracking-wider font-semibold">Email
                                </div>
                                <div class="text-sm md:text-base text-primary font-medium">
                                    {{ auth()->user()->email }}
                                </div>
                            </div>
                            <div class="space-y-0.5">
                                <div class="text-2xs md:text-xs text-ink-4 uppercase tracking-wider font-semibold">Phone
                                </div>
                                <div class="text-sm md:text-base text-ink-2">
                                    {{ $seeker->phone ?? 'Not provided' }}
                                </div>
                            </div>
                            <div class="space-y-0.5">
                                <div class="text-2xs md:text-xs text-ink-4 uppercase tracking-wider font-semibold">
                                    Portfolio</div>
                                <div class="text-sm md:text-base text-primary">
                                    {{ 'Not provided' }}
                                </div>
                            </div>
                            <div class="space-y-0.5">
                                <div class="text-2xs md:text-xs text-ink-4 uppercase tracking-wider font-semibold">
                                    Linkedin</div>
                                <div class="text-sm md:text-base text-ink-2">
                                    {{ 'Not provided' }}
                                </div>
                            </div>
                            <div class="sm:col-span-2 space-y-0.5 pt-2 border-t border-border/50">
                                <div class="text-2xs md:text-xs text-ink-4 uppercase tracking-wider font-semibold">Bio
                                </div>
                                <div class="text-sm md:text-base/relaxed text-ink-2">
                                    {{ $seeker->bio ?? 'No bio added yet...' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <form x-show="editing" action="{{ route('seeker.profile.update') }}" method="POST"
                        enctype="multipart/form-data" class="flex flex-col gap-4 md:gap-6" x-cloak
                        x-transition:enter="transition ease-out duration-200">
                        @csrf @method('PUT')

                        <div
                            class="flex flex-col md:flex-row items-center gap-4 p-4 rounded-lg bg-surface-2/50 border border-dashed border-border w-full">
                            <div class="avatar">
                                <div class="w-16 rounded">
                                    <img src="{{ asset('storage/' . $seeker->avatar) }}"
                                        alt="{{ $seeker->user->first_name }}" />
                                </div>
                            </div>
                            <div class="space-y-1 text-center sm:text-left">
                                <p class="text-sm font-medium text-ink">Profile Photo</p>
                                <input type="file" name="avatar" class="file-input file-input-sm w-full" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <x-ui.input name="first_name" label="First name" value="{{ auth()->user()->first_name }}"
                                :error="$errors->first('first_name')" class="w-full" />
                            <x-ui.input name="last_name" label="Last name" value="{{ auth()->user()->last_name }}"
                                :error="$errors->first('last_name')" class="w-full" />
                            <x-ui.input name="phone" label="Phone" icon="phone" value="{{ $seeker->phone }}"
                                placeholder="+1 (555) 000-0000" class="w-full" />
                            {{-- TODO add location, portfolio, linkedin --}}
                        </div>


                        <fieldset class="fieldset">
                            <legend class="fieldset-legend text-sm font-medium text-ink">Bio</legend>
                            <textarea class="textarea textarea-lg text-sm h-30 w-full" placeholder="Bio">{{ $seeker->bio }}</textarea>
                        </fieldset>

                        <div class="flex flex-col sm:flex-row justify-end gap-2 pt-2">
                            <button type="button" class="btn btn-sm w-full md:w-auto btn-ghost"
                                @click="editing = false">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-neutral btn-sm w-full md:w-auto">
                                <x-heroicon-m-check class="w-4 h-4 mr-1" /> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Skills card --}}
            <div class="bg-surface border border-border rounded-xl overflow-hidden mt-6">
                <div class="flex items-center justify-between px-4 py-3 md:px-6 md:py-4 border-b border-border">
                    <h3 class="text-lg md:text-xl font-medium text-ink">skills & expertise</h3>
                    <button onclick="document.getElementById('skills-modal').showModal()"
                        class="btn btn-sm btn-neutral px-3 py-1">
                        Edit
                    </button>
                </div>

                <div class="p-4 md:p-6">
                    <div class="flex flex-wrap gap-2">
                        @forelse ($seeker->skills as $skill)
                            <div
                                class="flex items-center gap-1.5 bg-surface-2 border border-border rounded-full px-3 py-1.5 text-sm text-ink-2">
                                {{ $skill->name }}
                            </div>
                        @empty
                            <p class="text-sm text-ink-4">No skills added yet.</p>
                        @endforelse

                        <button type="button" onclick="document.getElementById('skills-modal').showModal()"
                            class="flex items-center gap-1.5 bg-primary-bg border border-primary/20 rounded-full px-3 py-1.5 text-sm text-primary hover:bg-accent/10 transition">
                            <x-heroicon-m-plus class="w-3.5 h-3.5" /> Add skill
                        </button>
                    </div>
                </div>
            </div>

            {{-- Skills Modal --}}
            <dialog id="skills-modal" class="modal">
                <div class="modal-box bg-surface border border-border rounded-xl max-w-2xl p-0 overflow-hidden">
                    <div class="flex items-center justify-between px-6 py-4 border-b border-border">
                        <h3 class="text-lg font-medium text-ink">Skills & Expertise</h3>
                        <form method="dialog">
                            <button class="btn btn-sm btn-ghost btn-circle text-ink-4">
                                <x-heroicon-m-x-mark class="w-4 h-4" />
                            </button>
                        </form>
                    </div>
                    <form action="{{ route('seeker.skills.sync') }}" method="POST">
                        @csrf
                        <div class="p-6">
                            <div class="rounded-xl p-4 md:p-5 bg-surface-2/50 border border-border">
                                <p class="text-sm font-medium text-ink mb-4">Select your expertise</p>
                                <div class="flex flex-wrap gap-2 max-h-64 overflow-y-auto pr-2 custom-scrollbar">
                                    @foreach ($allSkills as $skill)
                                        @php $hasSkill = $seeker->skills->contains($skill->id); @endphp
                                        <label x-data="{ checked: {{ $hasSkill ? 'true' : 'false' }} }"
                                            :class="checked ? 'bg-primary text-white border-primary' :
                                                'bg-surface border-border text-ink-2 hover:border-primary/50'"
                                            class="flex items-center gap-2 rounded-full px-4 py-1.5 cursor-pointer border transition-all duration-200 text-sm">
                                            <input type="checkbox" name="skills[]" value="{{ $skill->id }}"
                                                class="sr-only" @checked($hasSkill)
                                                @change="checked = $event.target.checked">
                                            {{ $skill->name }}
                                            <x-heroicon-m-check x-show="checked" class="w-3.5 h-3.5" />
                                            <x-heroicon-m-plus x-show="!checked" class="w-3.5 h-3.5 text-ink-4" />
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end gap-2 px-6 py-4 border-t border-border">
                            <form method="dialog">
                                <button type="button" class="btn btn-sm btn-ghost w-full md:w-auto">Cancel</button>
                            </form>
                            <button type="submit" class="btn btn-neutral btn-sm w-full md:w-auto">
                                <x-heroicon-m-check class="w-4 h-4 mr-1" /> Save Selections
                            </button>
                        </div>
                    </form>
                </div>
                <form method="dialog" class="modal-backdrop">
                    <button>close</button>
                </form>
            </dialog>

            {{-- Work experience card --}}
            <div class="bg-surface border border-border rounded-xl overflow-hidden">
                <div class="flex items-center justify-between px-4 py-3 md:px-6 md:py-4 border-b border-border">
                    <h3 class="text-lg md:text-xl font-medium text-ink">Work experience</h3>
                    <button onclick="document.getElementById('experience-modal').showModal()"
                        class="btn btn-sm btn-neutral px-3 py-1">
                        <x-heroicon-m-plus class="w-3.5 h-3.5 mr-1" /> Add
                    </button>
                </div>
                <div class="p-4 md:p-6">
                    {{-- Experience list --}}
                    @forelse($seeker->experiences->sortByDesc('start_date') as $exp)
                        <div
                            class="flex gap-3 md:gap-4 py-4 border-b border-border {{ $loop->last ? 'border-none' : '' }}">
                            <div class="avatar avatar-placeholder self-start">
                                <div class="{{ fake()->randomElement(['bg-slate-bg', 'bg-teal-bg']) }} w-12 rounded">
                                    <span class="text-lg text-ink">
                                        {{ strtoupper(substr($exp->company, 0, 2)) }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between gap-2 mb-0.5">
                                    <p class="font-medium text-sm md:text-base text-ink">
                                        {{ $exp->position }}
                                    </p>
                                    <form action="{{ route('seeker.experience.destroy', $exp->id) }}" method="POST"
                                        class="shrink-0">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="w-7 h-7 text-ink-4 rounded-lg flex items-center justify-center cursor-pointer transition-all duration-150 bg-transparent border border-border hover:bg-danger-bg hover:text-danger"
                                            onclick="return confirm('Remove this experience?')">
                                            <x-heroicon-m-trash class="w-3.5 h-3.5" />
                                        </button>
                                    </form>
                                </div>
                                <p class="text-xs md:text-sm text-ink-3 mb-0.5">
                                    {{ $exp->company }} · {{ $exp->job_type }}
                                </p>
                                <p class="text-2xs md:text-xs text-ink-4">
                                    {{ $exp->start_date->format('M Y') }} —
                                    {{ $exp->end_date ? $exp->end_date->format('M Y') : 'Present' }}
                                </p>
                                @if ($exp->description)
                                    <p class="mt-2 text-xs md:text-sm/normal text-ink-2">
                                        {{ $exp->description }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-ink-4">No experience added yet.</p>
                    @endforelse
                </div>
            </div>

            {{-- Work Experience Modal --}}
            <dialog id="experience-modal" class="modal">
                <div class="modal-box bg-surface border border-border rounded-xl max-w-2xl p-0 overflow-hidden">
                    <div class="flex items-center justify-between px-6 py-4 border-b border-border">
                        <h3 class="text-lg font-medium text-ink">Add Work Experience</h3>
                        <form method="dialog">
                            <button class="btn btn-sm btn-ghost btn-circle text-ink-4">
                                <x-heroicon-m-x-mark class="w-4 h-4" />
                            </button>
                        </form>
                    </div>
                    <form action="{{ route('seeker.experience.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="p-6 flex flex-col gap-4">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <x-ui.input name="company" label="Company name" :error="$errors->first('company')" class="w-full" />
                                <x-ui.input name="position" label="Job title" :error="$errors->first('position')" class="w-full" />
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <x-ui.input name="website" label="Company website" type="url" :optional="true"
                                    :error="$errors->first('website')" class="w-full" />
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <x-ui.input name="start_date" label="Start date" type="date" :error="$errors->first('start_date')"
                                    class="w-full" />
                                <x-ui.input name="end_date" label="End date" type="date" :optional="true"
                                    :error="$errors->first('end_date')" class="w-full" />
                            </div>
                        </div>
                        <div class="flex justify-end gap-2 px-6 py-4 border-t border-border">
                            <form method="dialog">
                                <button type="button" class="btn btn-sm btn-ghost w-full md:w-auto">Cancel</button>
                            </form>
                            <button type="submit" class="btn btn-neutral btn-sm w-full md:w-auto">
                                <x-heroicon-m-check class="w-4 h-4 mr-1" /> Add Experience
                            </button>
                        </div>
                    </form>
                </div>
                <form method="dialog" class="modal-backdrop">
                    <button>close</button>
                </form>
            </dialog>

            {{-- Education --}}
            <div class="bg-surface border border-border rounded-xl overflow-hidden">
                <div class="flex items-center justify-between px-4 py-3 md:px-6 md:py-4 border-b border-border">
                    <h3 class="text-lg md:text-xl font-medium text-ink">Education</h3>
                    <button onclick="document.getElementById('education-modal').showModal()"
                        class="btn btn-sm btn-neutral px-3 py-1">
                        <x-heroicon-m-plus class="w-3.5 h-3.5 mr-1" /> Add
                    </button>
                </div>
                <div class="p-4 md:p-6">
                    {{-- Education list --}}
                    @forelse($seeker->educations->sortByDesc('start_year') as $edu)
                        <div
                            class="flex gap-3 md:gap-4 py-4 border-b border-border {{ $loop->last ? 'border-none' : '' }}">
                            <div class="avatar avatar-placeholder self-start">
                                <div
                                    class="{{ fake()->randomElement(['bg-slate-bg', 'bg-teal-bg', 'bg-indigo-bg']) }} w-12 rounded">
                                    <span class="text-lg text-ink">
                                        {{ strtoupper(substr($edu->school, 0, 2)) }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-2 mb-0.5">
                                    <p class="font-medium text-sm md:text-base text-ink">
                                        {{ $edu->degree }}
                                    </p>
                                    <form action="{{ route('seeker.education.destroy', $edu->id) }}" method="POST"
                                        class="shrink-0">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="w-7 h-7 text-ink-4 rounded-lg flex items-center justify-center cursor-pointer transition-all duration-150 bg-transparent border border-border hover:bg-danger-bg hover:text-danger"
                                            onclick="return confirm('Remove this education?')">
                                            <x-heroicon-m-trash class="w-3.5 h-3.5" />
                                        </button>
                                    </form>
                                </div>
                                <p class="text-xs md:text-sm text-ink-3 mb-0.5">
                                    {{ $edu->school }} · {{ $edu->field_of_study }}
                                </p>
                                <p class="text-2xs md:text-xs text-ink-4">
                                    {{ $edu->start_year }} — {{ $edu->end_year ?? 'Present' }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-ink-4">No education added yet.</p>
                    @endforelse
                </div>
            </div>

            {{-- Education Modal --}}
            <dialog id="education-modal" class="modal">
                <div class="modal-box bg-surface border border-border rounded-xl max-w-2xl p-0 overflow-hidden">
                    <div class="flex items-center justify-between px-6 py-4 border-b border-border">
                        <h3 class="text-lg font-medium text-ink">Add Education</h3>
                        <form method="dialog">
                            <button class="btn btn-sm btn-ghost btn-circle text-ink-4">
                                <x-heroicon-m-x-mark class="w-4 h-4" />
                            </button>
                        </form>
                    </div>
                    <form action="{{ route('seeker.education.store') }}" method="POST">
                        @csrf
                        <div class="p-6 flex flex-col gap-4">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <x-ui.input name="school" label="School / University" :error="$errors->first('school')"
                                    class="w-full" />
                                <x-ui.input name="address" label="Location" :error="$errors->first('address')" class="w-full" />
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <x-ui.input name="start_year" label="Start year" type="number"
                                    placeholder="{{ date('Y') - 4 }}" :error="$errors->first('start_year')" class="w-full" />
                                <x-ui.input name="end_year" label="End year" type="number"
                                    placeholder="{{ date('Y') }}" :optional="true" :error="$errors->first('end_year')"
                                    class="w-full" />
                            </div>
                        </div>
                        <div class="flex justify-end gap-2 px-6 py-4 border-t border-border">
                            <form method="dialog">
                                <button class="btn btn-sm btn-ghost w-full md:w-auto">Cancel</button>
                            </form>
                            <button type="submit" class="btn btn-neutral btn-sm w-full md:w-auto">
                                <x-heroicon-m-check class="w-4 h-4 mr-1" /> Add Education
                            </button>
                        </div>
                    </form>
                </div>
                <form method="dialog" class="modal-backdrop">
                    <button>close</button>
                </form>
            </dialog>

            {{-- Attachments --}}
            <div class="bg-surface border border-border rounded-xl overflow-hidden" x-data="{ addingFile: false }">
                <div class="flex items-center justify-between px-4 py-3 md:px-6 md:py-4 border-b border-border">
                    <h3 class="text-lg md:text-xl font-medium text-ink">Attachments</h3>
                    <button @click="addingFile = !addingFile" class="btn btn-sm btn-neutral">
                        <x-heroicon-m-plus class="w-3.5 h-3.5" />
                        Upload
                    </button>
                </div>
                <div class="p-4 md:p-6">
                    {{-- Upload form --}}
                    <div x-show="addingFile" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="rounded-xl p-4 md:p-5 mb-5 bg-surface-2 border border-border" x-cloak>
                        <form action="{{ route('seeker.attachments.store') }}" method="POST"
                            enctype="multipart/form-data" class="flex flex-col gap-4">
                            @csrf
                            <div class="space-y-4">
                                <x-ui.input name="name" label="Display name" placeholder="e.g. My Resume 2025"
                                    :error="$errors->first('name')" class="w-full" />
                                <fieldset class="fieldset w-full bg-slate-50">
                                    <legend class="fieldset-legend text-xs font-normal">Upload attachment</legend>
                                    <input type="file" class="file-input file-input-sm w-full" />
                                </fieldset>
                            </div>
                            @error('file')
                                <p class="text-xs text-danger flex items-center gap-1 -mt-3">{{ $message }}</p>
                            @enderror
                            <div class="flex flex-col sm:flex-row justify-end gap-2">
                                <button @click="addingFile = false" type="button"
                                    class="btn btn-sm btn-ghost w-full md:w-auto">
                                    Cancel
                                </button>
                                <button type="submit" class="btn btn-neutral btn-sm w-full md:w-auto">
                                    Upload
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Attachment list --}}
                    @forelse($seeker->attachments as $attachment)
                        <div class="flex items-center gap-3 p-3 rounded-xl mb-2 bg-surface-2 border border-border">
                            <div
                                class="w-9 h-9 rounded-lg flex items-center justify-center shrink-0 bg-danger-bg text-danger">
                                <x-heroicon-o-document class="w-4 h-4" />
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-medium truncate text-sm text-ink">
                                    {{ $attachment->name }}
                                </p>
                                <p class="text-xs text-ink-4">
                                    {{ $attachment->type }} · {{ $attachment->created_at->format('M d, Y') }}
                                </p>
                            </div>
                            <div class="flex gap-2 shrink-0">
                                <form action="{{ route('seeker.attachments.destroy', $attachment->id) }}"
                                    method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="w-7 h-7 text-ink-4 rounded-lg flex items-center justify-center cursor-pointer transition-all duration-150 bg-transparent border border-border hover:bg-danger-bg hover:text-danger"
                                        onclick="return confirm('Remove this education?')">
                                        <x-heroicon-m-trash class="w-3.5 h-3.5" />
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-ink-4">No attachments uploaded yet.</p>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Right column (sidebar) --}}
        <div class="space-y-4 md:space-y-6">
            {{-- Profile strength --}}
            <div class="bg-surface border border-border rounded-xl p-4 md:p-5">
                <h4 class="font-medium text-md md:text-base mb-4">Profile strength</h4>

                {{-- Ring --}}
                <div class="text-center mb-5">
                    <div class="relative inline-flex items-center justify-center w-20 h-20 md:w-24 md:h-24">
                        <svg class="w-full h-full -rotate-90" viewBox="0 0 96 96">
                            <circle cx="48" cy="48" r="40" fill="none"
                                stroke="var(--color-surface-3)" stroke-width="8" />
                            <circle cx="48" cy="48" r="40" fill="none"
                                stroke="var(--color-success)" stroke-width="8" stroke-linecap="round"
                                stroke-dasharray="{{ 2 * 3.14159 * 40 }}"
                                stroke-dashoffset="{{ 2 * 3.14159 * 40 * (1 - $completeness / 100) }}"
                                style="transition: stroke-dashoffset 0.6s ease;" />
                        </svg>
                        <div class="absolute text-center">
                            <p class="font-display leading-none text-xl md:text-2xl text-ink">
                                {{ $completeness }}%
                            </p>
                        </div>
                    </div>
                    <p class="mt-2 text-xs md:text-sm text-ink-3">
                        @if ($completeness >= 80)
                            Great — almost complete!
                        @elseif($completeness >= 50)
                            Good — keep going!
                        @else
                            Getting started
                        @endif
                    </p>
                </div>

                {{-- Checklist --}}
                <div>
                    @foreach ([['done' => (bool) $seeker->avatar, 'label' => 'Photo added'], ['done' => (bool) $seeker->bio, 'label' => 'Bio written'], ['done' => (bool) $seeker->phone, 'label' => 'Phone added'], ['done' => $seeker->skills->isNotEmpty(), 'label' => 'Skills added'], ['done' => $seeker->experiences->isNotEmpty(), 'label' => 'Work experience'], ['done' => $seeker->educations->isNotEmpty(), 'label' => 'Education added'], ['done' => $seeker->attachments->isNotEmpty(), 'label' => 'Resume uploaded']] as $item)
                        <div
                            class="flex items-center gap-2.5 py-2 border-b border-border text-base last:border-b-0 last:pb-0">
                            <div
                                class="w-4 h-4 rounded-full flex items-center justify-center shrink-0 {{ $item['done'] ? ' bg-success-bg text-success' : 'bg-surface-3 text-ink-4' }}">
                                @if ($item['done'])
                                    <x-heroicon-m-check class="w-2.5 h-2.5" />
                                @else
                                    <x-heroicon-m-minus class="w-2.5 h-2.5" />
                                @endif
                            </div>
                            <span class="text-xs md:text-sm {{ $item['done'] ? 'text-ink-2' : 'text-ink-4' }}">
                                {{ $item['label'] }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Job preferences --}}
            <div class="bg-surface border border-border rounded-xl p-4 md:p-5">
                <h4 class="text-2xs text-ink-4 uppercase tracking-wider font-medium mb-4">Job preferences</h4>
                <div class="space-y-4">
                    <div>
                        <div class="text-2xs text-ink-4 uppercase tracking-wider font-medium mb-1">Role type</div>
                        <div class="flex flex-wrap gap-1">
                            <x-ui.badge type="info">
                                Full Time
                            </x-ui.badge>
                            <x-ui.badge type="info">
                                Contract
                            </x-ui.badge>
                            <x-ui.badge>
                                Part Time
                            </x-ui.badge>
                        </div>
                    </div>
                    <div>
                        <div class="text-2xs text-ink-4 uppercase tracking-wider font-medium mb-1">Work style</div>
                        <x-ui.badge type="remote">Remote preferred</x-ui.badge>
                    </div>
                    <div>
                        <div class="text-2xs text-ink-4 uppercase tracking-wider font-medium mb-1">Salary target</div>
                        <div class="text-sm text-ink-2">$130k – $180k / year</div>
                    </div>
                    <div>
                        <div class="text-2xs text-ink-4 uppercase tracking-wider font-medium mb-1">Open to roles in
                        </div>
                        <div class="flex flex-wrap gap-1">
                            <x-ui.badge type="primary">Design</x-ui.badge>
                            <x-ui.badge type="primary">Product</x-ui.badge>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick links --}}
            <div class="bg-surface border border-border rounded-xl p-4 md:p-5">
                <h4 class="font-medium text-md md:text-base mb-3">Quick links</h4>
                <div class="flex flex-col gap-1">
                    <x-shared.nav-item href="{{ route('seeker.applications') }}" icon="document-text">
                        My Applications
                    </x-shared.nav-item>
                    <x-shared.nav-item href="{{ route('seeker.saved') }}" icon="bookmark">
                        Saved Jobs
                    </x-shared.nav-item>
                    <x-shared.nav-item href="{{ route('jobs.index') }}" icon="magnifying-glass">
                        Browse Jobs
                    </x-shared.nav-item>
                </div>
            </div>
        </div>
    </div>
</x-layouts.seeker>
