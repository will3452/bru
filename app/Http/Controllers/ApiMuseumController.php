<?php

namespace App\Http\Controllers;

use App\Art;
use Illuminate\Http\Request;

class ApiMuseumController extends Controller
{
    public function index(){
        if(request()->has('_limit')){
            $arts = Art::limit(request()->_limit)->get();
        }else {
            $arts = Art::get();
        }
        return response([
            'art_scenes'=>$arts,
            'result'=>200
        ], 200);
    }
}
