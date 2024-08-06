<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Announcement;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
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

        $posts = Post::with(['announcement', 'user'])->latest()->get();

        $notifications = Activity::where('notify', true)->get();

        return view('announcements.index', compact('posts', 'notifications'));
    }

    public function updateStatuses()
    {
        $now = Carbon::now();

        Announcement::where('announcement_start', '<=', $now)
            ->where('announcement_end', '>=', $now)
            ->update(['status' => 'Ongoing']);

        Announcement::where('announcement_end', '<', $now)
            ->update(['status' => 'Completed']);

        Announcement::where('announcement_start', '>', $now)
            ->update(['status' => 'Upcoming']);

        return response()->json(['message' => 'Statuses updated successfully!']);
    }

    public function validatePost(Request $request)
    {
        $postAttributes = $request->validate([
            'post_id' => ['required'],
            'author_id' => ['required']
        ]);

        if (Auth::user()->account_type == 'Dean') {
            $validatePost = Post::find($postAttributes['post_id'])->update([
                'isVerified' => true,
                'verifier_id' => Auth::id()
            ]);

            $validateAnnouncement = Announcement::find($postAttributes['post_id'])->update([
                'isVerified' => true,
                'verifier_id' => Auth::id()
            ]);
            

            // Create activity
            $validationActivity = Activity::create([
                'author_id' => Auth::id(),
                'action' => 'validated your post',
                'notify' => true,
                'receiver_id' => $postAttributes['author_id']
            ]);

            $validationActivity2 = Activity::create([
                'author_id' => Auth::id(),
                'action' => 'validated a post',
                'notify' => true,
                'receiver_id' => Auth::id()
            ]);

            return redirect('/announcements')->with('toast_success', 'Post validated successfully.');
        } else {

            // Create activity
            $validationActivity = Activity::create([
                'author_id' => Auth::id(),
                'action' => 'tried to validate a post as an unauthorized user but failed',
                'notify' => true,
                'receiver_id' => Auth::id()
            ]);

            return redirect('/announcements')->with('toast_warning', 'Only dean can validate posts.');
        }
    }

    public function invalidatePost(Request $request)
    {
        $postAttributes = $request->validate([
            'post_id' => ['required'],
            'author_id' => ['required']
        ]);

        if (Auth::user()->account_type == 'Dean') {
            $validatePost = Post::find($postAttributes['post_id'])->update([
                'isVerified' => false,
                'verifier_id' => Auth::id()
            ]);

            $invalidateAnnouncement = Announcement::find($postAttributes['post_id'])->update([
                'isVerified' => false,
                'verifier_id' => Auth::id()
            ]);

            // Create activity
            $validationActivity = Activity::create([
                'author_id' => Auth::id(),
                'action' => 'invalidated your post',
                'notify' => true,
                'receiver_id' => $postAttributes['author_id']
            ]);

            $validationActivity2 = Activity::create([
                'author_id' => Auth::id(),
                'action' => 'invalidated a post',
                'notify' => true,
                'receiver_id' => Auth::id()
            ]);

            return redirect('/announcements')->with('toast_success', 'Post invalidated successfully.');
        } else {

            // Create activity
            $validationActivity = Activity::create([
                'author_id' => Auth::id(),
                'action' => 'tried to invalidate a post as an unauthorized user but failed',
                'notify' => true,
                'receiver_id' => Auth::id()
            ]);

            return redirect('/announcements')->with('toast_warning', 'Only dean can invalidate posts.');
        }
    }
}
