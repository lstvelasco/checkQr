<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $commentAttributes = $request->validate([
            'post_id' => ['required'],
            'content' => ['required'],
            'target_author_id' => ['required']
        ]);

        $comment = Comment::create([
            'post_id' => $commentAttributes['post_id'],
            'content' => $commentAttributes['content'],
            'author_id' => Auth::id(),
        ]); 

        if (Auth::id() == $commentAttributes['target_author_id']) {
            // Create activity
            $activity = Activity::create([
                'author_id' => Auth::id(),
                'action' => 'commented on your post',
                'notify' => false,
                'receiver_id' => $commentAttributes['target_author_id']
            ]);
        } else {
            // Create activity
            $activity = Activity::create([
                'author_id' => Auth::id(),
                'action' => 'commented on your post',
                'notify' => true,
                'receiver_id' => $commentAttributes['target_author_id']
            ]);
        }

        return redirect('/posts/' . $commentAttributes['post_id'])->with('toast_success', 'Inquiry posted successfully.');
    }
}
