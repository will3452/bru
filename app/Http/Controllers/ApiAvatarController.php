<?php

namespace App\Http\Controllers;

use App\Avatar;
use Illuminate\Http\Request;

class ApiAvatarController extends Controller
{
// skin
// head
// faceshape
// facehair
// hair
// eyes
// eyebrows
// nose
// lips
// pe
// accesories
// outfit
// shoes
    public function store(){
        $data = request()->validate([
            'skin'=>'',
            'head'=>'',
            'faceshape'=>'',
            'facehair'=>'',
            'hair'=>'',
            'eyes'=>'',
            'eyebrows'=>'',
            'nose'=>'',
            'lips'=>'',
            'pe'=>'',
            'accesories'=>'',
            'outfit'=>'',
            'shoes'=>''
        ]);
        // return auth()->user();
        $data['user_id'] = auth()->user()->id;
        Avatar::create($data);
        return response([
            'message'=>'avatar saved!',
            'result'=>200
        ]);
    }

    public function show(){
        return response([
            'avatar'=>auth()->user()->avatar ?? [],
            'result'=>200
        ], 200);
    }
}
