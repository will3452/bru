<?php

namespace App\Http\Controllers;

use App\Art;
use Illuminate\Http\Request;

class ApiMuseumController extends Controller
{
    public function index(){
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
            'result'=>200
        ], 200);
    }
}