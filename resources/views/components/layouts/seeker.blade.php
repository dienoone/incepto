<x-layouts.public>
    <x-slot:context>Seeker Dashboard</x-slot:context>

    <div class="drawer lg:drawer-open h-[calc(100vh-4rem)] overflow-hidden">
        <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />

        <div class="drawer-content p-6 bg-surface-3 overflow-y-auto h-full">
            <label for="my-drawer-3" class="btn drawer-button lg:hidden">
                Open drawer
            </label>

            {{ $slot }}
        </div>

        <div class="drawer-side h-full">
            <label for="my-drawer-3" aria-label="close sidebar" class="drawer-overlay"></label>
            <div class="bg-surface h-full w-65 p-4 border-r border-border flex flex-col justify-between">

                <div class="p-3 border-b border-border">
                    <div class="rounded-xl p-3.5 text-center bg-surface-2">
                        <div class="avatar mx-auto mb-2.5">
                            <div class="w-20 rounded-xl">
                                <img src="{{ asset('storage/' . auth()->user()->seeker->avatar) }}" />
                            </div>
                        </div>
                        <p class="font-medium mb-0.5 text-sm text-ink">
                            {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                        </p>
                        <p class="mb-3 text-xs text-ink-3">
                            Job Seeker
                        </p>
                        @php $pct = auth()->user()->profile?->completeness ?? 78; @endphp
                        <div>
                            <div class="flex justify-between mb-1 text-xs text-ink-4">
                                <span>Profile strength</span>
                                <span class="font-medium text-primary">{{ $pct }}%</span>
                            </div>
                            <div class="rounded-full h-1 bg-surface-3 overflow-hidden">
                                <div class="h-full rounded-full transition-all duration-300 bg-primary"
                                    style="width: {{ $pct }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <nav class="flex-1 p-3">
                    <p class="uppercase tracking-widest font-medium text-2xs text-ink-4 px-2 mt-4 mb-1">Overview</p>

                    <x-shared.nav-item href="{{ route('seeker.applications') }}" :badge="true" :active="request()->routeIs('seeker.applications')"
                        icon="document-text" badgeValue="{{ auth()->user()->seeker->applications()->count() }}">
                        My Applications
                    </x-shared.nav-item>


                    <x-shared.nav-item href="{{ route('seeker.saved') }}" :badge="true" :active="request()->routeIs('seeker.saved')"
                        icon="bookmark" badgeValue="{{ auth()->user()->seeker->bookmarks()->count() }}">
                        Saved Jobs
                    </x-shared.nav-item>

                    <x-shared.nav-item href="{{ route('jobs.index') }}" icon="magnifying-glass">
                        Browse Jobs
                    </x-shared.nav-item>

                    <p class="uppercase tracking-widest font-medium text-2xs text-ink-4 px-2 mt-4 mb-1">Account</p>

                    <x-shared.nav-item href="{{ route('seeker.profile') }}" icon="user" :active="request()->routeIs('seeker.profile')">
                        My Profile
                    </x-shared.nav-item>


                    <x-shared.nav-item href="{{ route('seeker.profile') }}" icon="chat-bubble-left-right"
                        :badge="true" badgeValue="3">
                        My Profile
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
