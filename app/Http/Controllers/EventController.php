<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Attendance;
use App\Models\AttendanceCode;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        // Fetch all posts with their associated announcements and authors
        $events = Event::with(['author', 'sessions'])->latest()->get();
        $activities = Activity::where('notify', true)->latest()->get();

        $now = Carbon::now();

        Event::where('event_start', '<=', $now)
            ->where('event_end', '>=', $now)
            ->update(['status' => 'Ongoing']);

        Event::where('event_end', '<', $now)
            ->update(['status' => 'Completed']);

        Event::where('event_start', '>', $now)
            ->update(['status' => 'Upcoming']);


        // Return the view with posts data
        return view('events.index', ['events' => $events, 'activities' => $activities]);
    }

    public function show(Event $event)
    {
        $activities = Activity::where('notify', true)->latest()->get();


        // $attendances = Attendance::all();
        if (Auth::user()->role == 'Attendee') {
            $attendances = Attendance::where('attendee_id', Auth::id())->where('event_id', $event->id)->get();
            return view('events.show', compact('event', 'activities', 'attendances'));
        } elseif (Auth::user()->role == 'Attendance Officer') {
            $attendances = Attendance::all();
            $attendees = User::where('role', 'Attendee')->get();
            $codesGenerated = AttendanceCode::all();
            return view('events.show', compact('event', 'activities', 'attendances', 'attendees', 'codesGenerated'));
        } else {
            return 'You should not be here.';
        }
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $eventAttributes = $request->validate([
            'name' => ['required'],
            'location' => ['required'],
            'event_start' => ['required'],
            'event_end' => ['required'],
            'description' => ['required']
        ]);



        // Check if authentiated
        if (Auth::check()) {
            // Check if has the right to create event
            if (Auth::user()->role == 'Attendance Officer') {
                // Create event
                $event = Auth::user()->events()->create($eventAttributes);
                // Redirect
                return redirect('/')->with('toast_success', 'Event created successfully');
            }
        }
        
    }
}
