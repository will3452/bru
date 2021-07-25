<?php

namespace App\Http\Controllers;

use App\User;
use App\Event;
use App\Question;
use Illuminate\Http\Request;

class ApiEventController extends Controller
{
    public function index(){
        $events = Event::get();
    return response([
            'events'=>$events, 
            'result'=>200
        ], 200); 
    }

    public function show($id){
        $event = Event::find($id);
        $game = $event->game;
        
        //data 
        $questions = null;

        // if quiz game
        if($event->type == 'Quiz Game'){
            $questions = $game->questions()->inRandomOrder()->get();
            foreach($questions as $question){
                $question->array_answer = $question->array_answer;
            }
        }

        
        return response([
            'event'=>$event, 
            'game'=>$game,
            'questions'=>$questions,
            'result'=>200
        ], 200);
    }

    public function checkAnswer(){
        $data = request()->validate([
            'question_id'=>'required',
            'answer'=>'required'
        ]);

        $question = Question::find($data['question_id']);
        if($question->correct_answer == $data['answer']){
           return response([
                'result'=>200,
                'correct'=>true
            ], 200);
        }

        return response([
            'result'=>200,
            'correct'=>true
        ], 200);

    }

    public function deductCost(){
        $data = request()->validate([
            'event_id'=>'required'           
        ]);
        $user = User::find(auth()->user()->id);
        $event = Event::find($data['event_id']);
        $status = false;
        if($event->gem == 'purple'){
            $eventCost = (int)$event->cost;
            $userMoney = (int)$user->royalties->purple_crystal;
            if($eventCost <= $userMoney){
                $newMoney = $userMoney - $eventCost;
                $user->royalties()->update(['purple_crystal'=>$newMoney]);
                $status = true;
            }
        }else {
            $eventCost = (int)$event->cost;
            $userMoney = (int)$user->royalties->white_crystal;
            if($eventCost <= $userMoney){
                $newMoney = $userMoney - $eventCost;
                $user->royalties()->update(['white_crystal'=>$newMoney]);
                $status = true;
            }
        }

        return response([
            'status'=>$status,
            'new_balance'=>$user->royalties,
            'result'=>200
        ], 200);
    }
}
