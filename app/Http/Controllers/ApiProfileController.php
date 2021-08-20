<?php

namespace App\Http\Controllers;

use App\User;

class ApiProfileController extends Controller
{
    public function getMyProfile()
    {
        $user = User::find(auth()->user()->id);
        $user->load('bio');

        return response([
            'result' => 200,
            'user' => $user,
        ], 200);
    }

    public function updateMyProfile()
    {
        $data = request()->validate([
            'email' => '',
            'password' => '',
        ]);

        $user = User::find(auth()->user()->id);

        $user->update($data);

        return response([
            'result' => 200,
            'user' => $user,
        ], 200);

    }
}
