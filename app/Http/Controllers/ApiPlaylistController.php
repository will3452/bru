<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ApiPlaylistController extends Controller
{
    public function index(){
        
        $user = User::find(auth()->user()->id);

        if($user->playlist()->count() == 0){
            $user->playlist()->create();
        }

        $pl = $user->playlist;
        $songs = $pl->songs;
        $audios = $pl->audios;
        $podcasts = $pl->podcasts;

        return response([
            'songs'=>$songs,
            'audios'=>$audios,
            'podcasts'=>$podcasts,
            'result'=>200
        ],200);
        
    }


    public function mixIndex(){
        
        $user = User::find(auth()->user()->id);

        if($user->playlist()->count() == 0){
            $user->playlist()->create();
        }
        
        $pl = $user->playlist;
        $songs = $pl->songs;
        $audios = $pl->audios;
        $podcasts = $pl->podcasts;

        $works = [];
        array_push($works, $songs);
        array_push($works, $audios);
        array_push($works, $podcasts);

        return response([
            'works'=>$works,
            'result'=>200
        ],200);
        
    }
    

    public function togglePlaylist(Request $request){

        $request->validate([
            'work_type'=>'required',
            'work_id'=>'required'
        ]);
        
        $user = User::find(auth()->user()->id);

        
        if($user->playlist()->count() == 0){
            $user->playlist->create();
        }


        if($request->work_type == 'song'){
            $user->playlist->songs()->toggle($request->work_id);
        }else if($request->work_type == 'audio'){
            $user->playlist->audios()->toggle($request->work_id);
        }else if($request->work_type == 'podcast'){
            $user->playlist->podcasts()->toggle($request->work_id);
        }
        
        return response([
            'result'=>200,
            'playlist'=>$user->playlist
        ], 200);
    }
}
