<x-layouts.public>
    <x-slot:context>Seeker Dashboard</x-slot:context>

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
            <ul class="menu bg-surface h-full w-65 p-4 border-r border-border">
                <p class="px-4 py-2 text-xs font-bold text-base-content/40 uppercase">Menu</p>
                <li><a>Sidebar Item 1</a></li>
                <li><a>Sidebar Item 2</a></li>
            </ul>
        </div>
    </div>
</x-layouts.public>
