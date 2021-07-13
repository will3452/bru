<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function create(){
        $event = Event::findOrFail(request()->event_id);
        $data = request()->validate([
            'question'=>'required',
            'answers'=>'required',
            'correct_answer'=>'required',
            'qty'=>'required',
            'prize'=>'required'
        ]);
        $event->game->questions()->create($data);

        toast('Question Created!', 'success');
        return back();
    }


}
