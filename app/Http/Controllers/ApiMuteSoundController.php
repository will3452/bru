<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ApiMuteSoundController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        $user = User::find(auth()->id());

        if ($request->has('sound')) {
            if ($request->sound == 'off') {
                $user->sound_mute = 'on';
                $user->save();

            } else {
                $user->sound_mute = 'off';
                $user->save();

            }
        }

        if ($request->has('notif')) {
            if ($user->notif == 'off') {
                $user->notif_mute = 'on';
                $user->save();

            } else {
                $user->notif_mute = 'off';
                $user->save();

            }
        }

        

        return response([
            'mute' => $user->sound_mute,
            'notif' => $user->notif_mute,
            'result' => 200,
        ], 200);

    }
}
