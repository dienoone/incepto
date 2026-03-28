<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign In — Incepto</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-base-200 text-base-content min-h-screen">

    <div class="min-h-screen grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">

        <div
            class="hidden md:flex lg:col-span-2 relative overflow-hidden bg-neutral text-neutral-content p-10 lg:p-14 flex-col justify-between">

            <div
                class="absolute inset-0 opacity-[0.04] pointer-events-none bg-[repeating-linear-gradient(0deg,white_0px,white_1px,transparent_1px,transparent_40px),repeating-linear-gradient(90deg,white_0px,white_1px,transparent_1px,transparent_40px)]">
            </div>

            <a href="{{ route('home') }}" class="flex items-center gap-3 relative z-10">
                <div class="w-9 h-9 rounded-lg flex items-center justify-center bg-white/10 border border-white/20">
                    <x-heroicon-s-briefcase class="w-5 h-5 text-white" />
                </div>
                <span class="font-medium font-display text-white text-xl tracking-tight">Incepto</span>
            </a>

            <div class="relative z-10 max-w-lg">
                <h2 class="text-4xl lg:text-5xl font-bold leading-tight mb-4 text-white font-display">
                    Your next role<br>is one login away.
                </h2>
                <p class="text-white/60 text-base leading-relaxed">
                    Join thousands of professionals finding meaningful work at companies they love.
                </p>
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
                        No account?
                        <a href="{{ route('register') }}" class="text-primary font-medium hover:underline">
                            Create one
                        </a>
                    </p>
                </div>
            </div>

            {{-- Form container --}}
            <div class="flex flex-1 items-center justify-center px-6 py-10 lg:px-12">
                <div class="w-full max-w-sm">

                    {{-- Header --}}
                    <div class="mb-8">
                        <p class="uppercase tracking-widest text-ink-4 font-light text-xs mb-3">Welcome pack</p>
                        <h1 class="text-3xl font-display font-semibold mb-2">Sign in</h1>
                        <p class="text-base font-light text-base-content/60">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="text-primary font-medium hover:underline">
                                Create one free
                            </a>
                        </p>
                    </div>

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

                    <div class="divider text-xs text-base-content/40 my-5">or sign in with email</div>

                    @if (session('error'))
                        <div role="alert" class="alert alert-error mb-6 text-sm">
                            <x-heroicon-o-exclamation-circle class="w-4 h-4 shrink-0" />
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST" class="flex flex-col gap-4" novalidate>
                        @csrf

                        <x-ui.input name="email" type="email" label="Email address" icon="envelope"
                            placeholder="you@example.com" autocomplete="email" />

                        <x-ui.input name="password" type="password" label="Password" icon="lock-closed"
                            placeholder="••••••••" :show-toggle="true" autocomplete="current-password" />

                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember"
                                class="checkbox checkbox-sm w-4 h-4 rounded checkbox-neutral" />
                            <span class="text-sm">Keep me signed in for 30 days</span>
                        </label>


                        <button type="submit" class="btn btn-neutral btn-sm w-full rounded-lg mt-1 gap-2">
                            Sign in
                            <x-heroicon-s-arrow-right class="w-4 h-4" />
                        </button>

                        <p class="text-sm text-ink-4 text-center">
                            By signing in you agree to our
                            <span class="text-ink-2">Terms</span>
                            and
                            <span class="text-ink-2">Privacy</span>
                            Policy
                        </p>
                    </form>
                </div>
            </div>
        </div>

    </div>
</body>

</html>
