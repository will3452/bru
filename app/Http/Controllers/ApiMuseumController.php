<?php

namespace App\Http\Controllers;

use App\Art;
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
}
