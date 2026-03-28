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
                                Browse Companies
                            @endif
                        </h1>
                        <p class="text-base text-base-content/50">
                            Showing <span class="text-ink-2">{{ number_format($totalCount) }}</span>
                            {{ Str::plural('company', $totalCount) }} found
                            @if (count($filters) > 0)
                                ·
                                <a href="{{ route('companies.index') }}" class="text-primary hover:underline">
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

                        <form action="{{ route('companies.index') }}" method="GET">
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
                                @foreach (['jobs' => 'Most open jobs', 'followers' => 'Most followed', 'rating' => 'Highest rated', 'newest' => 'Newest'] as $val => $label)
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
                                    <a href="{{ route('companies.index', array_merge(request()->except($key), [])) }}"
                                        class="opacity-60 hover:opacity-100 transition-opacity">
                                        <x-heroicon-m-x-mark class="w-3 h-3" />
                                    </a>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                @endif

                @if ($companies->isEmpty())
                    <div class="flex flex-col items-center justify-center py-24 text-center">
                        <div
                            class="w-16 h-16 rounded-2xl flex items-center justify-center mb-4 bg-base-200 border border-base-300">
                            <x-heroicon-o-magnifying-glass class="w-8 h-8 text-base-content/30" />
                        </div>
                        <h3 class="font-bold text-2xl mb-2">No companies found</h3>
                        <p class="text-base text-base-content/50 max-w-sm">
                            Try adjusting your filters or searching with different keywords.
                        </p>
                        <a href="{{ route('companies.index') }}" class="btn btn-neutral btn-sm rounded-lg mt-6">
                            Clear all filters
                        </a>
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">
                        @foreach ($companies as $company)
                            <x-shared.company-card :company="$company" />
                        @endforeach
                    </div>

                    {{ $companies->links() }}
                @endif

            </div>

            <div
                class="drawer-side z-40 lg:z-10 lg:top-25 overflow-y-auto [&::-webkit-scrollbar]:hidden [scrollbar-width:none]">
                <label for="filter-drawer" aria-label="close sidebar" class="drawer-overlay min-h-full"></label>

                <form action="{{ route('companies.index') }}" method="GET" id="filerCompanies"
                    class="w-64 min-h-full bg-base-100 border-r border-base-200 flex flex-col lg:rounded-xl lg:border lg:mr-2">
                    <div
                        class="flex items-center justify-between px-4 py-4 border-b border-base-200 sticky top-0 bg-base-100 z-10 rounded-t-xl">
                        <p class="text-sm font-semibold text-base-content">Filters</p>
                        @if (count($filters) > 0)
                            <a href="{{ route('companies.index') }}"
                                class="text-xs text-primary font-medium hover:underline">
                                Clear all
                            </a>
                        @endif
                    </div>

                    <div
                        class="flex flex-col overflow-y-auto flex-1 scrollbar-hide [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">

                        <div class="px-4 pt-4 pb-2">
                            <x-ui.input type="text" name="location" label="Search" icon="magnifying-glass"
                                placeholder="Company name or industry" :value="request('location')" form="filerCompanies" />
                        </div>

                        <div class="divider my-0"></div>

                        <div class="px-4 py-4">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="hiring" value="{{ request('hiring') }}"
                                    form="filerCompanies" onchange="document.getElementById('filerCompanies').submit()"
                                    class="checkbox checkbox-xs checkbox-neutral rounded" />
                                <span class="text-sm text-base-content">Actively hiring</span>
                            </label>
                        </div>

                        <div class="divider my-0"></div>

                        <div class="px-4 py-4">
                            <p class="text-xs font-semibold text-base-content/40 uppercase tracking-wide mb-3">Industry
                            </p>
                            <div class="flex flex-col gap-2.5">
                                @foreach ($industries as $industry)
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input industry="checkbox" name="industry[]" value="{{ $industry }}"
                                            form="filerCompanies"
                                            onchange="document.getElementById('filerCompanies').submit()"
                                            @checked(in_array($industry, (array) request('industry', [])))
                                            class="checkbox checkbox-xs checkbox-neutral rounded" />
                                        <span class="text-sm text-base-content">{{ $industry }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="divider my-0"></div>

                        <div class="px-4 py-4">
                            <p class="text-xs font-semibold text-base-content/40 uppercase tracking-wide mb-3">Company
                                Size</p>
                            <div class="flex flex-col gap-2.5">
                                @foreach ($sizes as $size)
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="checkbox" name="size[]" value="{{ $size }}"
                                            form="filerCompanies"
                                            onchange="document.getElementById('filerCompanies').submit()"
                                            @checked(in_array($size, (array) request('size', [])))
                                            class="checkbox checkbox-xs checkbox-neutral rounded" />
                                        <span class="text-sm text-base-content">{{ $size }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="divider my-0"></div>
                    </div>

                    <div class="p-4 border-t border-base-200 sticky bottom-0 bg-base-100 rounded-b-xl">
                        <button type="submit" form="filerCompanies" class="btn btn-neutral btn-sm w-full rounded-lg">
                            Apply filters
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</x-layouts.public>
