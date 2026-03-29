<x-layouts.seeker title="Saved Jobs">
    <div class="mb-7">
        <p class="font-light uppercase text-ink-4 tracking-widest text-sm mb-2">Dashboard</p>
        <h1 class="font-display text-3xl font-semibold">Saved Jobs</h1>
        <p class="mt-2 text-base text-ink-3 font-light">
            {{ $bookmarks->total() }} {{ Str::plural('job', $bookmarks->total()) }} saved
        </p>
    </div>

    @if ($bookmarks->isEmpty())
        <div class="bg-surface border-border p-12 text-center">
            <x-heroicon-o-bookmark class="w-12 h-12 mx-auto mb-4 text-ink-4" />
            <h3 class="font-display mb-2 text-2xl">No saved jobs yet</h3>
            <p class="mb-6 text-ink-3">
                Bookmark jobs you're interested in and they'll appear here.
            </p>
            <a href="{{ route('jobs.index') }}" class="btn btn-primary btn-md">
                Browse jobs
                <x-heroicon-m-arrow-right class="w-3.5 h-3.5" />
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($bookmarks as $bookmark)
                <x-shared.job-card :job="$bookmark->job" :small="true" />
            @endforeach
        </div>

        {{-- Pagination --}}
        {{ $bookmarks->links() }}
    @endif
</x-layouts.seeker>
