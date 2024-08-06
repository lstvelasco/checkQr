<x-layout>
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <x-navbar>
            <x-ui.notif-badge>
                4
            </x-ui.notif-badge>
        </x-navbar>

        <!-- Sidebar -->

        <x-sidebar />

        <main class="h-auto p-4 pt-20 md:ml-64">

            <x-ui.heading>
                Appointments
            </x-ui.heading>

            <x-appointment/>


            <x-footer />
        </main>
    </div>
</x-layout>
