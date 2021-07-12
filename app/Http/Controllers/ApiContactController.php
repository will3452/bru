<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiContactController extends Controller
{
    public function searchUser(Request $request){
        $request->validate([
            'keyword'=>'required'
        ]);

        $users = User::where('first_name', 'LIKE', '%'.$request->keyword.'%')->orWhere('last_name', 'LIKE', '%'.$request->keyword.'%')->get();

        return response([
            'users'=>$users,
            'result'=>200
        ], 200);
    }
}
