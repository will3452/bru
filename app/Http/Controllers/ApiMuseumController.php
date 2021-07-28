<?php

namespace App\Http\Controllers;

use App\Art;
use App\User;
use Illuminate\Http\Request;

class ApiMuseumController extends Controller
{
    public function index(){
        // return request()->all();
        request()->validate([
            'genre'=>'required'
        ]);
        
        if(request()->has('_limit')){
            $arts = Art::where('genre', request()->genre)->limit(request()->_limit)->get();
        }else {
            $arts = Art::where('genre', request()->genre)->get();
        }
        return response([
            'art_scenes'=>$arts,
            'size'=>count($arts),
            'result'=>200
        ], 200);
    }


    public function show($id){
        // return $id;
        $art = Art::find($id);
        
        $userid = $art->user_id;

        $user = User::find($userid);
        
        $other = $user->arts;

        return response([
            'author'=>$user,
            'art'=>$art,
            'other_works'=>$other,
            'stars'=>abs($art->stars()->avg('value')) ?? 0,
            'other_works_size'=>count($other ?? []),
            'is_in_collection'=>auth()->user()->isArtIsInTheBox($id),
            'result'=>200
        ], 200);

    }


    public function summary(){
        $a = Art::where('genre', 'Teen and Young Adult')->count();
        $b = Art::where('genre', 'New Adult')->count();
        $c = Art::where('genre', 'Romance')->count();
        $d = Art::where('genre', 'Detective and Mystery')->count();
        $e = Art::where('genre', 'Action')->count();
        $f = Art::where('genre', 'Historical')->count();
        $g = Art::where('genre', 'Thriller and Horror')->count();
        $h = Art::where('genre', 'LGBTQIA+')->count();
        // $a = Art::where('genre', 'Poetry+')->count();
        return response([
            'teen_and_young_adult'=>$a,
            'new_adult'=>$b,
            'romance'=>$c,
            'detective_and_mystery'=>$d,
            'action'=>$e,
            'historical'=>$f,
            'thriller_and_horror'=>$g,
            'lgbtqia'=>$h,
            'result'=>200
        ],200);
    }
}
