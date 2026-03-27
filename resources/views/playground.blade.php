<x-layouts.public>
    <h1 class="text-center text-slate-400">Daisy UI</h1>
    <div class="p-8 rounded-full">
        <h2 class="text-center text-slate-400">Alert</h2>
        <div class="flex flex-col gap-4">
            <x-ui.alert :dismissible="true">
                <x-slot:title>This is a title</x-slot:title>
                <span>This is a body</span>
            </x-ui.alert>

            <x-ui.alert type="success">
                <span>Hello From alert</span>
            </x-ui.alert>

            <x-ui.alert type="warning">
                <span>Hello From alert</span>
            </x-ui.alert>

            <x-ui.alert type="danger">
                <span>Hello From alert</span>
            </x-ui.alert>
        </div>
    </div>

    <div class="p-8 rounded-full">
        <h2 class="text-center text-slate-400">Badge</h2>
        <div class="flex items-center justify-center gap-4">
            <x-ui.badge type="info">
                Info
            </x-ui.badge>

            <x-ui.badge type="success">
                Success
            </x-ui.badge>

            <x-ui.badge type="warning">
                Warning
            </x-ui.badge>

            <x-ui.badge type="fancy">
                Fancy
            </x-ui.badge>

            <x-ui.badge type="new">
                New
            </x-ui.badge>
        </div>
    </div>

    <div class="p-8 rounded-full">
        <h2 class="text-center text-slate-400">Tabs</h2>
        <div class="flex items-center justify-center">
            <x-ui.tabs :tabs="[
                'info' => 'General Info',
                'security' => 'Security',
                'billing' => 'Billing',
            ]" active="info">
                <x-slot:info>
                    <h2 class="text-xl font-bold">Profile Information</h2>
                    <p>This is the general info tab content.</p>
                </x-slot:info>

                <x-slot:security>
                    <button class="btn btn-error">Reset Password</button>
                </x-slot:security>

                <x-slot:billing>
                    <p>No invoices found.</p>
                </x-slot:billing>
            </x-ui.tabs>
        </div>
    </div>
</x-layouts.public>
