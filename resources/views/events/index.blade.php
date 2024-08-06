<x-layout>
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <x-navbar>
        </x-navbar>

        <!-- Sidebar -->

        <x-sidebar :notifications="$activities" />

        <main class="h-auto p-4 pt-20 md:ml-64">
            <div class="flex justify-between">
                <x-ui.heading>
                    Events
                </x-ui.heading>
                @auth
                    @if (Auth::user()->role == 'Attendance Officer')
                        <x-events.create />
                    @endif
                @endauth
            </div>

            <x-ui.layout>
                <x-events.index :events="$events"></x-events.index>
            </x-ui.layout>


            <x-footer />
        </main>
    </div>
</x-layout>
