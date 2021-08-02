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
        
    }

    public function acceptFriend(){
        
    }

    public function allFriends(){
        
    }

    public function friendRequests(){
        
    }

}
