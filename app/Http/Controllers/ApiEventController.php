<?php

namespace App\Http\Controllers;

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
}
