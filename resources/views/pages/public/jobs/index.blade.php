<x-layouts.public title="Browse Jobs">
    <div class="container mx-auto px-4 py-8">
        <div class="drawer lg:drawer-open">
            <input id="filter-drawer" type="checkbox" class="drawer-toggle" />

            <div class="drawer-content flex flex-col min-w-0 lg:pl-6">
                <div class="flex items-center justify-between gap-4 mb-6 flex-wrap">
                    <div>
                        <h1 class="font-medium font-display text-3xl mb-1">
                            @if (request('q'))
                                Results for "{{ request('q') }}"
                            @else
                                Browse Jobs
                            @endif
                        </h1>
                        <p class="text-base text-base-content/50">
                            Showing <span class="text-ink-2">{{ number_format($totalCount) }}</span>
                            {{ Str::plural('jobs', $totalCount) }} found
                            @if (count($filters) > 0)
                                ·
                                <a href="{{ route('jobs.index') }}" class="text-primary hover:underline">
                                    Clear filters
                                </a>
                            @endif
                        </p>
                    </div>

                    <div class="flex items-center gap-3">
                        <label for="filter-drawer"
                            class="btn btn-outline btn-sm rounded-lg gap-2 lg:hidden drawer-button">
                            <x-heroicon-m-adjustments-horizontal class="w-3.5 h-3.5" />
                            Filters
                            @if (count($filters) > 0)
                                <span class="badge badge-primary badge-sm">{{ count($filters) }}</span>
                            @endif
                        </label>

                        <form action="{{ route('jobs.index') }}" method="GET">
                            @foreach (request()->except('sort') as $key => $val)
                                @if (is_array($val))
                                    @foreach ($val as $v)
                                        <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                                    @endforeach
                                @else
                                    <input type="hidden" name="{{ $key }}" value="{{ $val }}">
                                @endif
                            @endforeach
                            <select name="sort" onchange="this.form.submit()"
                                class="select select-sm rounded-lg border-base-300 bg-base-100 text-sm font-normal focus:outline-none">
                                @foreach (['newest' => 'Newest first', 'oldest' => 'Oldest first', 'salary_desc' => 'Highest salary', 'salary_asc' => 'Lowest salary', 'popular' => 'Most popular'] as $val => $label)
                                    <option value="{{ $val }}" @selected(request('sort', 'newest') === $val)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>

                @if (count($filters) > 0)
                    <div class="flex flex-wrap gap-2 mb-5">
                        @foreach ($filters as $key => $value)
                            @if ($key === 'sort')
                                @continue
                            @endif
                            @foreach ((array) $value as $v)
                                <div
                                    class="badge badge-outline gap-1.5 rounded-full px-3 py-3 text-xs font-medium text-primary border-primary/30 bg-primary/5">
                                    <span>{{ $v }}</span>
                                    <a href="{{ route('jobs.index', array_merge(request()->except($key), [])) }}"
                                        class="opacity-60 hover:opacity-100 transition-opacity">
                                        <x-heroicon-m-x-mark class="w-3 h-3" />
                                    </a>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                @endif

                @if ($jobs->isEmpty())
                    <div class="flex flex-col items-center justify-center py-24 text-center">
                        <div
                            class="w-16 h-16 rounded-2xl flex items-center justify-center mb-4 bg-base-200 border border-base-300">
                            <x-heroicon-o-magnifying-glass class="w-8 h-8 text-base-content/30" />
                        </div>
                        <h3 class="font-bold text-2xl mb-2">No jobs found</h3>
                        <p class="text-base text-base-content/50 max-w-sm">
                            Try adjusting your filters or searching with different keywords.
                        </p>
                        <a href="{{ route('jobs.index') }}" class="btn btn-neutral btn-sm rounded-lg mt-6">
                            Clear all filters
                        </a>
                    </div>
                @else
                    <div class="flex flex-col gap-3">
                        @foreach ($jobs as $job)
                            <x-shared.job-card :job="$job" :first="$loop->first" />
                        @endforeach
                    </div>

                    {{ $jobs->links() }}
                @endif

            </div>

            <div
                class="drawer-side z-40 lg:z-10 lg:top-25 overflow-y-auto [&::-webkit-scrollbar]:hidden [scrollbar-width:none]">
                <label for="filter-drawer" aria-label="close sidebar" class="drawer-overlay min-h-full"></label>

                <form action="{{ route('jobs.index') }}" method="GET" id="filterForm"
                    class="w-64 min-h-full bg-base-100 border-r border-base-200 flex flex-col lg:rounded-xl lg:border lg:mr-2">
                    <div
                        class="flex items-center justify-between px-4 py-4 border-b border-base-200 sticky top-0 bg-base-100 z-10 rounded-t-xl">
                        <p class="text-sm font-semibold text-base-content">Filters</p>
                        @if (count($filters) > 0)
                            <a href="{{ route('jobs.index') }}"
                                class="text-xs text-primary font-medium hover:underline">
                                Clear all
                            </a>
                        @endif
                    </div>

                    <div
                        class="flex flex-col overflow-y-auto flex-1 scrollbar-hide [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">

                        <div class="px-4 pt-4 pb-2">
                            <x-ui.input type="text" name="q" label="Keyword" icon="magnifying-glass"
                                placeholder="Job title, skill..." :value="request('q')" form="filterForm" />
                        </div>

                        <div class="px-4 pb-4">
                            <x-ui.input type="text" name="location" label="Location" icon="map-pin"
                                placeholder="City or country..." :value="request('location')" form="filterForm" />
                        </div>

                        <div class="divider my-0"></div>

                        <div class="px-4 py-4">
                            <p class="text-xs font-semibold text-base-content/40 uppercase tracking-wide mb-3">Job type
                            </p>
                            <div class="flex flex-col gap-2.5">
                                @foreach ($types as $type)
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="checkbox" name="type[]" value="{{ $type }}"
                                            form="filterForm" onchange="document.getElementById('filterForm').submit()"
                                            @checked(in_array($type, (array) request('type', [])))
                                            class="checkbox checkbox-xs checkbox-neutral rounded" />
                                        <span class="text-sm text-base-content">{{ $type }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="divider my-0"></div>

                        <div class="px-4 py-4">
                            <p class="text-xs font-semibold text-base-content/40 uppercase tracking-wide mb-3">Work
                                style</p>
                            <div class="flex flex-col gap-2.5">
                                @foreach ($arrangements as $arrangement)
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="checkbox" name="arrangement[]" value="{{ $arrangement }}"
                                            form="filterForm" onchange="document.getElementById('filterForm').submit()"
                                            @checked(in_array($arrangement, (array) request('arrangement', [])))
                                            class="checkbox checkbox-xs checkbox-neutral rounded" />
                                        <span class="text-sm text-base-content">{{ $arrangement }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="divider my-0"></div>

                        <div class="px-4 py-4">
                            <p class="text-xs font-semibold text-base-content/40 uppercase tracking-wide mb-3">
                                Experience level</p>
                            <div class="flex flex-col gap-2.5">
                                @foreach ($levels as $level)
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="checkbox" name="level[]" value="{{ $level }}"
                                            form="filterForm"
                                            onchange="document.getElementById('filterForm').submit()"
                                            @checked(in_array($level, (array) request('level', [])))
                                            class="checkbox checkbox-xs checkbox-neutral rounded" />
                                        <span class="text-sm text-base-content">{{ $level }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="divider my-0"></div>

                        <div class="px-4 py-4">
                            <p class="text-xs font-semibold text-base-content/40 uppercase tracking-wide mb-3">Skills
                            </p>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($skills as $skill)
                                    @php $isActive = in_array($skill, (array) request('skills', [])); @endphp
                                    <label class="cursor-pointer">
                                        <input type="checkbox" name="skills[]" value="{{ $skill }}"
                                            form="filterForm"
                                            onchange="document.getElementById('filterForm').submit()"
                                            @checked($isActive) class="sr-only peer" />
                                        <span
                                            class="badge badge-md rounded-full border transition-all duration-150
                                            {{ $isActive
                                                ? 'badge-neutral border-transparent'
                                                : 'bg-base-100 border-base-300 text-base-content/60 hover:border-base-content/30 hover:text-base-content' }}">
                                            {{ $skill }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="divider my-0"></div>

                        <div class="px-4 py-4">
                            <p class="text-xs font-semibold text-base-content/40 uppercase tracking-wide mb-3">Salary
                                range</p>
                            <div class="grid grid-cols-2 gap-2">
                                <x-ui.input type="number" name="salary_min" placeholder="Min" :value="request('salary_min')"
                                    form="filterForm" />
                                <x-ui.input type="number" name="salary_max" placeholder="Max" :value="request('salary_max')"
                                    form="filterForm" />
                            </div>
                        </div>

                    </div>

                    <div class="p-4 border-t border-base-200 sticky bottom-0 bg-base-100 rounded-b-xl">
                        <button type="submit" form="filterForm" class="btn btn-neutral btn-sm w-full rounded-lg">
                            Apply filters
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</x-layouts.public>
