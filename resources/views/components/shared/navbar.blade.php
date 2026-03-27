@props(['context' => null])

<div class="navbar sticky top-0 z-50 left-0 right-0 h-15 bg-surface border-b border-border shadow-sm px-4 lg:px-8 "
    x-data="{ mobileOpen: false }">

    <div class="navbar-start gap-3">
        <a href="/" class="flex items-center gap-2.5 no-underline font-serif text-xl text-base-content">
            <div class="w-7 h-7 bg-base-content rounded-md flex items-center justify-center shrink-0">
                <x-heroicon-s-briefcase class="w-4 h-4 text-base-100" />
            </div>
            <span class="block">Incepto</span>
        </a>

        @isset($context)
            <div class="hidden md:flex items-center gap-3">
                <div class="w-px h-5 bg-base-300"></div>
                <span class="text-sm text-base-content/40">{{ $context }}</span>
            </div>
        @endisset


        <ul class="menu menu-horizontal hidden lg:flex px-1 gap-0.5">
            <li>
                <a href="" class="{{ request()->routeIs('jobs.*') ? 'active' : '' }}">
                    Home
                </a>
            </li>
            <li>
                <a href="" class="{{ request()->routeIs('jobs.*') ? 'active' : '' }}">
                    Jobs
                </a>
            </li>
            <li>
                <a href="" class="{{ request()->routeIs('companies.*') ? 'active' : '' }}">
                    Companies
                </a>
            </li>
        </ul>
    </div>


    {{--  END --}}
    <div class="navbar-end">
        @guest
            <div class="hidden sm:flex sm:items-center sm:gap-1">
                <a href="/login" class="btn btn-ghost btn-sm">
                    Sign In
                </a>
                <a href="/register" class="btn btn-neutral btn-sm">
                    Get started
                </a>
            </div>
        @endguest

        {{-- Mobile hamburger --}}
        <button @click="mobileOpen = !mobileOpen" class="btn btn-ghost btn-sm btn-square sm:hidden">
            <x-heroicon-o-bars-3 x-show="!mobileOpen" class="w-5 h-5" />
            <x-heroicon-o-x-mark x-show="mobileOpen" class="w-5 h-5" x-cloak />
        </button>
    </div>

    {{-- MOBILE MENU  --}}
    <div x-show="mobileOpen" x-transition
        class="lg:hidden absolute top-full left-0 right-0 bg-base-100/90 backdrop-blur-md border-b border-base-300 p-4 flex flex-col gap-1"
        x-cloak>

        <ul class="menu menu-sm w-full">
            <li>
                <a href="/" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                    Home
                </a>
            </li>
            <li>
                <a href="/jobs" class="{{ request()->routeIs('jobs.*') ? 'active' : '' }}">
                    Jobs
                </a>
            </li>
            <li>
                <a href="/companies" class="{{ request()->routeIs('companies.*') ? 'active' : '' }}">
                    Companies
                </a>
            </li>
        </ul>

        @guest
            <div class="flex gap-2 pt-3 mt-1 border-t border-base-300">
                <a href="/login" class="btn btn-outline btn-sm flex-1 justify-center">
                    Sign In
                </a>
                <a href="/register" class="btn btn-neutral btn-sm flex-1 justify-center">
                    Get started
                </a>
            </div>
        @endguest
    </div>
</div>
