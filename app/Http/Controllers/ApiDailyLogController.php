<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ApiDailyLogController extends Controller
{
    public function getLatestLog(){
        
        $user = User::find(auth()->user()->id);
        return response([
            'log'=>$user->daylogs()->latest()->first(),
            'result'=>200
        ],200);
    }
}
