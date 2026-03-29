<x-layouts.public>
    <x-slot:context>Company Dashboard</x-slot:context>

    <div class="drawer lg:drawer-open h-[calc(100vh-4rem)] overflow-hidden">
        <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />

        <div class="drawer-content p-6 bg-surface-2 overflow-y-auto h-full">
            {{ $slot }}

            <label for="my-drawer-3" class="btn drawer-button lg:hidden">
                Open drawer
            </label>
        </div>

        <div class="drawer-side h-full">
            <label for="my-drawer-3" aria-label="close sidebar" class="drawer-overlay"></label>
            <div class="bg-surface h-full w-65 p-4 border-r border-border flex flex-col justify-between">
                <div class="p-3 border-b border-border">
                    <div class="flex items-center gap-3 rounded-xl p-3 bg-surface-2">
                        <div class="avatar avatar-placeholder">
                            <div class="{{ fake()->randomElement(['bg-slate-bg', 'bg-teal-bg']) }} w-12 rounded">
                                <span class="text-lg text-ink">
                                    {{ strtoupper(substr(auth()->user()->company->name, 0, 2)) }}
                                </span>
                            </div>
                        </div>
                        <div class="min-w-0">
                            <p class="font-medium truncate text-sm text-ink">
                                {{ auth()->user()->company->name }}
                            </p>
                            <p class="truncate text-xs text-ink-4">
                                {{ auth()->user()->first_name }}
                            </p>
                        </div>
                    </div>
                </div>

                <nav class="flex-1 p-3">
                    <p class="uppercase tracking-widest font-medium text-2xs text-ink-4 px-2 mb-3">Hiring</p>
                    <x-shared.nav-item href="{{ route('employer.dashboard') }}" :active="request()->routeIs('employer.dashboard')" icon="squares-2x2">
                        Dashboard
                    </x-shared.nav-item>

                    <x-shared.nav-item href="{{ route('employer.applicants') }}" :active="request()->routeIs('employer.applicants*')" icon="users"
                        :badge="true"
                        badgeValue="{{ \App\Models\Application::whereHas('job', fn($q) => $q->where('company_id', auth()->id()))->count() }}">
                        Applicants
                    </x-shared.nav-item>

                    <x-shared.nav-item href="{{ route('employer.jobs.create') }}" :active="request()->routeIs('employer.jobs.create')" icon="plus-circle">
                        Post a Job
                    </x-shared.nav-item>

                    <x-shared.nav-item href="{{ route('jobs.index') }}" :badge="true"
                        badgeValue="{{ auth()->user()->company->jobs()->count() }}" icon="briefcase">
                        My Jobs
                    </x-shared.nav-item>

                    <p class="uppercase tracking-widest font-medium text-2xs text-ink-4 px-2 mt-4 mb-1">Company</p>

                    <x-shared.nav-item href="{{ route('companies.show', auth()->user()->company) }}"
                        icon="building-office-2">
                        Company Profile
                    </x-shared.nav-item>

                    <x-shared.nav-item href="{{ route('employer.teams') }}" icon="user-group" :active="request()->routeIs('employer.teams')"
                        :badge="true" badgeValue="{{ auth()->user()->company->teams()->count() }}">
                        Manage Teams
                    </x-shared.nav-item>
                </nav>

                <div class="p-3 border-t border-border">
                    <x-shared.nav-item href="#" icon="cog-6-tooth">
                        Settings
                    </x-shared.nav-item>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <x-shared.nav-item class="w-full text-left text-danger" icon="arrow-right-on-rectangle">
                            Sign out
                        </x-shared.nav-item>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.public>
