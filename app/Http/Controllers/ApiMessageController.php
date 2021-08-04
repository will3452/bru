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
        $outbox = $user->outboxes()->latest()->get();

        return response([
            'inbox_len' => count($inbox),
            'outbox_len' => count($outbox),
            'messages' => $inbox,
            'result' => 200,
        ], 200);
    }

    public function getOutbox()
    {
        $user = User::find(auth()->user()->id);

        $inbox = $user->inboxes()->latest()->get();
        $outbox = $user->outboxes()->latest()->get();

        return response([
            'inbox_len' => count($inbox),
            'outbox_len' => count($outbox),
            'messages' => $outbox,
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
