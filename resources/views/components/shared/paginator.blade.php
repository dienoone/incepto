@if ($paginator->hasPages())
    <nav class="flex flex-col sm:flex-row items-center justify-between gap-4 mt-8 pb-10" aria-label="Pagination">

        {{-- Left Side: Showing results text --}}
        <div class="text-sm text-ink-3">
            Showing
            <span class="font-bold text-ink">{{ $paginator->firstItem() }}</span>
            to
            <span class="font-bold text-ink">{{ $paginator->lastItem() }}</span>
            of
            <span class="font-bold text-ink">{{ $paginator->total() }}</span>
            results
        </div>

        {{-- Right Side: Buttons --}}
        <div class="flex items-center gap-1.5">
            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <span
                    class="w-9 h-9 flex items-center justify-center rounded-xl bg-surface border border-border text-ink-4 opacity-40 cursor-not-allowed select-none">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path d="M9 3L5 7l4 4" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="w-9 h-9 flex items-center justify-center rounded-xl bg-surface border border-border text-ink-4 transition-all duration-150 hover:border-border-lg hover:text-ink no-underline shadow-sm">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path d="M9 3L5 7l4 4" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </a>
            @endif

            {{-- Page numbers --}}
            @foreach ($elements as $element)
                {{-- Dots --}}
                @if (is_string($element))
                    <span class="px-1 text-sm text-ink-4 select-none">…</span>
                @endif

                {{-- Page links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span
                                class="w-9 h-9 flex items-center justify-center rounded-xl bg-ink border border-ink text-white text-xs font-bold shadow-md shadow-ink/10 select-none">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                                class="w-9 h-9 flex items-center justify-center rounded-xl bg-surface border border-border text-xs text-ink-3 font-medium transition-all duration-150 hover:border-border-lg hover:text-ink no-underline shadow-sm">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="w-9 h-9 flex items-center justify-center rounded-xl bg-surface border border-border text-ink-4 transition-all duration-150 hover:border-border-lg hover:text-ink no-underline shadow-sm">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path d="M5 3l4 4-4 4" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </a>
            @else
                <span
                    class="w-9 h-9 flex items-center justify-center rounded-xl bg-surface border border-border text-ink-4 opacity-40 cursor-not-allowed select-none">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path d="M5 3l4 4-4 4" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </span>
            @endif
        </div>
    </nav>
@endif
