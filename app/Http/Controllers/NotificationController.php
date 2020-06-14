<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function index()
    {
        $unreadNotifications = auth()->user()->unreadNotifications;
        $readNotifications = auth()->user()->readNotifications;
        return view('notifications.index', compact('unreadNotifications','readNotifications'));
    }

    public function read($id)
    {
        DatabaseNotification::find($id)->markAsRead();
        return back()->with('flash','Notificación marcada como leída');
    }

    public function destroy($id)
    {
        DatabaseNotification::find($id)->delete();
        return back()->with('flash','Notificación eliminada');
    }
}
