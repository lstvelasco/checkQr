<x-layout>
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <x-navbar>
        </x-navbar>

        <!-- Sidebar -->

        <x-sidebar :notifications="$notifications" />

        <main class="h-auto p-4 pt-20 md:ml-64">

            <x-ui.heading>
                Notifications
            </x-ui.heading>

            <div class="min-h-[61vh] md:min-h-[65vh]">
                <x-notification :notifications="$notifications" />
            </div>


            <x-footer />
        </main>
    </div>
</x-layout>
