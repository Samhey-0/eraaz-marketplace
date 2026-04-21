<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Get the latest unread notifications.
     */
    public function latest()
    {
        $notifications = Auth::user()
            ->unreadNotifications()
            ->latest()
            ->take(5)
            ->get();

        // Mark them as read immediately if we are displaying them as toasts?
        // Or keep them unread until the user clicks a notification center?
        // For "Real-time Toasts", we'll mark them as read so they don't pop up again.
        $notifications->markAsRead();

        return response()->json($notifications);
    }

    /**
     * Get all notifications for the user.
     */
    public function index()
    {
        $notifications = Auth::user()->notifications()->paginate(20);
        return view('notifications.index', compact('notifications'));
    }
}
