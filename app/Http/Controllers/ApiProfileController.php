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
            'age' => $user->bio ? $user->bio->age : 'N/a',
            'bio' => $user->bio,
        ], 200);
    }

    public function updateMyProfile()
    {
        $user = User::find(auth()->user()->id);

        $data = request()->validate([
            'email' => '',
            'password' => '',
            'mobile' => '',
        ]);

        if (isset($data['email'])) {
            if ($data['email'] == $user->email) {
                unset($data['email']);
            } else if (User::where('email', $data['email'])->count() != 0) {

                return response([
                    'result' => 404,
                    'user' => $user,
                    'age' => $user->bio ? $user->bio->age : 'N/a',
                    'bio' => $user->bio,
                ], 200);

            }
        }

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $user->update($data);

        return response([
            'result' => 200,
            'user' => $user,
            'age' => $user->bio->age,
            'bio' => $user->bio,
        ], 200);

    }
}
