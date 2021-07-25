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
        $user = User::find(auth()->user()->id);
        $event = Event::find($data['event_id']);
        $status = false;
        $new_balance = $user->royalties;
        if($event->gem == 'purple'){
            $eventCost = $event->cost;
            $royalties = Royalty::where('user_id', $user->id)->first();
            $userMoney = $royalties->purple_crystal;
            if((int)$eventCost <= (int)$userMoney){
                $newMoney = (int)$userMoney - (int)$eventCost;
                // $royalties->update(['purple_crystal'=>$newMoney]);
                $royalties->purple_crystal =  $newMoney;
                $royalties->save();
                $new_balance = $user->royalties;
                $status = true;
                return response([
                        'status'=>$status,
                        'new_balance'=>$new_balance,
                        'result'=>200
                    ], 200);
            }
        }else {
            $eventCost = $event->cost;
            $royalties = Royalty::where('user_id', $user->id)->first();
            $userMoney = $royalties->white_crystal;
            if((int)$eventCost <= (int)$userMoney){
                $newMoney = (int)$userMoney - (int)$eventCost;
                // $royalties->update(['white_crystal'=>$newMoney]);
                 $royalties->white_crystal =  $newMoney;
                 $royalties->save();
                $new_balance = $user->royalties;
                $status = true;
                return response([
                        'status'=>$status,
                        'new_balance'=>$new_balance,
                        'result'=>200
                    ], 200);
            }
        }
        return response([
            'status'=>$status,
            'new_balance'=>$new_balance,
            'result'=>200
        ], 200);
        
    }
}
