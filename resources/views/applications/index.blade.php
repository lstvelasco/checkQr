<x-layout>
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <x-navbar>
        </x-navbar>

        <!-- Sidebar -->

        <x-sidebar :notifications="$notifications" />

        <main class="h-auto p-4 pt-20 md:ml-64">
            <div class="flex justify-between">
                <x-ui.heading>
                    Applications
                </x-ui.heading>
            </div>

            <x-application.layout>
                <x-application.application :applications="$applications" />
            </x-application.layout>


            <x-footer />
        </main>
    </div>
</x-layout>
