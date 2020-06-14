<?php

namespace App\Http\Controllers;

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

    public function event(Request $request)
    {
       try {

        // $response = new StreamedResponse();
        // $response->headers->set('Content-Type', 'text/event-stream');
        // $response->headers->set('Cache-Control', 'no-cache');
        // $response->setCallback(
        //     function() {
        //             echo 'data:'.json_encode(User::all()).'\n\n';
        //             ob_flush();
        //             flush();
        //     });
        // $response->send();

         return response()->stream( function () {
            while(true) {
                echo 'data.'.json_encode(auth()->user()->unreadNotifications).'\n\n';
                ob_flush();
                flush();
                sleep(10);
            };
        }, 200,[
            'Content-Type' => 'text/event-stream',
            'X-Accel-Buffering' => 'no',
            'Cache-Control'=> 'no-cache',
        ]);
       } catch(Exception $e) {
           return $e;
       }
    }
}
