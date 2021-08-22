<?php

namespace App\Http\Controllers;

use App\Avatar;
use App\User;
use Illuminate\Http\Request;

class ApiAvatarController extends Controller
{
// skin
    // head
    // faceshape
    // facehair
    // hair
    // eyes
    // eyebrows
    // nose
    // lips
    // pe
    // accesories
    // outfit
    // shoes
    public function store()
    {
        $data = request()->validate([
            'skin' => '',
            'head' => '',
            'faceshape' => '',
            'facehair' => '',
            'hair' => '',
            'eyes' => '',
            'eyebrows' => '',
            'nose' => '',
            'lips' => '',
            'pe' => '',
            'accesories' => '',
            'outfit' => '',
            'shoes' => '',
        ]);
        // return auth()->user();
        Avatar::where('user_id', auth()->user()->id)->first()->update($data);
        return response([
            'message' => request()->all(),
            'result' => 200,
        ], 200);
    }

    public function show()
    {
        $avatar = Avatar::where('user_id', auth()->user()->id)->first();
        return $avatar;
        $user = User::find(auth()->user()->id);
        $exclude = ['id', 'user_id'];
        $keys = collect();
        foreach ($avatar as $item) {
            $keys->push($item);
        }

        return $avatar;
        return response([
            'avatar' => $avatar ?? [],
            'result' => 200,
        ], 200);
    }

    public function update()
    {
        $avatar = Avatar::where('user_id', auth()->user()->id)->first();
        $data = request()->validate([
            'skin' => '',
            'head' => '',
            'faceshape' => '',
            'facehair' => '',
            'hair' => '',
            'eyes' => '',
            'eyebrows' => '',
            'nose' => '',
            'lips' => '',
            'pe' => '',
            'accesories' => '',
            'outfit' => '',
            'shoes' => '',
        ]);
        $avatar->update($data);
        return response([
            'message' => request()->all(),
            'result' => 200,
        ], 200);
    }
}
