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
            'receiver_id' => '',
            'subject' => '',
            'body' => '',
            'reply_id' => '',
        ]);

        $message = request()->reply_id ? Message::find($data['reply_id']) : null;

        if ($message) {
            if ($message->admin_sender_id != null) {
                $data['admin_receiver_id'] = $data['receiver_id'];
                $data['receiver_id'] = null;
                $data['character'] = $message->character;
                $data['type'] = $message->type;
            }
        }

        $data['replyable'] = true;
        $user->outboxes()->create($data);

        return response([
            'result' => 200,
        ], 200);
    }

    public function getInbox()
    {
        $user = User::find(auth()->user()->id);

        $inbox = Message::where('receiver_id', $user->id)->with(['sender', 'admin_sender'])->latest()->get();

        foreach ($inbox as $i) {
            $i->readable_date = $i->created_at->diffForHumans();
        }

        return response([
            'messages' => $inbox,
            'result' => 200,
        ], 200);
    }

    public function getOutbox()
    {
        $user = User::find(auth()->user()->id);

        $outbox = $user->outboxes()->with('receiver')->latest()->get();
        foreach ($outbox as $i) {
            $i->readable_date = $i->created_at->diffForHumans();
        }

        return response([
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

        return response([
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

    public function readOutbox($id)
    {

        $user = User::find(auth()->user()->id);
        $message = Message::find($id);

        return response([
            'message' => $message,
            'result' => 200,
        ], 200);
    }

    public function unreadMessages()
    {
        $user = User::find(auth()->user()->id);
        return response([
            'count' => $user->inboxes()->whereNull('read_at')->count(),
            'result' => 200,
        ], 200);
    }
}
