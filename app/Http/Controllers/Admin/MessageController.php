<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Outbox;
use App\Message;
use App\Character;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        return $this->middleware(['auth:admin', 'checkrole:message']);
    }
    public function index()
    {
        $messages = auth()->guard('admin')->user()->outboxes()->get();
        if(auth()->guard('admin')->user()->type == 'super admin') $messages = Outbox::get();

        return view('admin.messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::get();

        $characters = Character::get();
        return view('admin.messages.create',compact('users', 'characters'));
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
            'type'=>'required',
            'subject'=>'required',
            'message'=>'required',
            'character_sender'=>'required',
            'to'=>''
        ]);
        if($request->type == 1){ // if individual user
            auth()->guard('admin')->user()->outboxes()->create([
                'message'=>$request->message,
                'subject'=>$request->subject,
                'to_id'=>$request->to,
                'character_sender'=>$request->character_sender
            ]);

            auth()->guard('admin')->user()->messages()->create([
                'message'=>$request->message,
                'character_sender'=>$request->character_sender,
                'subject'=>$request->subject,
                'to_id'=>$request->to
            ]);


        }else {
            if($request->type == 2 ){
                auth()->guard('admin')->user()->outboxes()->create([
                    'message'=>$request->message,
                    'subject'=>$request->subject,
                    'desc'=>'all users',
                    'character_sender'=>$request->character_sender

                ]);
                $users = User::get();
                foreach($users as $user){
                    auth()->guard('admin')->user()->messages()->create([
                        'message'=>$request->message, 
                        'subject'=>$request->subject,
                        'to_id'=>$user->id,
                        'desc'=>'all users',
                        'character_sender'=>$request->character_sender
                    ]);
                }
            }else if($request->type == 3){
                $scholar = User::where('role', 'author')->orWhere('role', 'artist')->get();

                auth()->guard('admin')->user()->outboxes()->create([
                    'message'=>$request->message,
                    'subject'=>$request->subject,
                    'desc'=>'all scholars',
                    'character_sender'=>$request->character_sender
                ]);

                foreach($scholar as $user){
                    auth()->guard('admin')->user()->messages()->create([
                        'message'=>$request->message, 
                        'subject'=>$request->subject,
                        'to_id'=>$user->id,
                        'desc'=>'all scholars',
                        'character_sender'=>$request->character_sender
                    ]);
                }
            }
            else if($request->type == 4){
                $is = User::whereHas('interests', function(Builder $query){
                    $query->where('type', 'college')->where('name', 'Integrated School');
                })->get();

                auth()->guard('admin')->user()->outboxes()->create([
                    'message'=>$request->message,
                    'subject'=>$request->subject,
                    'desc'=>'all integrated school students',
                    'character_sender'=>$request->character_sender
                ]);

                foreach($is as $user){
                    auth()->guard('admin')->user()->messages()->create([
                        'message'=>$request->message, 
                        'subject'=>$request->subject,
                        'to_id'=>$user->id,
                        'desc'=>'all integrated school students',
                        'character_sender'=>$request->character_sender
                    ]);
                }
            }else if($request->type == 5){
                auth()->guard('admin')->user()->outboxes()->create([
                    'message'=>$request->message,
                    'subject'=>$request->subject,
                    'desc'=>'Reagan Arts And Humanities',
                    'character_sender'=>$request->character_sender
                ]);
                $reagan = User::whereHas('interests', function(Builder $query){
                    $query->where('type', 'college')->where('name', 'Reagan Arts And Humanities');
                })->get();
                

                foreach($reagan as $user){
                    auth()->guard('admin')->user()->messages()->create([
                        'message'=>$request->message, 
                        'subject'=>$request->subject,
                        'to_id'=>$user->id,
                        'desc'=>'Reagan Arts And Humanities',
                        'character_sender'=>$request->character_sender

                    ]);
                }
            }else if($request->type == 6){
                $ber = User::whereHas('interests', function(Builder $query){
                    $query->where('type', 'college')->where('name', 'Berkeley Business And Sciences');
                })->get();

                auth()->guard('admin')->user()->outboxes()->create([
                    'message'=>$request->message,
                    'subject'=>$request->subject,
                    'desc'=>'all Berkeley Business And Sciences',
                    'character_sender'=>$request->character_sender
                ]);

                foreach($ber as $user){
                    auth()->guard('admin')->user()->messages()->create([
                        'message'=>$request->message, 
                        'subject'=>$request->subject,
                        'to_id'=>$user->id,
                        'desc'=>'all Berkeley Business And Sciences',
                        'character_sender'=>$request->character_sender
                    ]);
                }
            }else if($request->type == 7){
                $vip = User::whereNotNull('vip')->get();

                auth()->guard('admin')->user()->outboxes()->create([
                    'message'=>$request->message,
                    'subject'=>$request->subject,
                    'desc'=>'all VIP users',
                    'character_sender'=>$request->character_sender
                ]);

                foreach($vip as $user){
                    auth()->guard('admin')->user()->messages()->create([
                        'message'=>$request->message, 
                        'subject'=>$request->subject,
                        'to_id'=>$user->id,
                        'desc'=>'all VIP users',
                        'character_sender'=>$request->character_sender
                    ]);
                }
            }

        }
        return redirect()->route('admin.messages.index')->withSuccess('Message sent!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $msg = auth()->guard('admin')->user()->outboxes()->find($id);
        return view('admin.messages.show', compact('msg'));
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
        Outbox::find($id)->delete();
        return redirect()->route('admin.messages.index')->withSuccess('Done!');
    }
}
