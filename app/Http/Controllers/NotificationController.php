<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Intern;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $intern = Intern::where('user_id', Auth::user()->id)->first();
        // dd($intern);
        // Fetch notifications for the authenticated user
        $notifications = $intern->notifications;
        // dd($notifications);
        return view('interns.notifications', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $intern = Intern::where('user_id', Auth::user()->id)->first();
        // Mark a specific notification as read
        $notification = $intern->notifications()->findOrFail($id);
        // dd($notification);
        $notification->markAsRead();

        return redirect()->back()->with('success', 'Notification marked as read.');
    }

    public function destroy($id)
    {

        $intern = Intern::where('user_id', Auth::user()->id)->first();
        // Delete a specific notification
        $notification = $intern->notifications()->findOrFail($id);
        $notification->delete();

        return redirect()->back()->with('success', 'Notification deleted successfully.');
    }

    public function clearAll()
    {
        // Delete all notifications for the authenticated user
        $intern = Intern::where('user_id', Auth::user()->id)->first();
        $intern->notifications()->delete();

        return redirect()->back()->with('success', 'All notifications have been cleared.');
    }
}
