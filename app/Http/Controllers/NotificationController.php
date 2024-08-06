<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        // Only get the 20 latest notifications
        $notifications = Activity::where('notify', true)
            ->orderByDesc('created_at')
            ->take(20)
            ->get();

        foreach($notifications->where('receiver_id', Auth::id())->where('isRead', false) as $notification)
        {
            Activity::find($notification->id)->update([
                'isRead' => true
            ]);
        }


        return view('notification.index', compact('notifications'));
    }

    public function show()
    {
        return view('notification.show');
    }
}
