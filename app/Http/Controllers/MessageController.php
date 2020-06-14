<?php

namespace App\Http\Controllers;

use App\Message;
use App\Notifications\MessageSent;
use App\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function create()
    {
        $users = User::where('id', '!=', auth()->user()->id)->get();
        return view('messages.create', compact('users'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
            'recipient_id' => 'required|exists:users,id'
        ]);

       $message =  Message::create([
            'sender_id' => auth()->user()->id,
            'recipient_id' => $request->recipient_id,
            'body' => $request->body
        ]);

        $recipient = User::find($request->recipient_id);
        $recipient->notify( new MessageSent($message));
        return back()->with('flash', 'Tu mensaje fue enviado');
    }

    public function show(Message $message)
    {



        return view('messages.show', compact('message'));
    }
}
