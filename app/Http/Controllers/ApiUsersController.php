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
        $recipient = User::find(request()->user_id);
        $user->befriend($recipient);
        return response([
            'result'=>200,
        ],200);
    }

    public function acceptFriend(){
        request()->validate([
            'user_id'=>'required'
        ]);
        $user = User::find(auth()->user()->id);
        $sender = User::find(request()->user_id);
        $user->acceptFriendRequest($sender);
        return response([
            'result'=>200,
        ],200);
    }

    public function denyFriend(){
        request()->validate([
            'user_id'=>'required'
        ]);
        $user = User::find(auth()->user()->id);
        $sender = User::find(request()->user_id);
        $user->denyFriendRequest($sender);
        return response([
            'result'=>200,
        ],200);
    }

    public function unFriend(){
        request()->validate([
            'user_id'=>'required'
        ]);
        $user = User::find(auth()->user()->id);
        $friend = User::find(request()->user_id);
        $user->unfriend($friend);
        return response([
            'result'=>200,
        ],200);
    }

    public function allFriends(){
        $user = User::find(auth()->user()->id);
        $friends = $user->getFriends();
        return response([
            'friends'=>$friends,
            'result'=>200
        ], 200);
    }

    public function friendRequests(){
        $user = User::find(auth()->user()->id);
        $pending = $user->getFriendRequests();
        return response([
            'requests'=>$pending,
            'result'=>200,
        ],200);
    }

    public function toggleFollow(){
        request()->validate([
            'user_id'=>'required'
        ]);
        $user = User::find(auth()->user()->id);
        $targets = User::find(request()->user_id);
        $user->toggleFollow(request()->user_id);
        return response([
            'result'=>200,
        ],200);
    }

    public function getFollowers(){
        $user = User::find(auth()->user()->id);
        $followers = $user->followers()->get();
        return response([
            'followers'=>$followers,
            'result'=>200,
        ],200);
    } //test

}
