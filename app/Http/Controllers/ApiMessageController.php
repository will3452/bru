<?php

namespace App\Http\Controllers;

use App\User;

class ApiMessageController extends Controller
{

    public function sendMessage()
    {
        $user = User::find(auth()->user()->id);
        $data = request()->validate([
            'receiver_id' => 'required',
            'subject' => '',
            'body' => '',
            'reply_id' => '',
        ]);

        $data['replyable'] = true;
        $user->outboxes()->create($data);

        return response([
            'result' => 200,
        ], 200);
    }

    public function getInbox()
    {
        $user = User::find(auth()->user()->id);

        $inbox = $user->inboxes()->latest()->get();
        return response([
            'messages' => $inbox,
            'result' => 200,
        ], 200);
    }

    public function readMessage($id)
    {
        $user = User::find(auth()->user()->id);
        $message = $user->inboxes()->find($id);
        $message->update(['read_at' => now()]);
        return response([
            'message' => $message,
            'result' => 200,
        ], 200);
    }
}
