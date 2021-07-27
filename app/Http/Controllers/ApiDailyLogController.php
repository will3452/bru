<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ApiDailyLogController extends Controller
{
    public function getLatestLog(){
        
        $user = User::find(auth()->user()->id);
        return response([
            'clicked_log'=>$user->logChecked,
            'log'=>$user->daylogs()->latest()->first(),
            'result'=>200
        ],200);
    }

    public function storeLog(){
        $data = request()->validate([
            'day'=>'required'
        ]);
        $user = User::find(auth()->user()->id);

        $qty = '';
        $prize = '';

        if($data['day'] == 1 || $data['day'] == '1'){
            $user->royalties->hall_pass = (int)$user->royalties->hall_pass + (1 * ($user->vip ? 2:1));
            $qty = 1 * $user->vip ? 2:1;
            $prize = 'hall pass/es';
        }else if($data['day'] == 2 || $data['day'] == '2'){
            $user->royalties->hall_pass = (int)$user->royalties->hall_pass + (1 * ($user->vip ? 2:1));
            $qty = 1 * $user->vip ? 2:1;
            $prize = 'hall pass/es';
        }else if($data['day'] == 3 || $data['day'] == '3'){
            $user->royalties->hall_pass = (int)$user->royalties->hall_pass + (2 * ($user->vip ? 2:1));
            $qty = 2 * $user->vip ? 2:1;
            $prize = 'hall pass/es';
        }else if($data['day'] == 4 || $data['day'] == '4'){
            $user->royalties->hall_pass = (int)$user->royalties->hall_pass + (2 * ($user->vip ? 2:1));
            $qty = 2 * $user->vip ? 2:1;
            $prize = 'hall pass/es';
        }else if($data['day'] == 5 || $data['day'] == '5'){
            $user->royalties->hall_pass = (int)$user->royalties->hall_pass + (3 * ($user->vip ? 2:1));
            $qty = 3 * $user->vip ? 2:1;
            $prize = 'hall pass/es';
        }else if($data['day'] == 6 || $data['day'] == '6'){
            $user->royalties->white_crystal = (int)$user->royalties->white_crystal + (1 * ($user->vip ? 2:1));
            $qty = 1 * $user->vip ? 2:1;
            $prize = 'white crystal/s';
        }else if($data['day'] == 7 || $data['day'] == '7'){
            $user->royalties->white_crystal = (int)$user->royalties->white_crystal + (1 * ($user->vip ? 2:1));
            $qty = 1 * $user->vip ? 2:1;
            $prize = 'white crystal/s';
        }
        $user->royalties->save();



        if($user->logChecked()->count() > 7){
            foreach($user->logChecked as $log){
                $log->delete();
            }
        }

        $user->logChecked()->create($data);
        return response([
            'qty'=>$qty,
            'prize'=>$prize,
            'new_balance'=>$user->royalties,
            'clicked_log'=>$user->logChecked,
            'log'=>$user->daylogs()->latest()->first(),
            'result'=>200
        ], 200);
    }
}
