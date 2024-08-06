<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Attendance;
use App\Models\Event;
use App\Models\EventSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventSessionController extends Controller
{

    public function show(Event $event, EventSession $eventSession)
    {
        $activities = Activity::where('notify', true)->latest()->get();

        if ($eventSession->is_accepting_attendance == false) {
            abort(403, 'Not accepting attendance');
        }

        if (Auth::user()->role != 'Attendee') {
            abort(403, 'Unauthorized access.');
        }

        return view('event-sessions.show', compact('activities', 'event',  'eventSession'));
    }

    public function update(Request $request, Event $event, EventSession $eventSession)
    {
        $eventSessionAttributes = $request->validate([
            'name' => ['required'],
            'time_start' => ['required'],
            'time_end' => ['required'],
            'event_day' => ['required'],
            'is_accepting_attendance' => ['nullable']
        ]);

        $eventSessionAttributes['is_accepting_attendance'] = $request->has('is_accepting_attendance') ? true : false;

        $event_id = request('event_id');

        if (!Auth::check()) {
            abort(403, 'Unauthorized action.');
        }

        if (Auth::user()->role != 'Attendance Officer') {
            abort(403, 'Unauthorized action.');
        }

        $updateEventSession = $eventSession->update($eventSessionAttributes);

        return redirect('/events/' . $event_id)->with('toast_success', 'Event session updated successfully');

    }

    public function store(Request $request) 
    {
        $eventSessionAttributes = $request->validate([
            'name' => ['required'],
            'event_day' => ['required'],
            'time_start' => ['required'],
            'time_end' => ['required'],
            'is_accepting_attendance' => ['nullable']
        ]);

        $eventSessionAttributes['is_accepting_attendance'] = $request->has('is_accepting_attendance') ? true : false;

        $event_id = request('event_id');

        // Check if authentiated
        if (Auth::check()) {
            // Check if has the right to create event
            if (Auth::user()->role == 'Attendance Officer') {
                // Create event
                $eventSession = Auth::user()->events->where('id', $event_id)->first()->sessions()->create($eventSessionAttributes);
                // Redirect
                return redirect('/events/' . $event_id)->with('toast_success', 'Session created successfully');
            }
        }
    }
}
