<?php

namespace App\Http\Controllers\Intern;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function index()
    {
        try {
            // Fetch all users for the chat
            $users = User::where('role', '!=', 'intern')->get();
            return view('interns.chat.index', compact('users'));
        } catch (\Exception $e) {
            Log::error('Error in ChatController@index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the chat.');
        }
    }

    public function show($userId)
    {
        try {
            // Fetch messages between the authenticated user and the specified user
            $authId = Auth::user()->id;
            $messages = Message::where(function ($query) use ($authId, $userId) {
                $query->where(function ($q) use ($authId, $userId) {
                    $q->where('sender_id', $authId)
                        ->where('recipient_id', $userId);
                })->orWhere(function ($q) use ($authId, $userId) {
                    $q->where('sender_id', $userId)
                        ->where('recipient_id', $authId);
                });
            })->with(['sender', 'recipient'])->orderBy('created_at', 'asc')->get();
            // Get the receiver user information
            $receiver = User::findOrFail($userId);
            return view('interns.chat.show', compact('messages', 'receiver'));
        } catch (\Exception $e) {
            Log::error('Error in ChatController@show: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the chat conversation.');
        }
    }

    public function sendMessage(Request $request, $userId)
    {
        try {
            // Validate the request
            $request->validate([
                'content' => 'required|string|max:255',
            ]);
            // Create a new message
            $message = Message::create([
                'sender_id' => Auth::user()->id,
                'recipient_id' => $userId,
                'content' => $request->input('content'),
                'read' => false,
            ]);
            broadcast(new MessageSent($message));
            return response()->json([
                'success' => true,
                'message' => $message
            ]);
        } catch (\Exception $e) {
            Log::error('Error in ChatController@sendMessage: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'An error occurred while sending the message.'
            ], 500);
        }
    }

    public function markAsRead($messageId)
    {
        try {
            // Mark the message as read
            $message = Message::findOrFail($messageId);
            $message->update(['read' => true]);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Error in ChatController@markAsRead: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'An error occurred while marking the message as read.'
            ], 500);
        }
    }
}
