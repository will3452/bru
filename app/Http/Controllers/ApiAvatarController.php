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

        $pe = Product::where('id', $avatar->pe)->first();
        $outfit = Product::where('id', $avatar->outfit)->first();
        $shoes = Product::where('id', $avatar->shoes)->first();
        //if pe is dynamic
        if ($pe) {
            $avatar->pe = [
                'image' => $pe->image,
                'width' => $pe->width,
                'height' => $pe->height,
                'x' => $pe->x,
                'y' => $pe->y,
            ];
        }
        if ($outfit) {
            $avatar->outfit = [
                'image' => $outfit->image,
                'width' => $outfit->width,
                'height' => $outfit->height,
                'x' => $outfit->x,
                'y' => $outfit->y,
            ];
        }
        if ($shoes) {
            $avatar->shoes = [
                'image' => $shoes->image,
                'width' => $shoes->width,
                'height' => $shoes->height,
                'x' => $shoes->x,
                'y' => $shoes->y,
            ];
        }

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
