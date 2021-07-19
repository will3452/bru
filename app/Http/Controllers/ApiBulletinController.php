<?php

namespace App\Http\Controllers;

use App\Bulletin;
use Illuminate\Http\Request;

class ApiBulletinController extends Controller
{
    public function index(){
        return  response([
            'bulletins'=>Bulletin::get(),
            'result'=>200
        ], 200);
    }


    public function show($id){
        return response([
            'bulletin'=>Bulletin::findOrFail($id),
            'result'=>200
        ], 200);
    }
}
