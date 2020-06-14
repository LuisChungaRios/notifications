<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Symfony\Component\HttpFoundation\StreamedResponse;

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


    public function event()
    {
       try {

           $response = new StreamedResponse(function() {
               while(true) {
                   $notifications = DatabaseNotification::where('notifiable_id', auth()->user()->id)->where('read_at', null)->get()->toArray();
                   echo 'data: ' . json_encode($notifications) . "\n\n";
                   ob_flush();
                   flush();
                   sleep(10);
               }
           });
           $response->headers->set('Content-Type', 'text/event-stream');
           $response->headers->set('X-Accel-Buffering', 'no');
           $response->headers->set('Cach-Control', 'no-cache');
           return $response;
       } catch(Exception $e) {
           return $e;
       }
    }
}
