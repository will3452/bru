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

    public function storeLog(){
        $data = request()->validate([
            'day'=>'required'
        ]);
        $user = User::find(auth()->user()->id);
        if($user->logChecked()->count() > 7){
            foreach($user->logChecked as $log){
                $log->delete();
            }
        }
        $user->logChecked()->create($data);
        return response([
            'logs'=>$user->logChecked,
            'result'=>200
        ], 200);
    }
}
