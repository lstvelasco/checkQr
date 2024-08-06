<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Activity;
use App\Models\Attendance;
use App\Models\EventSession;
use Illuminate\Http\Request;
use App\Models\AttendanceCode;
use App\Models\User;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\SvgWriter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AttendanceCodeController extends Controller
{

    public function generateCodes(Request $request)
    {
        $attributes = $request->validate([
            'event_id' => ['required', 'exists:events,id'],
            'event_session_id' => ['required', 'exists:event_sessions,id']
        ]);

        // Get all users with the role "Attendee"
        $attendees = User::where('role', 'Attendee')->get();

        // Loop through each attendee
        foreach ($attendees as $attendee) {
            // Check if the attendee already has an attendance code for the specific event and event session
            $existingCode = AttendanceCode::where('attendee_id', $attendee->id)
                ->where('event_id', $attributes['event_id'])
                ->where('event_session_id', $attributes['event_session_id'])
                ->first();

            if (!$existingCode) {
                // Generate a new attendance code for the attendee
                AttendanceCode::create([
                    'id' => Str::uuid(),
                    'attendee_id' => $attendee->id,
                    'event_id' => $attributes['event_id'],
                    'event_session_id' => $attributes['event_session_id'],
                    // 'qr_code_image_url' => null, // Replace with actual QR code generation if needed
                    'is_active' => true,
                    // 'expires_at' => now()->addHours(1) // Set expiry as needed
                ]);
            }
        }

        return response()->json(['message' => 'Attendance codes generated successfully for all attendees.']);
    }


    public function index()
    {
        $activities = Activity::where('notify', true)->latest()->get();

        $eventSessions = EventSession::with('event', 'attendanceCode')->get();

        if (!Auth::check() || Auth::user()->role != 'Attendance Officer') {
            abort(403, 'Unauthorized access.');
        }

        return view('attendance-codes.index', compact('activities', 'eventSessions'));
    }

    // public function showPerSession(EventSession $eventSession)
    // {
    //     if (!Auth::check() || Auth::user()->role != 'Attendance Officer') {
    //         abort(403, 'Unauthorized access.');
    //     }

    //     $activities = Activity::where('notify', true)->latest()->get();


    //     // $attendanceCodes = AttendanceCode::where('event_id', $eventSession->event->id)->where('event_session', $eventSession->id)->get();

    //     $attendanceCodes = $eventSession->attendanceCodes()->get();

    //     return view('attendance-codes.show', compact('attendanceCodes', 'activities', 'eventSession'));
    // }

    public function showPerSession(EventSession $eventSession)
    {
        if (!Auth::check() || Auth::user()->role != 'Attendance Officer') {
            abort(403, 'Unauthorized access.');
        }

        $activities = Activity::where('notify', true)->latest()->get();
        $attendanceCodes = $eventSession->attendanceCodes()->get();

        // Generate QR codes for each attendance code
        $svgWriter = new SvgWriter();
        foreach ($attendanceCodes as $attendanceCode) {
            // Generate QR code for the attendance code ID
            $qrCode = QrCode::create($attendanceCode->id)
                ->setSize(300);

            $attendanceCode->qrCodeSvg = $svgWriter->write($qrCode)->getString();
        }

        return view('attendance-codes.show', compact('attendanceCodes', 'activities', 'eventSession'));
    }


    public function show(Event $event, EventSession $eventSession, AttendanceCode $attendanceCode)
    {
        $sessionIsAcceptingAttendance = $eventSession->is_accepting_attendance;

        // if (Auth::user()->role != 'Attendee') {
        //     abort(403, 'Unauthorized access.');
        // }

        if ($sessionIsAcceptingAttendance) {
            if (Auth::check()) {
                // Check if the attendance code is valid and if the logged-in user is the owner
                if ($attendanceCode && $attendanceCode->attendee_id == Auth::id()) {

                    // Check if an attendance record already exists
                    $attendance = Attendance::where([
                        'event_id' => $event->id,
                        'event_session_id' => $eventSession->id,
                        'attendee_id' => Auth::id(),
                    ])->first();

                    if ($attendance) {
                        return redirect('/events/' . $event->id)->with('toast_warning', 'Attendance already recorded');
                    }

                    // If no record exists, create a new attendance record
                    Attendance::create([
                        'event_id' => $event->id,
                        'event_session_id' => $eventSession->id,
                        'attendee_id' => Auth::id(),
                        'is_present' => true,
                    ]);

                    // Redirect to the event's page with a success message
                    return redirect('/events/' . $event->id)->with('toast_success', 'Attendance recorded successfully');
                } else {
                    return redirect('/events/' . $event->id)->with('toast_danger', 'Code mismatched');
                }
            }
        } else {
            return redirect('/events/' . $event->id)->with('toast_danger', 'Session already closed');
        }
    }
}
