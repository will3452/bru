<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiVIPUpdateController extends Controller
{
    public function update(){
        $user = auth()->user();
        request()->validate([
            'q'=>'required'
        ]);

        if(request()->q != 'promo'){
            $user->vip = now();
            $user->save();
        }
        return response([
            'message'=>'VIP saved!'
        ], 200);
    }
}
