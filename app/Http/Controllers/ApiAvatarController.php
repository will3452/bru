<?php

namespace App\Http\Controllers;

use App\Avatar;
use App\Product;
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
        $data['user_id'] = auth()->user()->id;
        // return auth()->user();
        Avatar::create($data);
        return response([
            'message' => request()->all(),
            'result' => 200,
        ], 200);
    }

    public function show()
    {
        $avatar = Avatar::where('user_id', auth()->user()->id)->first();
        $pe = Product::where('id', $avatar->pe ?? 0)->first();
        $outfit = Product::where('id', $avatar->outfit ?? 0)->first();
        $shoes = Product::where('id', $avatar->shoes ?? 0)->first();

        //if pe is dynamic
        if ($pe) {
            $avatar->pe = [
                'image' => $pe->picture,
                'width' => $pe->width,
                'height' => $pe->height,
                'x' => $pe->x,
                'y' => $pe->y,
            ];
        }
        if ($outfit) {
            $avatar->outfit = [
                'image' => $outfit->picture,
                'width' => $outfit->width,
                'height' => $outfit->height,
                'x' => $outfit->x,
                'y' => $outfit->y,
            ];
        }
        if ($shoes) {
            $avatar->shoes = [
                'image' => $shoes->picture,
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
