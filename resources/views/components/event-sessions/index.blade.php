@props(['event'])

<style>
    @keyframes border-pulse {
        0% {
            border-color: rgba(14, 211, 14, 0.5);
        }
        50% {
            border-color: rgb(136, 8, 30);
        }
        100% {
            border-color: rgba(255, 105, 135, 0.5);
        }
    }

    .animate-border {
        border: 8px solid rgba(255, 105, 135, 0.5);
        animation: border-pulse 2s infinite;
    }

    .small-button {
        font-size: 0.875rem;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        border-width: 2px;
    }

    .status-button {
        background-color: #f3f4f6; /* Light mode background */
        color: #333; /* Light mode text */
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .dark .status-button {
        background-color: #2d3748; /* Dark mode background */
        color: #edf2f7; /* Light text in dark mode */
    }
</style>

    @php
        $eventStart = $event->event_start;
        $eventEnd = $event->event_end;
        $location = $event->location;
    @endphp
    <x-application-shell>
        <x-ui.post-card>
            <div class="flex flex-col w-full px-5 py-5 space-y-4">
                <span class="font-bold text-gray-700 dark:text-gray-300">{{ $event->name }}</span>
                <p class="font-semibold text-gray-600 dark:text-gray-400">{{ $event->description }}</p>
                <p class="font-semibold text-gray-600 dark:text-gray-400">
                    Start: {{ \Carbon\Carbon::parse($event->event_start)->format('F j, Y') }}
                </p>
                <p class="font-semibold text-gray-600 dark:text-gray-400">
                    End: {{ \Carbon\Carbon::parse($event->event_end)->format('F j, Y') }}
                </p>
                <p class="font-semibold text-gray-600 dark:text-gray-400">
                    Location: {{ $event->location }}
                </p>
                
                <div class="inline-flex">
                    <button class="small-button status-button font-semibold shadow-lg cursor-not-allowed opacity-75 animate-border">
                        {{ $event->status }}
                    </button>
                </div>

                <p class="font-thin text-gray-600 dark:text-gray-400">
                    Added on: {{ \Carbon\Carbon::parse($event->created_at)->format('F j, Y h:i A') }}
                </p>
                
                <hr class="h-px bg-gray-200 dark:bg-gray-700">
                
                <div class="mb-4">
                    <a href="/events/{{ $event->id }}" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                        Attendance
                    </a>
                </div>
            </div>
        </x-ui.post-card>
    </x-application-shell>

