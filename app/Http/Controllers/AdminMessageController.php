<?php

namespace App\Http\Controllers;

use App\Character;
use App\Interest;
use App\Message;
use App\User;
use Illuminate\Http\Request;

class AdminMessageController extends Controller
{
    public function __construct(User $user, Character $character, Message $message, Interest $interest)
    {
        $this->message = $message;
        $this->user = $user;
        $this->character = $character;
        $this->interest = $interest;
        $this->middleware(['auth:admin', 'checkrole:message']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = [];
        if (request()->mtype == 'in') {
            switch (request()->utype) {
                case 'user':
                    $messages = auth()->guard('admin')->user()->inboxes()->where('type', 'user')->latest()->get();
                    break;
                case 'scholars':
                    $messages = auth()->guard('admin')->user()->inboxes()->where('type', 'scholars')->latest()->get();
                    break;
                case 'students':
                    $messages = auth()->guard('admin')->user()->inboxes()->where('type', 'students')->latest()->get();
                    break;
                case 'integrated school':
                    $messages = auth()->guard('admin')->user()->inboxes()->where('type', 'integrated school')->latest()->get();
                    break;
                case 'reagan':
                    $messages = auth()->guard('admin')->user()->inboxes()->where('type', 'reagan')->latest()->get();
                    break;
                case 'berkeley':
                    $messages = auth()->guard('admin')->user()->inboxes()->where('type', 'berkeley')->latest()->get();
                    break;
                case 'vip':
                    $messages = auth()->guard('admin')->user()->inboxes()->where('type', 'vip')->latest()->get();
                    break;
                case 'vip':
                    $messages = auth()->guard('admin')->user()->inboxes()->where('type', 'vip')->latest()->get();
                    break;
                case 'users':
                    $messages = auth()->guard('admin')->user()->inboxes()->where('type', 'users')->latest()->get();
                    break;
            }
        } else {

            switch (request()->utype) {
                case 'user':
                    $messages = auth()->guard('admin')->user()->outboxes()->where('type', 'user')->latest()->get();
                    break;
                case 'scholars':
                    $messages = auth()->guard('admin')->user()->outboxes()->where('type', 'scholars')->latest()->get();
                    break;
                case 'students':
                    $messages = auth()->guard('admin')->user()->outboxes()->where('type', 'students')->latest()->get();
                    break;
                case 'integrated school':
                    $messages = auth()->guard('admin')->user()->outboxes()->where('type', 'integrated school')->latest()->get();
                    break;
                case 'reagan':
                    $messages = auth()->guard('admin')->user()->outboxes()->where('type', 'reagan')->latest()->get();
                    break;
                case 'berkeley':
                    $messages = auth()->guard('admin')->user()->outboxes()->where('type', 'berkeley')->latest()->get();
                    break;
                case 'vip':
                    $messages = auth()->guard('admin')->user()->outboxes()->where('type', 'vip')->latest()->get();
                    break;
                case 'vip':
                    $messages = auth()->guard('admin')->user()->outboxes()->where('type', 'vip')->latest()->get();
                    break;
                case 'users':
                    $messages = auth()->guard('admin')->user()->outboxes()->where('type', 'users')->latest()->get();
                    break;
            }

        }

        return view('admin.messages.index', compact('messages'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.messages.create', ['users' => $this->user->get(), 'characters' => $this->character->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'type' => 'required',
            'receiver_id' => '',
            'character' => 'required',
            'subject' => 'required',
            'body' => 'required',
            'replyable' => '',
        ]);
        if ($validated['type'] == 'user') {
            auth()->guard('admin')->user()->outboxes()->create($validated);
        } else if ($validated['type'] == 'scholars') {
            $scholars = $this->user->where('role', 'author')->orWhere('role', 'artist')->get();
            foreach ($scholars as $scholar) {
                $validated['receiver_id'] = $scholar->id;
                auth()->guard('admin')->user()->outboxes()->create($validated);
            }
        } else if ($validated['type'] == 'students') {
            $scholars = $this->user->where('role', '!=', 'author')->where('role', '!=', 'artist')->get();
            foreach ($scholars as $scholar) {
                $validated['receiver_id'] = $scholar->id;
                auth()->guard('admin')->user()->outboxes()->create($validated);
            }
            // dd($scholars);
        } else if ($validated['type'] == 'berkeley') {
            $interests = $this->interest->where('name', 'Berkeley Business And Sciences')->get();
            foreach ($interests as $interest) {
                $user = $interest->user;
                $validated['receiver_id'] = $user->id;
                auth()->guard('admin')->user()->outboxes()->create($validated);
            }
        } else if ($validated['type'] == 'integrated school') {
            $interests = $this->interest->where('name', 'Integrated School')->get();
            foreach ($interests as $interest) {
                $user = $interest->user;
                $validated['receiver_id'] = $user->id;
                auth()->guard('admin')->user()->outboxes()->create($validated);
            }
        } else if ($validated['type'] == 'reagan') {
            $interests = $this->interest->where('name', 'Reagan Arts And Humanities')->get();
            foreach ($interests as $interest) {
                $user = $interest->user;
                $validated['receiver_id'] = $user->id;
                auth()->guard('admin')->user()->outboxes()->create($validated);
            }
        } else if ($validated['type'] == 'vip') {
            $users = $this->user->whereNotNull('vip')->get();
            foreach ($users as $user) {
                $validated['receiver_id'] = $user->id;
                auth()->guard('admin')->user()->outboxes()->create($validated);
            }
        } else {
            $users = $this->user->get();
            foreach ($users as $user) {
                $validated['receiver_id'] = $user->id;
                auth()->guard('admin')->user()->outboxes()->create($validated);
            }
        }

        if (isset(request()->to_ticket)) {
            return redirect(route('admin.tickets.index'))->withSuccess('Message Sent!');
        }

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

        $message = $this->user->message->findOrFail($id);
        if ($message->admin_receiver_id != null) {
            $message->read_at = now();
            $message->save();
        }
        return view('admin.messages.show', compact('message'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->message->find($id)->delete();
        return redirect(route('admin.messages.index') . '?utype=user')->withSuccess('Done!');
    }
}
