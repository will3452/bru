<?php

namespace App\Http\Controllers;

use App\Art;
use App\Book;
use App\Song;
use App\User;
use App\Audio;
use App\Podcast;
use App\Thrailer;
use Illuminate\Http\Request;

class ApiOtherWorkController extends Controller
{
    public function getWorks(Request $request){
        $request->validate([
            'work_type'=>'required',
            'work_id'=>'required'
        ]);
        // return 1;

        $others = [];

        if($request->work_type == 'art'){
            $art = Art::find($request->work_id);
            $author = $art->user;
            $others = $author->arts()->where('id', '!=', $art->id)->get();
        }else if($request->work_type == 'book'){
            $book = Book::find($request->work_id);
            $author = $book->user;
            $others = $author->books()->where('id', '!=', $book->id)->get();
        }else if($request->work_type == 'audio'){
            $book = Audio::find($request->work_id);
            $author =  User::find($book->user_id);
            $others = $author->audio()->where('id', '!=', $book->id)->get();
        }else if($request->work_type == 'podcast'){
            $book = Podcast::find($request->work_id);
            $author = $book->user;
            $others = $author->podcasts()->where('id', '!=', $book->id)->get();
        }else if($request->work_type == 'film'){
            $book = Thrailer::find($request->work_id);
            $author =  User::find($book->user_id);
            $others = $author->thrailers()->where('id', '!=', $book->id)->get();
        }else if($request->work_type == 'song'){
            $book = Song::find($request->work_id);
            $author = $book->user;
            $others = $author->songs()->where('id', '!=', $book->id)->get();
        }

        return response([
            'work'=>$others, 
            'work_size'=>count($others ?? []),
            'result'=>200
        ], 200);
    }
}
