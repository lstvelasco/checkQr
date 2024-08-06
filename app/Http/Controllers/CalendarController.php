<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Announcement;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        Announcement::where('announcement_start', '<=', $now)
            ->where('announcement_end', '>=', $now)
            ->update(['status' => 'Ongoing']);

        Announcement::where('announcement_end', '<', $now)
            ->update(['status' => 'Completed']);

        Announcement::where('announcement_start', '>', $now)
            ->update(['status' => 'Upcoming']);

        $notifications = Activity::where('notify', true)->get();

        $announcements = Announcement::where('isVerified', true)->get(); // Fetch all announcements

        return view('calendar.index', compact('notifications', 'announcements'));
    }
}
