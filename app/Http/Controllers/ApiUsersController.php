<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ApiUsersController extends Controller
{
    public function getUsers(){
        $users = User::get();

        return response([
            'users'=>$users,
            'result'=>200
        ], 200);
    }

    public function showUser($id){
        $user = User::find($id);
        return response([
            'user'=>$user,
            'result'=>200
        ], 200);
    }

    public function addFriend(){
        request()->validate([
            'user_id'=>'required'
        ]);
        $user = User::find(auth()->user()->id);
        $friend = $user->friends()->attach(request()->user_id);
        return response([
            'friend'=>$friend,
            'result'=>200
        ],200);
    }

    public function acceptFriend(){
        request()->validate([
            'user_id'=>'required'
        ]);
        $user = User::find(auth()->user()->id);
        $friendUser = User::find(request()->user_id);
        $friendUser->friends()->updateExistingPivot($user->id, ['status'=>'accepted']);

        return response([
            'friends'=>$user->friends,
            'result'=>200
        ], 200);
    }

    public function allFriends(){
        $user = User::find(auth()->user()->id);
        return response([
            'friends'=>$user->all_friends,
            'result'=>200
        ], 200);
    }

    public function friendRequests(){
        $user = User::find(auth()->user()->id);
        $req = \DB::table('friend_user')->where(['friend_id'=>$user->id, 'status'=>'pending'])->get();
        // return 2;
        return response([
            'request'=>$req,
            'result'=>200
        ],200);
    }

}
