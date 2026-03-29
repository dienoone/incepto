<x-layouts.employer title="Post a Job" heading="Post a Job"
    subtext="Fill in the details below to create a new job listing.">

    <div class="mb-7">
        <p class="font-light uppercase text-ink-4 tracking-widest text-sm mb-2">Hiring</p>
        <h1 class="font-display text-3xl font-semibold">Post a Job</h1>
        <p class="mt-2 text-base text-ink-3 font-light">
            Fill in the details below to create a new job listing.
        </p>
    </div>

    {{-- Main Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-[1fr_380px] gap-8 items-start" x-data="{
        title: '{{ old('title', '') }}',
        type: '{{ old('type', 'Full-time') }}',
        arrangement: '{{ old('arrangement', 'Remote') }}',
        salary_min: '{{ old('salary_min', '') }}',
        salary_max: '{{ old('salary_max', '') }}'
    }">

        {{-- Left Column: The Form --}}
        <form id="jobForm" action="{{ route('employer.jobs.store') }}" method="POST" class="flex flex-col gap-6">
            @csrf

            {{-- Step 1: Basic info --}}
            <div class="rounded-xl bg-surface border border-border overflow-hidden">
                <div class="flex items-center gap-3 px-5 py-4 border-b border-border">
                    <div
                        class="w-6 h-6 rounded-full flex items-center justify-center bg-ink text-white font-bold text-2xs shrink-0">
                        1
                    </div>
                    <span class="font-medium text-md text-ink">Basic information</span>
                </div>
                <div class="p-5 lg:p-6 flex flex-col gap-4">
                    <x-ui.input name="title" label="Job title" placeholder="e.g. Senior Product Designer"
                        x-model="title" value="{{ old('title') }}" :error="$errors->first('title')" />

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-ui.select name="type" label="Job type" :options="$types" x-model="type" :value="old('type')"
                            :error="$errors->first('type')" />
                        <x-ui.select name="arrangement" label="Work style" :options="$arrangements" x-model="arrangement"
                            :value="old('arrangement')" :error="$errors->first('arrangement')" />
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-ui.select name="level" label="Experience level" :options="$levels" :value="old('level')"
                            :error="$errors->first('level')" />
                        <x-ui.input name="address" label="Location" placeholder="e.g. New York, NY"
                            value="{{ old('address') }}" :error="$errors->first('address')" />
                    </div>

                    <x-ui.input name="expires_at" label="Application deadline" type="date"
                        value="{{ old('expires_at', now()->addMonths(2)->format('Y-m-d')) }}" :error="$errors->first('expires_at')" />
                </div>
            </div>

            {{-- Step 2: Compensation --}}
            <div class="rounded-xl bg-base-100 border border-base-300 overflow-hidden shadow-sm">
                <div class="flex items-center gap-3 px-5 py-4 border-b border-base-300">
                    <div
                        class="w-6 h-6 rounded-full flex items-center justify-center bg-base-content text-base-100 font-bold text-xs shrink-0">
                        2
                    </div>
                    <span class="font-medium text-md text-base-content">Compensation</span>
                </div>
                <div class="p-5 lg:p-6 flex flex-col gap-4">
                    <div class="grid grid-cols-[1fr_auto_1fr] gap-3 items-end">
                        {{-- Kept Custom Inputs --}}
                        <x-ui.input name="salary_min" label="Min salary ($)" type="number" x-model="salary_min"
                            value="{{ old('salary_min') }}" :error="$errors->first('salary_min')" />
                        <div class="pb-3 text-center text-base-content/50">—</div>
                        <x-ui.input name="salary_max" label="Max salary ($)" type="number" x-model="salary_max"
                            value="{{ old('salary_max') }}" :error="$errors->first('salary_max')" />
                    </div>
                </div>
            </div>

            {{-- Step 3: Description & Skills --}}
            <div class="rounded-xl bg-base-100 border border-base-300 overflow-hidden shadow-sm">
                <div class="flex items-center gap-3 px-5 py-4 border-b border-base-300">
                    <div
                        class="w-6 h-6 rounded-full flex items-center justify-center bg-base-content text-base-100 font-bold text-xs shrink-0">
                        3
                    </div>
                    <span class="font-medium text-md text-base-content">Description & Skills</span>
                </div>
                <div class="p-5 lg:p-6">
                    <label class="form-control w-full">
                        <textarea name="description" rows="6" placeholder="Describe the role..."
                            class="textarea textarea-bordered w-full text-base @error('description') textarea-error @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="label"><span class="label-text-alt text-error">{{ $message }}</span></div>
                        @enderror
                    </label>
                </div>
            </div>

            {{-- Final Actions --}}
            <div class="flex gap-3 justify-end pb-10">
                <button type="submit" name="status" value="Draft" class="btn btn-outline btn-ghost btn-md">
                    Save Draft
                </button>
                <button type="submit" class="btn btn-neutral btn-md">
                    Publish Job
                </button>
            </div>
        </form>

        {{-- Right Column: Sticky Preview --}}
        <aside class="hidden lg:block sticky top-24 space-y-5">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-sm font-bold uppercase tracking-widest text-base-content/60">Live Preview</h3>
                <x-ui.badge type="success" class="border-success">
                    LIVE
                </x-ui.badge>
            </div>

            <div class="rounded-2xl border-2 border-dashed border-base-300 p-2">
                <div class="rounded-xl bg-base-100 border border-base-200 p-5 shadow-sm">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="avatar avatar-placeholder">
                            <div class="{{ fake()->randomElement(['bg-slate-bg', 'bg-teal-bg']) }} w-12 rounded">
                                <span class="text-lg text-ink">
                                    {{ substr(auth()->user()->company->name ?? 'C', 0, 2) }}
                                </span>
                            </div>
                        </div>

                        <div>
                            <h4 class="font-display text-lg leading-tight font-semibold"
                                x-text="title || 'Your Job Title Here'"></h4>
                            <p class="text-sm text-base-content/70">
                                {{ auth()->user()->company->name ?? 'Your Company' }}
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-2 mb-4">
                        <x-ui.badge type="info">
                            <span x-text="type"></span>
                        </x-ui.badge>
                        <x-ui.badge type="success">
                            <span x-text="arrangement"></span>
                        </x-ui.badge>
                    </div>

                    <div class="pt-4 border-t border-base-200 flex items-center justify-between">
                        <div>
                            <p class="text-xs text-base-content/60 uppercase font-bold tracking-tight">Est. Salary</p>
                            <p class="text-sm font-semibold text-base-content">
                                <span x-show="salary_min">$<span
                                        x-text="Number(salary_min).toLocaleString()"></span></span>
                                <span x-show="salary_min && salary_max"> — </span>
                                <span x-show="salary_max">$<span
                                        x-text="Number(salary_max).toLocaleString()"></span></span>
                                <span x-show="!salary_min && !salary_max" class="text-base-content/50 italic">Not
                                    disclosed</span>
                            </p>
                        </div>
                        <button class="btn btn-sm btn-neutral" disabled>View</button>
                    </div>
                </div>
            </div>

            {{-- Tips Card --}}
            <div class="rounded-xl bg-primary/5 border border-primary/10 p-5">
                <div class="flex gap-3">
                    <x-heroicon-o-light-bulb class="w-5 h-5 text-primary shrink-0" />
                    <div>
                        <p class="text-sm font-bold text-primary mb-1">Quick Tip</p>
                        <p class="text-xs text-base-content/70 leading-relaxed">
                            Jobs with clear salary ranges and "Remote" work styles receive up to 3x more qualified
                            applicants.
                        </p>
                    </div>
                </div>
            </div>
        </aside>

    </div>
</x-layouts.employer>
