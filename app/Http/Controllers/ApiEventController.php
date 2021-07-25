<?php

namespace App\Http\Controllers;

use App\User;
use App\Event;
use App\Royalty;
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
        $puzzle = null;

        // if quiz game
        if($event->type == 'Quiz Game'){
            $questions = $game->questions()->inRandomOrder()->get();
            foreach($questions as $question){
                $question->array_answer = $question->array_answer;
            }
        }else if($event->type == 'Puzzle Game'){
            $puzzle = $event->game->puzzle;
        }

        
        return response([
            'event'=>$event, 
            'game'=>$game,
            'questions'=>$questions,
            'puzzle'=>$puzzle,
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
        $event = Event::find($data['event_id']);
        $status = false;
        $cbal = Royalty::where('user_id', auth()->user()->id)->first();

        if($event->gem == 'purple'){
            if((int)$event->cost <= (int)$cbal->royalties->purple_crystal){
                $newbal = (int)$cbal->royalties->purple_crystal - (int)$event->cost;
                $cbal->update(['purple_crystal'=>$newbal]);
                $status = true;
            }
        }else {
            if((int)$event->cost <= (int)$cbal->royalties->white_crystal){
                $newbal = (int)$cbal->royalties->white_crystal - (int)$event->cost;
                $cbal->update(['white_crystal'=>$newbal]);
                $status = true;
            }
        }
        
        return response([
            'status'=>$status,
            'new_balance'=>$cbal,
            'result'=>200
        ], 200);
    }
}
