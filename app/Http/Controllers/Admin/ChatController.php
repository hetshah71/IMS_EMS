<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Events\MessageSent;

class ChatController extends Controller
{
    public function index()
    {
        try {
            // Fetch all users for the chat
            $users = User::where('role', '!=', 'admin')->get();

            return view('admin.chat.index', compact('users'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error loading chat users: ' . $e->getMessage());
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

            return view('admin.chat.show', compact('messages', 'receiver'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error loading chat messages: ' . $e->getMessage());
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
                'message' => $message]);
        } 
        catch (Exception $e) {
            return redirect()->back()->with('error', 'Error sending message: ' . $e->getMessage());
        }
    }
    public function markAsRead($messageId)
    {
        try {
            // Mark the message as read
            $message = Message::findOrFail($messageId);
            $message->update(['read' => true]);

            return response()->json(['success' => true]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
