<x-layout>
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <x-navbar>
        </x-navbar>

        <!-- Sidebar -->

        <x-sidebar :notifications="$notifications" />

        <main class="h-auto p-4 pt-20 md:ml-64">

            <x-ui.heading>
                Overview
            </x-ui.heading>

            <x-overview.layout :applications="$applications" />


            <x-footer />
        </main>
    </div>
</x-layout>
