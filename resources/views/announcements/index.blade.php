<x-layout>
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <x-navbar>
        </x-navbar>

        <!-- Sidebar -->

        <x-sidebar :notifications="$notifications" />

        <main class="h-auto p-4 pt-20 md:ml-64">
            <div class="flex justify-between">
                <x-ui.heading>
                    Announcements
                </x-ui.heading>
            </div>

            <x-announcements.layout>
                <x-announcements.announcements :posts="$posts" />
            </x-announcements.layout>


            <x-footer />
        </main>
    </div>
</x-layout>
