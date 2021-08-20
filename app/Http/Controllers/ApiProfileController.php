<?php

namespace App\Http\Controllers;

use App\User;

class ApiProfileController extends Controller
{
    public function getMyProfile()
    {
        $user = User::find(auth()->user()->id);

        return response([
            'result' => 200,
            'user' => $user,
            'age' => $user->bio->age,
            'bio' => $user->bio,
        ], 200);
    }

    public function updateMyProfile()
    {
        $data = request()->validate([
            'email' => '',
            'password' => '',
            'mobile' => '',
        ]);

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $user = User::find(auth()->user()->id);

        $user->update($data);

        return response([
            'result' => 200,
            'user' => $user,
            'age' => $user->bio->age,
            'bio' => $user->bio,
        ], 200);

    }
}
