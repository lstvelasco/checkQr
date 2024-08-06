<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    public function store(Request $request)
    {
        $replyAttributes = $request->validate([
            'comment_id' => ['required'],
            'content' => ['required'],
            'target_author_id' => ['required'],
            'post_id' => ['required']
        ]); 


        $reply = Reply::create([
            'comment_id' => $replyAttributes['comment_id'],
            'content' => $replyAttributes['content'],
            'post_id' => $replyAttributes['post_id'],
            'author_id' => Auth::id(),
        ]);

         // Create activity
        $activity = Activity::create([
            'author_id' => Auth::id(),
            'action' => 'replied on your comment',
            'notify' => true,
            'receiver_id' => $replyAttributes['target_author_id']
        ]);

        return redirect('/posts/' . $replyAttributes['post_id'])->with('toast_success', 'Reply posted successfully.');
    }
}
