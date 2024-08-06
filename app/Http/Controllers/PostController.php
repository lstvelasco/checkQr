<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Activity;
use App\Models\Announcement;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
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
        return view('home', ['events' => $events, 'activities' => $activities]);
    }

//     public function show(Post $post)
//     {
//         $activities = Activity::where('notify', true)->latest()->get();

//         return view('post.show', compact('post', 'activities'));
//     }

//     public function create()
//     {
//         // Return the view to create a new post
//         return view('posts.create');
//     }

//     public function store(Request $request)
// {
//     // Validate the request data
//     $attributes = $request->validate([
//         'name' => ['required'],
//         'location' => ['nullable'],
//         'announcement_start' => ['nullable', 'date'],
//         'announcement_end' => ['nullable', 'date'],
//         'content' => ['required']
//     ]);

//     // Determine the current date
//     $currentDate = Carbon::now()->startOfDay(); // Using startOfDay for accurate comparisons

//     // Default status
//     $status = 'Upcoming';

//     // Use Carbon to parse and format the dates
//     $announcementStart = $attributes['announcement_start'] ? Carbon::parse($attributes['announcement_start']) : null;
//     $announcementEnd = $attributes['announcement_end'] ? Carbon::parse($attributes['announcement_end'] . ' 23:59:59') : null;

//     if ($announcementStart && $announcementEnd) {
//         // Determine the status based on the dates
//         if ($announcementEnd->isToday()) {
//             $status = 'Ongoing';
//         } elseif ($announcementStart->isPast() && $announcementEnd->isFuture()) {
//             $status = 'Ongoing';
//         } elseif ($announcementEnd->isPast()) {
//             $status = 'Completed';
//         }
//     }

//     // Create the announcement
//     $announcement = Announcement::create([
//         'author_id' => Auth::id(),
//         'name' => $attributes['name'],
//         'location' => $attributes['location'],
//         'announcement_start' => $announcementStart ? $announcementStart->format('Y-m-d H:i:s') : null,
//         'announcement_end' => $announcementEnd ? $announcementEnd->format('Y-m-d H:i:s') : null,
//         'status' => $status,
//         'isVerified' => Auth::user()->account_type == 'Dean' ? true : false,
//         'verifier_id' => Auth::user()->account_type == 'Dean' ? Auth::id() : null,
//     ]);

//     // Check if the announcement was created successfully
//     if (!$announcement) {
//         return back()->withErrors(['toast_danger' => 'Failed to create announcement.']);
//     }

//     // Create the post
//     $post = Post::create([
//         'author_id' => Auth::id(),
//         'announcement_id' => $announcement->id,
//         'content' => $attributes['content'],
//         'isVerified' => Auth::user()->account_type == 'Dean' ? true : false,
//         'verifier_id' => Auth::user()->account_type == 'Dean' ? Auth::id() : null,
//     ]);

//     // Create activity
//     $activity = Activity::create([
//         'author_id' => Auth::id(),
//         'action' => 'posted an announcement',
//         'notify' => true,
//         'receiver_id' => Auth::id()
//     ]);

//     // Check if the post was created successfully
//     if (!$post) {
//         // Rollback announcement creation if post creation fails
//         $announcement->delete();
//         return back()->withErrors(['toast_danger' => 'Failed to create post.']);
//     }

//     // Redirect to the posts index with a success message
//     return redirect('/')->with('toast_success', 'Announcement posted successfully.');
// }


    public function testSuccess()
    {
        return redirect('/')->with('toast_success', 'This is a success message.');
    }

    public function testDanger()
    {
        return redirect('/')->with('toast_danger', 'This is a danger message.');
    }

    public function testWarning()
    {
        return redirect('/')->with('toast_warning', 'This is a warning message.');
    }

    public function testMultiple()
    {
        return redirect('/')->with('toast_success', 'This is a success message.')
            ->with('toast_danger', 'This is a danger message.')
            ->with('toast_warning', 'This is a warning message.');
    }
}
