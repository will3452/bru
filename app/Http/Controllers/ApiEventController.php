<?php

namespace App\Http\Controllers;

use App\User;
use App\Event;
use App\Winner;
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
           'event_id'=>'required',
           'ids'=>'required',
           'score'=>'required'
       ]);

       $perfect = false;

       $royalty = Royalty::find(auth()->user()->id);
       for($i = 0; $i < $data['score']; $i++){
           $q = Question::find($data['ids'][$i]);
           return $q;
           if($q->prize == 'Hall passes'){
               $royalty->update(['hall_pass'=>$royalty->hall_pass + $q->qty]);
           }else if($q->prize == 'White Crystal'){
               $royalty->update(['white_crystal'=>$royalty->white_crystal + $q->qty]);
           }else {
               //if art scene
           }
       }
       
       if($data['score'] == count($data['ids'])){
           Winner::create([
               'event_id'=>$data['event_id'],
               'user_id'=>auth()->user()->id,
               'prize'=>'Jackpot'
           ]);
       }

       return response([
           'new_balance'=>User::find(auth()->user()->id)->royalties,
           'result'=>200,
           'perfect'=>$perfect
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
            if((int)$event->cost <= (int)$cbal->purple_crystal){
                $newbal = (int)$cbal->purple_crystal - (int)$event->cost;
                $cbal->update(['purple_crystal'=>$newbal]);
                $status = true;
            }
        }else {
            if((int)$event->cost <= (int)$cbal->white_crystal){
                $newbal = (int)$cbal->white_crystal - (int)$event->cost;
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
