<?php

namespace App\Http\Controllers;

use App\User;
use App\Thrailer;
use Illuminate\Http\Request;

class ApiTheaterController extends Controller
{
    public function index(){
        request()->validate([
            'category'=>'required'
        ]);

        $works = Thrailer::where('category', request()->category)->get();

        if(request()->has('_limit')){
            $works = Thrailer::where('category', request()->category)->limit(request()->_limit)->get();
        }else {
            $works = Thrailer::where('category', request()->category)->get();
        }

        return response([
            'works'=>$works,
            'size'=>count($works),
            'result'=>200
        ], 200);
    }

    public function show($id){
        // return $id;
        $work = Thrailer::find($id);
        
        $userid = $work->user_id;

        $user = User::find($userid);
        
        $other = $user->thrailers;

        return response([
            'author'=>$user,
            'work'=>$work,
            'other_works'=>$other,
            'result'=>200
        ], 200);

    }
}
