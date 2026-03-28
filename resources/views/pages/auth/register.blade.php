<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Account — Incepto</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-base-200 text-base-content min-h-screen">

    <div class="min-h-screen grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">

        <div
            class="hidden md:flex lg:col-span-2 relative overflow-hidden bg-neutral text-neutral-content p-10 lg:p-14 flex-col justify-between">

            <div
                class="absolute inset-0 opacity-[0.04] pointer-events-none bg-[repeating-linear-gradient(0deg,white_0px,white_1px,transparent_1px,transparent_40px),repeating-linear-gradient(90deg,white_0px,white_1px,transparent_1px,transparent_40px)]">
            </div>

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 relative z-10">
                <div class="w-9 h-9 rounded-lg flex items-center justify-center bg-white/10 border border-white/20">
                    <x-heroicon-s-briefcase class="w-5 h-5 text-white" />
                </div>
                <span class="font-medium font-display text-white text-xl tracking-tight">Incepto</span>
            </a>

            {{-- Headline --}}
            <div class="relative z-10 max-w-lg">
                <h2 class="text-4xl lg:text-5xl font-bold leading-tight mb-4 text-white font-display">
                    The right talent.<br>The right role.
                </h2>
                <p class="text-white/60 text-base leading-relaxed">
                    Whether you're hiring or looking, Incepto connects you with what matters.
                </p>
            </div>

            {{-- Stats grid --}}
            <div class="relative z-10 grid grid-cols-2 gap-4">
                @foreach ([
        '12,000+ Jobs' => 'Updated daily',
        '5,000+ Companies' => 'Across all industries',
        '250k+ Seekers' => 'Active this month',
        '98% Match rate' => 'Powered by AI',
    ] as $stat => $sub)
                    <div class="rounded-xl p-4 bg-white/[0.07] border border-white/10">
                        <div class="font-semibold text-white mb-0.5 text-lg">{{ $stat }}</div>
                        <div class="text-sm text-white/40">{{ $sub }}</div>
                    </div>
                @endforeach
            </div>

            {{-- Social proof --}}
            <div class="relative z-10 flex items-center gap-4">
                <div class="flex -space-x-2">
                    @foreach (['JD', 'MR', 'ST', 'LP'] as $initials)
                        <div class="avatar placeholder text-center">
                            <div class="w-8 rounded-full bg-white/20 border-2 border-neutral">
                                <span class="text-xs text-white font-medium">{{ $initials }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <p class="text-sm text-white/60">
                    <span class="text-white font-semibold">2,400+ professionals</span> joined this month
                </p>
            </div>
        </div>

        {{-- ─── Right panel ─────────────────────────────────────────────────── --}}
        <div class="flex flex-col min-h-screen bg-base-100">

            {{-- Navbar --}}
            <div class="navbar border-b border-border bg-base-100/70 backdrop-blur px-4 lg:px-8 min-h-16 shadow-sm">
                <div class="flex-1">
                    <a href="#" class="flex items-center gap-2.5 font-medium font-display text-lg tracking-tight">
                        <div class="w-7 h-7 bg-neutral rounded-md flex items-center justify-center">
                            <x-heroicon-s-briefcase class="w-4 h-4 text-white" />
                        </div>
                        <span class="hidden sm:block">Incepto</span>
                    </a>
                </div>
                <div class="flex-none">
                    <p class="text-sm text-base-content/50">
                        Have an account?
                        <a href="{{ route('login') }}" class="text-primary font-medium hover:underline">
                            Sign in
                        </a>
                    </p>
                </div>
            </div>

            {{-- Form container --}}
            <div class="flex flex-1 items-center justify-center px-6 py-10 lg:px-12">
                <div class="w-full max-w-sm">

                    {{-- Header --}}
                    <div class="mb-8">
                        <p class="uppercase tracking-widest text-ink-4 font-light text-xs mb-3">Get started free</p>
                        <h1 class="text-3xl font-display font-semibold mb-3">Create account</h1>
                        <p class="text-base text-base-content/60">
                            Already have an account?
                            <a href="{{ route('login') }}" class="text-primary font-medium hover:underline">
                                Sign in
                            </a>
                        </p>
                    </div>


                    {{-- Validation errors --}}
                    @if ($errors->any())
                        <div role="alert" class="alert alert-error mb-6 text-sm">
                            <x-heroicon-o-exclamation-circle class="w-4 h-4 shrink-0" />
                            <span>Please fix the errors below to continue.</span>
                        </div>
                    @endif

                    <form action="{{ route('register') }}" method="POST" class="flex flex-col gap-4"
                        x-data="{ role: '{{ old('role', '') }}' }">
                        @csrf

                        <div class="grid grid-cols-2 gap-3">
                            <x-ui.radio-card name="role" value="{{ \App\Enums\RoleType::SEEKER->value }}"
                                label="Find a job" desc="I'm looking for job" :checked="old('role') === \App\Enums\RoleType::SEEKER->value"
                                @change="role = $event.target.value">
                                <x-heroicon-o-magnifying-glass class="w-5 h-5" />
                            </x-ui.radio-card>

                            <x-ui.radio-card name="role" value="{{ \App\Enums\RoleType::COMPANY->value }}"
                                label="Hire talent" desc="I'm hiring talent" :checked="old('role') === \App\Enums\RoleType::COMPANY->value"
                                @change="role = $event.target.value">
                                <x-heroicon-o-building-office-2 class="w-5 h-5" />
                            </x-ui.radio-card>
                        </div>
                        @error('role')
                            <div class="text-xs text-error flex items-center gap-1 mt-1">
                                <x-heroicon-o-exclamation-circle class="w-3.5 h-3.5 shrink-0" />
                                {{ $message }}
                            </div>
                        @enderror

                        <div class="grid grid-cols-2 gap-3">
                            <button class="btn btn-outline border-border-lg btn-sm rounded-lg gap-2 font-normal">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                                        fill="#4285F4" />
                                    <path
                                        d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                                        fill="#34A853" />
                                    <path
                                        d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                                        fill="#FBBC05" />
                                    <path
                                        d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                                        fill="#EA4335" />
                                </svg>
                                Google
                            </button>

                            <button class="btn btn-outline btn-sm border-border-lg rounded-lg gap-2 font-normal">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z" />
                                </svg>
                                GitHub
                            </button>
                        </div>

                        <div class="divider text-sm text-base-content/40 my-3">or register with email</div>


                        {{-- Company name (employer only) --}}
                        <div x-show="role === '{{ \App\Enums\RoleType::COMPANY->value }}'"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0" x-cloak>
                            <x-ui.input name="company_name" label="Company name" icon="building-office-2"
                                placeholder="Acme Corporation" :value="old('company_name')" :error="$errors->first('company_name')" />
                        </div>

                        {{-- Name row --}}
                        <div class="grid grid-cols-2 gap-3">
                            <x-ui.input name="first_name" label="First name" placeholder="Jane" :value="old('first_name')"
                                autocomplete="given-name" :error="$errors->first('first_name')" />
                            <x-ui.input name="last_name" label="Last name" placeholder="Doe" :value="old('last_name')"
                                autocomplete="family-name" :error="$errors->first('last_name')" />
                        </div>

                        <x-ui.input name="email" type="email" label="Email address" icon="envelope"
                            placeholder="you@example.com" :value="old('email')" autocomplete="email" :error="$errors->first('email')" />

                        <x-ui.input name="password" type="password" label="Password" icon="lock-closed"
                            placeholder="Min. 8 characters" :show-toggle="true" autocomplete="new-password"
                            :error="$errors->first('password')" />

                        <x-ui.input name="password_confirmation" type="password" label="Confirm password"
                            icon="lock-closed" placeholder="••••••••" :show-toggle="true"
                            autocomplete="new-password" />

                        {{-- Terms --}}
                        <div>
                            <label class="flex items-start gap-2 cursor-pointer">
                                <input type="checkbox" name="terms"
                                    class="checkbox checkbox-xs checkbox-neutral rounded mt-0.5" />
                                <span class="text-sm text-base-content/70">
                                    I agree to the Incepto's
                                    <a href="#" class="text-primary hover:underline">Terms of Service</a>
                                    and
                                    <a href="#" class="text-primary hover:underline">Privacy Policy</a>
                                </span>
                            </label>
                            @error('terms')
                                <div class="text-xs text-error flex items-center gap-1 mt-1">
                                    <x-heroicon-o-exclamation-circle class="w-3.5 h-3.5 shrink-0" />
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-neutral btn-sm w-full rounded-lg mt-1 gap-2">
                            Create account
                            <x-heroicon-s-arrow-right class="w-4 h-4" />
                        </button>

                    </form>

                </div>
            </div>
        </div>

    </div>
</body>

</html>
