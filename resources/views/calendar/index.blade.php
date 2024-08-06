<x-layout>
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <x-navbar>
        </x-navbar>

        <!-- Sidebar -->

        <x-sidebar :notifications="$notifications" />

        <main class="h-auto p-4 pt-20 md:ml-64">
            <div class="flex flex-col">
                <x-ui.heading>
                    Calendar
                </x-ui.heading>
                <div class="mb-2 text-sm text-gray-500 dark:text-gray-300" id="image_url_help">
                    Only validated announcements are displayed here
                </div>
            </div>

            <x-calendar.layout>
                <x-calendar.calendar :announcements="$announcements"/>
            </x-calendar.layout>


            <x-footer />
        </main>
    </div>
</x-layout>
