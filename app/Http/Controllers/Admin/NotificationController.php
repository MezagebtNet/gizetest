<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->unreadNotifications;
        $newUserNotifications = array_filter($notifications->toArray(), function ($var) {return $var['type'] == 'App\Notifications\NewUserNotification';});

        return view('admin.notifications', compact('notifications', 'newUserNotifications'));
    }

    public function getUnreadNotifications()
    {
        $notifications = auth()->user()->unreadNotifications;
        return $notifications;
    }

    public function markNotification(Request $request)
    {
        auth()->user()
            ->unreadNotifications
            ->when($request->input('id'), function ($query) use ($request) {
                return $query->where('id', $request->input('id'));
            })
            ->markAsRead();

        return response()->noContent();
    }
}
