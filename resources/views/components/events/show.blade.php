{{-- @props(['event', 'attendances']) --}}

<x-application-shell>
    <x-ui.post-card>
        @if (Auth::user()->role == 'Attendee')
            <x-events.table :event="$event" :attendances="$attendances" />
        @elseif (Auth::user()->role == 'Attendance Officer')
            <x-events.table :codesGenerated="$codesGenerated" :attendees="$attendees" :event="$event" :attendances="$attendances" />
        @endif
    </x-ui.post-card>
</x-application-shell>
