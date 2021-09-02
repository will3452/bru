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

        if ($request->sound) {
            if ($user->sound_mute == 'off') {
                $user->sound_mute = 'on';
            } else {
                $user->sound_mute = 'off';
            }
        }

        if ($request->notif) {
            if ($user->notificatin_mute == 'off') {
                $user->notificatin_mute = 'on';
            } else {
                $user->notificatin_mute = 'off';
            }
        }

        $user->save();

        return response([
            'mute' => $user->sound_mute,
            'mute' => $user->notificatin_mute,
            'result' => 200,
        ], 200);

    }
}
