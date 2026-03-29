@props(['context' => null])

<header
    class="navbar sticky top-0 left-0 right-0 z-50 h-16 border-b border-base-200 bg-base-100/80 backdrop-blur px-4 lg:px-8 shadow"
    x-data="{ mobileOpen: false }">

    {{-- ── Start ──────────────────────────────────────────────────────────── --}}
    <div class="navbar-start gap-3">

        <a href="{{ route('home') }}" class="flex items-center gap-2.5 font-medium font-display text-lg tracking-tight">
            <div class="w-7 h-7 bg-neutral rounded-md flex items-center justify-center">
                <x-heroicon-s-briefcase class="w-4 h-4 text-white" />
            </div>
            <span class="hidden sm:block">Incepto</span>
        </a>

        @isset($context)
            <div class="hidden md:flex items-center gap-3">
                <div class="w-px h-5 bg-base-300"></div>
                <span class="text-sm text-base-content/40">{{ $context }}</span>
            </div>
        @endisset

        <div class="hidden md:flex flex-1 max-w-xs ml-1">
            <form action="{{ route('jobs.index') }}" method="GET" class="w-full">
                <x-ui.input type="text" name="q" icon="magnifying-glass" placeholder="Search jobs...."
                    :value="request('q')" />
            </form>
        </div>

        <ul class="menu menu-horizontal menu-sm gap-0.5 p-0 hidden md:flex">
            <li>
                <a href="{{ route('home') }}"
                    class="rounded-lg text-sm font-medium {{ request()->routeIs('home') ? 'bg-base-200 text-base-content' : 'text-base-content/60 hover:bg-base-200 hover:text-base-content' }}">
                    Home
                </a>
            </li>
            <li>
                <a href="{{ route('jobs.index') }}"
                    class="rounded-lg text-sm font-medium {{ request()->routeIs('jobs.*') ? 'bg-base-200 text-base-content' : 'text-base-content/60 hover:bg-base-200 hover:text-base-content' }}">
                    Jobs
                </a>
            </li>
            <li>
                <a href="{{ route('companies.index') }}"
                    class="rounded-lg text-sm font-medium {{ request()->routeIs('companies.*') ? 'bg-base-200 text-base-content' : 'text-base-content/60 hover:bg-base-200 hover:text-base-content' }}">
                    Companies
                </a>
            </li>
        </ul>
    </div>

    <div class="navbar-end gap-2">
        @guest
            <a href="{{ route('login') }}" class="btn btn-ghost btn-sm rounded-lg hidden sm:inline-flex">
                Sign In
            </a>
            <a href="{{ route('register') }}" class="btn btn-neutral btn-sm rounded-lg">
                Get started
            </a>
        @endguest

        @auth
            <div class="indicator">
                <span
                    class="indicator-item indicator-top indicator-end badge badge-primary badge-xs animate-pulse w-2 h-2 min-h-0 p-0 border-2 border-base-100"></span>
                <button class="btn btn-ghost btn-sm btn-square rounded-lg">
                    <x-heroicon-o-bell class="w-4 h-4" />
                </button>
            </div>

            {{-- Employer: Post a Job CTA --}}
            @if (auth()->user()->role->value === 'company')
                <a href="{{ route('employer.jobs.create') }}"
                    class="btn btn-neutral btn-sm rounded-lg hidden md:inline-flex gap-1.5">
                    <x-heroicon-m-plus class="w-3.5 h-3.5" />
                    Post a Job
                </a>
            @endif

            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button"
                    class="btn btn-ghost btn-sm rounded-full pl-1 pr-3 py-1 h-auto border border-base-200 gap-2">
                    <div class="avatar placeholder">
                        <div class="w-7 rounded-full bg-neutral text-neutral-content">
                            <span class="text-xs font-medium">
                                {{ strtoupper(substr(auth()->user()->first_name, 0, 2)) }}
                            </span>
                        </div>
                    </div>
                    <span class="hidden sm:block font-medium text-sm">
                        {{ explode(' ', auth()->user()->first_name)[0] }}
                    </span>
                    <x-heroicon-m-chevron-down class="w-3.5 h-3.5 text-base-content/40" />
                </div>

                <ul tabindex="0"
                    class="dropdown-content menu bg-base-100 border border-base-200 shadow-lg rounded-xl w-52 mt-2 p-0 overflow-hidden z-50">

                    {{-- User info header --}}
                    <li class="menu-title px-4 py-3 border-b border-base-200 block">
                        <p class="text-sm font-medium text-base-content truncate normal-case">
                            {{ auth()->user()->first_name }}
                        </p>
                        <p class="text-xs text-base-content/40 truncate font-normal">
                            {{ auth()->user()->email }}
                        </p>
                    </li>

                    <div class="p-1">
                        @if (auth()->user()->role->value === 'company')
                            <li><a href="{{ route('employer.dashboard') }}" class="rounded-lg text-sm">Dashboard</a></li>
                            <li><a href="{{ route('employer.applicants') }}" class="rounded-lg text-sm">Applicants</a></li>
                            <li><a href="{{ route('employer.teams') }}" class="rounded-lg text-sm">Manage Teams</a></li>
                        @else
                            <li><a href="{{ route('seeker.applications') }}" class="rounded-lg text-sm">Dashboard</a></li>
                            <li><a href="{{ route('seeker.saved') }}" class="rounded-lg text-sm">Saved Jobs</a></li>
                            <li><a href="{{ route('seeker.profile') }}" class="rounded-lg text-sm">Profile</a></li>
                        @endif
                    </div>

                    <div class="border-t border-base-200 p-1">
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="rounded-lg text-sm text-error w-full text-left">
                                    Sign out
                                </button>
                            </form>
                        </li>
                    </div>

                </ul>
            </div>
        @endauth

        <button @click="mobileOpen = !mobileOpen" class="btn btn-ghost btn-sm btn-square rounded-lg lg:hidden">
            <x-heroicon-o-bars-3 x-show="!mobileOpen" class="w-4 h-4" />
            <x-heroicon-o-x-mark x-show="mobileOpen" class="w-4 h-4" x-cloak />
        </button>
    </div>

    <div x-show="mobileOpen" x-transition x-cloak
        class="lg:hidden absolute top-full left-0 right-0 bg-base-100/95 backdrop-blur border-b border-base-200 flex flex-col gap-1 p-4">

        <form action="{{ route('jobs.index') }}" method="GET" class="mb-3">
            <x-ui.input type="text" name="q" icon="magnifying-glass" placeholder="Search jobs, companies..."
                :value="request('q')" />
        </form>

        <ul class="menu menu-sm p-0 gap-0.5">
            <li>
                <a href="{{ route('home') }}"
                    class="rounded-lg {{ request()->routeIs('home') ? 'bg-base-200 font-medium' : '' }}">
                    Home
                </a>
            </li>
            <li>
                <a href="{{ route('jobs.index') }}"
                    class="rounded-lg {{ request()->routeIs('jobs.*') ? 'bg-base-200 font-medium' : '' }}">
                    Jobs
                </a>
            </li>
            <li>
                <a href="{{ route('companies.index') }}"
                    class="rounded-lg {{ request()->routeIs('companies.*') ? 'bg-base-200 font-medium' : '' }}">
                    Companies
                </a>
            </li>
        </ul>

        @guest
            <div class="grid grid-cols-2 gap-2 pt-3 mt-1 border-t border-base-200">
                <a href="{{ route('login') }}" class="btn btn-outline btn-sm rounded-lg">Sign In</a>
                <a href="{{ route('register') }}" class="btn btn-neutral btn-sm rounded-lg">Get started</a>
            </div>
        @endguest
    </div>

</header>
