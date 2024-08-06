@props(['announcements'])

<x-application-shell>
    <x-ui.post-card>
        <div class="flex flex-col w-full px-5 py-5 space-y-4 dark:text-white">
            <div id='calendar' class="h-full"></div>
        </div>
    </x-ui.post-card>
</x-application-shell>

<script type="module">
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        if (calendarEl) {
            const { Calendar, dayGridPlugin, timeGridPlugin, interactionPlugin } = window.FullCalendar;

            // Generate events directly from Blade data
            const events = [
                @foreach($announcements as $announcement)
                    {
                        title: @json($announcement->name),
                        start: @json($announcement->announcement_start),
                        end: (() => {
                            const startDate = new Date(@json($announcement->announcement_start));
                            const endDate = new Date(@json($announcement->announcement_end));
                            // Add a day if start and end are not the same
                            if (startDate.getTime() !== endDate.getTime()) {
                                endDate.setDate(endDate.getDate() + 1);
                            }
                            return endDate.toISOString().split('T')[0];
                        })(),
                        description: @json($announcement->location),
                        status: @json($announcement->status)
                    },
                @endforeach
            ];

            console.log('Events:', events);

            var calendar = new Calendar(calendarEl, {
                plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                initialView: 'dayGridMonth',
                editable: true,
                selectable: true,
                events: events,
                eventContent: function(arg) {
                    // Custom rendering for event content
                    let title = arg.event.title;
                    let description = arg.event.extendedProps.description;
                    let status = arg.event.extendedProps.status;

                    return {
                        html: `
                            <div class="fc-event-content bg-green-800 text-white p-2 rounded-md">
                                <div class="fc-event-title text-sm font-semibold">${title}</div>
                                ${description ? `<div class="fc-event-description text-xs">${description}</div>` : ''}
                                ${status ? `<div class="fc-event-status text-xs italic">${status}</div>` : ''}
                            </div>
                        `
                    };
                },
                windowResize: function(view) {
                    // Change view on mobile devices
                    if (window.innerWidth < 768) {
                        calendar.changeView('timeGridDay');
                    } else {
                        calendar.changeView('dayGridMonth');
                    }
                },
            });

            calendar.render();
        }
    });
</script>

<style>
    /* FullCalendar Custom Styles */
    .fc {
        max-width: 100%;
        overflow-x: auto;
    }

    .fc .fc-daygrid-day-frame {
        border-radius: 0.5rem;
    }

    .fc .fc-daygrid-day-top {
        background-color: #1b1f23; /* Dark background for day cells in dark mode */
        border: 1px solid #2d3748; /* Darker border around day cells */
    }

    .fc .fc-daygrid-day-number {
        color: #e2e8f0; /* Light text color for day numbers */
    }

    .fc .fc-daygrid-day-frame.fc-daygrid-day-selected {
        background-color: #2f855a; /* Dark green background for selected day */
    }

    .fc .fc-daygrid-day.fc-day-today {
        border: 2px solid #48bb78; /* Light green border for today's date */
    }

    .fc .fc-event-content {
        background-color: #2d3748; /* Dark background for events */
        border: 1px solid #4a5568; /* Darker border for events */
    }

    .fc .fc-event-title {
        color: #f9fafb; /* Light color for event title */
    }

    .fc .fc-event-description,
    .fc .fc-event-status {
        color: #e2e8f0; /* Lighter color for description and status */
    }

    /* Mobile specific styles */
    @media (max-width: 768px) {
        .fc-toolbar {
            flex-wrap: wrap;
            justify-content: center;
        }

        .fc .fc-daygrid-day-frame {
            border-radius: 0.25rem;
        }
    }
</style>
