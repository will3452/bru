<?php

namespace App\Http\Controllers;

use App\AppData;
use App\User;
use Illuminate\Http\Request;

class ApiAppDataController extends Controller
{
    public function get(Request $request)
    {
        $user = User::find(auth()->user()->id);

        if ($user->sound_mute == 'off') {
            return response([
                'alert' => 'your sound is off',
                'result' => 404,
            ], 200);
        }

        $request->validate([
            'key' => 'required',
        ]);

        $data = AppData::where('key', $request->key)->first();

        $data['value'] = "/storage/" . $data['value'];

        return response([
            'data' => $data,
            'result' => 200,
        ], 200);

    }
}
