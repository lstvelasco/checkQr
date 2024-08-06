<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $messageAttributes = $request->validate([
            'sender_id' => ['required'],
            'receiver_id' => ['required'],
            'conversation_id' => ['required'],
            'content' => ['required'],
        ]); 

        $activateConversation = Conversation::find($messageAttributes['conversation_id'])->update([
            'isActive' => true
        ]);
        $createMessage = Message::create($messageAttributes);

        // Create activity
        $messageActivity = Activity::create([
            'author_id' => Auth::id(),
            'action' => 'sent you a message',
            'notify' => true,
            'receiver_id' => $messageAttributes['receiver_id']
        ]);

        return redirect('/messages/' . $messageAttributes['conversation_id']);
    }

    public function show(Conversation $conversation)
    {
        // Ensure the authenticated user is part of the conversation
        $currentUserId = Auth::id();
        if ($conversation->user1_id !== $currentUserId && $conversation->user2_id !== $currentUserId) {
            abort(403, 'Unauthorized access to this conversation.');
        }

        
        // Retrieve messages for the conversation (optional: paginate if needed)
        // $messages = $conversation->messages()->latest()->paginate(15);
        $messages = $conversation->messages()->oldest()->get();


        // Retrieve notifications (if applicable to the view)
        $notifications = Activity::where('notify', true)->get();

        return view('message.show', compact('notifications', 'conversation', 'messages'));
    }


    public function checkAndCreateConversation(Request $request)
    {
        $currentUser = Auth::id();
        $targetUser = $request->input('target-user');

        // Check if a conversation already exists between the current user and the target user
        $existingConversationId = Conversation::existsBetween($currentUser, $targetUser);

        if ($existingConversationId === false) {
            // No existing conversation, so create a new one
            $conversation = Conversation::create([
                'user1_id' => $currentUser,
                'user2_id' => $targetUser
            ]);
            $existingConversationId = $conversation->id; // Get the ID of the newly created conversation
        }

        // Redirect to the conversation
        return redirect('/messages/' . $existingConversationId);
    }

    public function index() // Shows all the conversations
    {
        $activities = Activity::where('notify', true)->get();

        $conversations = Conversation::where('isActive', true)->latest();

        return view('message.index', ['activities' => $activities, 'conversations' => $conversations]);
    }
}
