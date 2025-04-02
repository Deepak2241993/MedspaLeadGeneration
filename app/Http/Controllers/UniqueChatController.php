<?php

namespace App\Http\Controllers;

use App\Models\UniqueConversation;
use App\Events\UniqueMessageSent;
use App\Models\Conversation;
use App\Models\User;
use App\Models\UniqueMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Events\FacebookMessageSent;



class UniqueChatController extends Controller
{
    
    public function dashboard()
    {
        $users = User::where('id', '!=', auth()->id())->get(['id', 'name', 'profile_pic']);
        return view('unique-chat.dashboard', compact('users'));
    }
    public function instagramdashboard()
    {
        $users = User::where('id', '!=', auth()->id())->get(['id', 'name', 'profile_pic']);
        return view('unique-chat.instagramdashboard', compact('users'));
    }



    public function getMessages($recipientId)
    {
        // Fetch authenticated user ID (assuming the user is logged in)
        $currentUserId = auth()->id();
    
        // Fetch messages where the authenticated user is either the sender or recipient
        $messages = UniqueMessage::where(function ($query) use ($currentUserId, $recipientId) {
                $query->where('sender_id', $currentUserId)
                      ->where('recipient_id', $recipientId);
            })
            ->orWhere(function ($query) use ($currentUserId, $recipientId) {
                $query->where('sender_id', $recipientId)
                      ->where('recipient_id', $currentUserId);
            })
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($message) use ($currentUserId) {
                // Determine if the message is incoming or outgoing
                $message->direction = $message->sender_id == $currentUserId ? 'outgoing' : 'incoming';
                return $message;
            });
    
        return response()->json([
            'success' => true,
            'messages' => $messages,
        ]);
    }
    
    public function sendMessage(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'recipient_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000',
        ]);

        // Get the sender and recipient
        $sender = Auth::user();
        $recipient = User::find($validated['recipient_id']);

        // Create or retrieve the conversation
        $conversation = Conversation::firstOrCreate([
            'user_1_id' => $sender->id,
            'user_2_id' => $recipient->id,
        ]);

        // Create and save the new message
        $message = new UniqueMessage();
        $message->conversation_id = $conversation->id;
        $message->sender_id = $sender->id;
        $message->recipient_id = $recipient->id;
        $message->message = $validated['message'];
        $message->save();

        // Broadcast the event with message, conversation_id, and sender_id
        // broadcast(new FacebookMessageSent($message->message, $conversation->id, $recipient->id))->toOthers();

        // Return a successful response
        return response()->json([
            'message' => 'Message sent successfully!',
            'data' => [
                'message' => $message->message,
                'conversation_id' => $conversation->id,
                'sender_id' => $message->sender_id,
            ],
        ]);
    }

}
