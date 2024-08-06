<x-ui.layout>

    @foreach ($attendanceCodes as $attendanceCode)
        <x-application-shell>
            <x-ui.post-card>
                <div class="flex flex-col w-full px-5 py-5 space-y-4">
                    <span class="font-bold text-gray-700 dark:text-gray-300">Event name</span>
                    <p class="font-semibold text-gray-600 dark:text-gray-400">Session name</p>
                    <p class="font-semibold text-gray-600 dark:text-gray-400">
                        {{-- Start: {{ \Carbon\Carbon::parse($event->event_start)->format('F j, Y') }} --}}
                        session start
                    </p>
                    <p class="font-semibold text-gray-600 dark:text-gray-400">
                        {{-- End: {{ \Carbon\Carbon::parse($event->event_end)->format('F j, Y') }} --}}
                        session end
                    </p>
                    <p class="font-semibold text-gray-600 dark:text-gray-400">
                        {{-- Location: {{ $event->location }} --}}
                        location
                    </p>

                    <div class="inline-flex">
                        <button
                            class="small-button status-button font-semibold shadow-lg cursor-not-allowed opacity-75 animate-border">
                            session accepting attendance 
                        </button>
                    </div>

                    <p class="font-thin text-gray-600 dark:text-gray-400">
                        {{-- Added on: {{ \Carbon\Carbon::parse($event->created_at)->format('F j, Y h:i A') }} --}}
                        Added on: {{ \Carbon\Carbon::parse($eventSession->created_at)->format('F j, Y h:i A') }}
                    </p>

                    <hr class="h-px bg-gray-200 dark:bg-gray-700">

                    {{-- <div class="mb-4">
                        @if (!Auth::check() || Auth::user()->role == 'Attendee')
                            <a href="/events/{{ $event->id }}"
                                class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                Attendance
                            </a>
                        @elseif (Auth::check() && Auth::user()->role == 'Attendance Officer')
                            <a href="/events/{{ $event->id }}"
                                class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                Sessions
                            </a>
                        @endif
                    </div> --}}
                </div>
            </x-ui.post-card>
        </x-application-shell>
    @endforeach
</x-ui.layout>
