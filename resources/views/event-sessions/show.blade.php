<x-layout>
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <x-navbar>
        </x-navbar>

        <!-- Sidebar -->

        <x-sidebar :notifications="$activities" />

        <main class="h-auto p-4 pt-20 md:ml-64">
            <div class="flex justify-between">
                <x-ui.heading>
                    {{ $eventSession->event_day . ' ' . $eventSession->name }}
                </x-ui.heading>
                @auth
                    @if (Auth::user()->role == 'Attendance Officer')
                        <x-post />
                    @endif
                @endauth
            </div>

            <x-ui.layout>
                <x-event-sessions.show :eventSession="$eventSession" :event="$event"></x-event-sessions.show>
            </x-ui.layout>

            <x-footer />
        </main>
    </div>
</x-layout>
