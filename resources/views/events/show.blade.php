<x-layout>
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <x-navbar>
        </x-navbar>

        <!-- Sidebar -->

        <x-sidebar :notifications="$activities" />

        <main class="h-auto p-4 pt-20 md:ml-64">
            <div class="flex justify-between">
                <x-ui.heading>
                    @if (Auth::user()->role == 'Attendance Officer')
                        Sessions
                    @elseif (Auth::user()->role == 'Attendee')
                        Attendance
                    @endif
                </x-ui.heading>
                @auth
                    @if (Auth::user()->role == 'Attendance Officer')
                        <x-events.create :event="$event" type="session" />
                    @endif
                @endauth
            </div>

            <x-ui.layout>
                @if (Auth::user()->role == 'Attendee')
                    <x-events.show :event="$event" :attendances="$attendances"></x-events.show>
                @elseif (Auth::user()->role == 'Attendance Officer')
                    <x-events.show :codesGenerated="$codesGenerated" :attendees="$attendees" :event="$event" :attendances="$attendances"></x-events.show>
                @endif
            </x-ui.layout>

            <x-footer />
        </main>
    </div>
</x-layout>
