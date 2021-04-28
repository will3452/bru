<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InboxController extends Controller
{
    public function __construct(){
        return $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = auth()->user()->inboxes()->latest()->get();
        return view('inbox.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'message_id'=>'required',
            'body'=>'required'
        ]);
        $message = auth()->user()->inboxes()->findOrFail($request->message_id);

        auth()->user()->outboxes()->create([
            'admin_receiver_id'=>$message->admin_sender_id,
            'receiver_id'=>auth()->user()->id == $message->receiver_id ? null : $message->receiver_id,
            'reply_id'=>$message->id,
            'body'=>$request->body,
            'type'=>$message->type,
            'subject'=>$message->subject,
            'replyable'=>1
        ]);

        return back()->withSuccess('Message Sent!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('inbox.show', ['message'=>auth()->user()->inboxes()->findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $message = auth()->user()->inboxes()->findOrFail($id);
        $message->read_at = now();
        $message->save();

        return redirect(route('inbox.show', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
