<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ApiUsersController extends Controller
{
    public function getUsers(){
        $user = User::find(auth()->user()->id);
        // $friends = $user->getFriends()->pluck('id')->all();
        $users = User::where('id','!=', $user->id)->get();
        foreach($users as $u){
            $u->has_requests = $u->hasFriendRequestFrom($user);
            $u->was_followed = $u->isFollowedBy($user);
            $u->was_friend = $u->isFriendWith($user);
        }
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
        $r = User::find(request()->user_id);
        $user->befriend($r);
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
        
        $pendings = $user->getFriendRequests();

        foreach($pendings as $req){
            $sender = User::find($req->sender_id);
            $req->sender = $sender;
        }
        return response([
            'requests'=>$pendings,
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

        $users = User::where('id','!=', $user->id)->get();
        foreach($users as $u){
            $u->has_requests = $u->hasFriendRequestFrom($user);
            $u->was_followed = $u->isFollowedBy($user);
            $u->was_friend = $u->isFriendWith($user);
        }

        return response([
            'users'=>$users,
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
    }

}
