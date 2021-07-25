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

       $ids = explode(',',$data['ids']);

       $perfect = false;//fix me up
       $prizes = [];

       $royalty = Royalty::where('user_id', auth()->user()->id)->first();
       for($i = 0; $i < $data['score']; $i++){
           $q = Question::find($ids[$i]);
           if($q->prize == 'Hall passes'){
               $newval = (int)$royalty->hall_pass + (int)$q->qty;
               $royalty->update(['hall_pass'=>$newval]);
               array_push($prizes, $q->qty." hall pass(es)");
           }else if($q->prize == 'White Crystal'){
               $newval = (int)$royalty->white_crystal + (int)$q->qty;
               $royalty->update(['white_crystal'=>$newval]);
               array_push($prizes, $q->qty." white crystal(s)");
           }else {
               //if art scene
           }
       }
       
       if($data['score'] == count($ids)){
           Winner::create([
               'event_id'=>$data['event_id'],
               'user_id'=>auth()->user()->id,
               'prize'=>'Jackpot'
           ]);
           $perfect = true;
       }

       return response([
           'new_balance'=>User::find(auth()->user()->id)->royalties,
           'result'=>200,
           'perfect'=>$perfect,
           'prices'=>$prizes
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
