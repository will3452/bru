<?php

namespace App\Http\Controllers;

use App\Audio;
use App\Podcast;
use Illuminate\Http\Request;

class ApiMediaStationController extends Controller
{
    public function audioBookIndex(){
         // return request()->all();
        request()->validate([
            'genre'=>'required'
        ]);
        
        if(request()->has('_limit')){
            $books = Audio::where('genre', request()->genre)->limit(request()->_limit)->get();
        }else {
            $books = Audio::where('genre', request()->genre)->get();
        }
        return response([
            'books'=>$books,
            'size'=>count($books),
            'result'=>200
        ], 200);
    }

    public function audioBookShow($id){
        // return $id;
        $book = Audio::find($id);
        
        $userid = $book->user_id;

        $user = Audio::find($userid);
        
        $other = $user->audio;

        return response([
            'author'=>$user,
            'book'=>$book,
            'stars'=>abs($book->stars()->avg('value')) ?? 0,
            'other_works'=>$other,
            'is_in_collection'=>auth()->user()->isAudioIsInTheBox($id),
            'result'=>200
        ], 200);

    }

    public function audioBookSummary(){
        $a = Audio::where('genre', 'Teen and Young Adult')->count();
        $b = Audio::where('genre', 'New Adult')->count();
        $c = Audio::where('genre', 'Romance')->count();
        $d = Audio::where('genre', 'Detective and Mystery')->count();
        $e = Audio::where('genre', 'Action')->count();
        $f = Audio::where('genre', 'Historical')->count();
        $g = Audio::where('genre', 'Thriller and Horror')->count();
        $h = Audio::where('genre', 'LGBTQIA+')->count();
        $i = Audio::where('genre', 'Poetry')->count();
        return response([
            'teen_and_young_adult'=>$a,
            'new_adult'=>$b,
            'romance'=>$c,
            'detective_and_mystery'=>$d,
            'action'=>$e,
            'historical'=>$f,
            'thriller_and_horror'=>$g,
            'lgbtqia'=>$h,
            'poetry'=>$i,
            'result'=>200
        ],200);
    }

    public function podcastIndex(){
        request()->validate([
            'part_of'=>'required'
        ]);

        if(request()->has('_limit')){
            $books = Podcast::where('part_of', request()->part_of)->limit(request()->_limit)->get();
        }else {
            $books = Podcast::where('part_of', request()->part_of)->get();
        }
        return response([
            'podcasts'=>$books,
            'size'=>count($books),
            'result'=>200
        ], 200);
    }

     public function podcastShow($id){
        // return $id;
        $book = Podcast::find($id);
        
        $userid = $book->user_id;

        $user = Podcast::find($userid);
        
        $other = $user->podcasts;

        return response([
            'author'=>$user,
            'book'=>$book,
            'other_works'=>$other,
            'is_in_collection'=>auth()->user()->isPodcastIsInTheBox($id),
            'result'=>200
        ], 200);
    }


    public function podcastSummary(){
        $a = Podcast::where('part_of', 'standalone')->count();
        return response([
            'standalone'=>$a,
            'result'=>200
        ],200);
    }


}
