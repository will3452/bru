<?php

namespace App\Http\Controllers;

use App\Box;
use App\User;
use Illuminate\Http\Request;

class ApiBoxController extends Controller
{
    public function getWork(Request $request){
        $data = $request->validate([
            'work_type'=>'required'
        ]);
        $user = User::find(auth()->user()->id);
        $work = [];
        if($data['work_type'] == 'book'){
            $work = $user->box->books;
        }else if($data['work_type'] == 'audio'){
            $work = $user->box->audios;
        }else if($data['work_type'] == 'art'){
            $work = $user->box->arts;
        }
        return response([
            'work'=>$work,
            'size'=>count($work),
            'result'=>200
        ], 200);


    }
    public function list(){
        $user = User::find(auth()->user()->id);
        
        if($user->box()->count() == 0){
            $user->box()->create([]);
        }
        
        return response([
            'collection'=>[
                'books'=>$user->box->books,
                'audio_books'=>$user->box->audios, 
                'podcasts'=>$user->box->podcasts,
                'arts'=>$user->box->arts,
                'songs'=>$user->box->songs,
                'films'=>$user->box->films
            ],
            'book_size'=>count($user->box->books),
            'audio_size'=>count($user->box->audios),
            'result'=>200
        ], 200);
    }

    public function remove(Request $request){
        $data = $request->validate([
            'work_id'=>'required',
            'work_type'=>'required'
        ]);

        $user = User::find(auth()->user()->id);

        switch($data['work_type']){
            case 'book': 
                $user->box->books()->detach($data['work_id']);
            break;
            case 'audio': 
                $user->box->audios()->detach($data['work_id']);
            break;
            case 'podcast': 
                $user->box->podcasts()->detach($data['work_id']);
            break;
            case 'art': 
                $user->box->arts()->detach($data['work_id']);
            break;
            case 'song': 
                $user->box->songs()->detach($data['work_id']);
            break;
            case 'film': 
                $user->box()->films()->detach($data['work_id']);
            break;
        }

         return response([
            'collection'=>[
                'books'=>$user->box->books,
                'audio_books'=>$user->box->audios, 
                'podcasts'=>$user->box->podcasts,
                'arts'=>$user->box->arts,
                'songs'=>$user->box->songs,
                'films'=>$user->box->films
            ],
            'result'=>200
        ], 200);

    }

    public function add(Request $request){
        $data = $request->validate([
            'work_id'=>'required',
            'work_type'=>'required'
        ]);

        $user = User::find(auth()->user()->id);
        
        if($user->box()->count() == 0){
            $user->box()->create([]);
        }

        

        switch($data['work_type']){
            case 'book': 
                $user->box->books()->attach($data['work_id']);
            break;
            case 'audio': 
                $user->box->audios()->attach($data['work_id']);
            break;
            case 'podcast': 
                $user->box->podcasts()->attach($data['work_id']);
            break;
            case 'art': 
                $user->box->arts()->attach($data['work_id']);
            break;
            case 'song': 
                $user->box->songs()->attach($data['work_id']);
            break;
            case 'film': 
                $user->box()->films()->attach($data['work_id']);
            break;
        }


        return response([
            'collection'=>[
                'books'=>$user->box->books,
                'audio_books'=>$user->box->audios, 
                'podcasts'=>$user->box->podcasts,
                'arts'=>$user->box->arts,
                'songs'=>$user->box->songs,
                'films'=>$user->box->films
            ],
            'result'=>200
        ], 200);
    }
}
