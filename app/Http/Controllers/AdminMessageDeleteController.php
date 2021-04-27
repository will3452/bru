<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

class AdminMessageDeleteController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if($request->message_id == null) return back();
        foreach($request->message_id as $message_id){
            Message::find($message_id)->delete();
        }
        return back()->withSuccess('Done!');
    }
}
