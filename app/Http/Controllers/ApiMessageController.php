<?php

namespace App\Http\Controllers;

use App\Message;
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

        $inbox = $user->inboxes()->with('sender')->latest()->get();
        $outbox = $user->outboxes()->with('receiver')->latest()->get();
        foreach ($inbox as $i) {
            $i->readable_date = $i->created_at->diffForHumans();
        }

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

        $inbox = $user->inboxes()->with('sender')->latest()->get();
        $outbox = $user->outboxes()->with('receiver')->latest()->get();
        foreach ($outbox as $i) {
            $i->readable_date = $i->created_at->diffForHumans();
        }

        return response([
            'inbox_len' => count($inbox),
            'outbox_len' => count($outbox),
            'messages' => $outbox,
            'result' => 200,
        ], 200);

    }

    public function removeMessage($id)
    {
        $user = User::find(auth()->user()->id);

        $message = $user->inboxes()->find($id);
        if ($message) {
            $message->delete();
        } else {
            $user->outboxes()->find($id)->delete();
        }
        $inbox = $user->inboxes()->with('sender')->latest()->get();
        $outbox = $user->outboxes()->with('receiver')->latest()->get();

        return response([
            'inbox_len' => count($inbox),
            'outbox_len' => count($outbox),
            'messages' => $inbox,
            'result' => 200,
        ], 200);

    }

    public function readInbox($id)
    {

        $user = User::find(auth()->user()->id);
        $message = Message::find($id);

        $message->read_at = now();
        $message->save();

        return response([
            'message' => $message,
            'result' => 200,
        ], 200);
    }
}
