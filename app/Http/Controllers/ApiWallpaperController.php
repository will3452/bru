<?php

namespace App\Http\Controllers;

use App\Art;
use App\User;

class ApiWallpaperController extends Controller
{
    public function getWallpaper()
    {
        $user = User::find(auth()->user()->id);
        return reponse([
            'wallpaper' => $user->wallpaper,
            'result' => 200,
        ], 200);
    }

    public function saveWallpaper()
    {
        request()->validate([
            'art_id' => 'required',
        ]);

        $wallpaper = Art::find(request()->art_id)->file;

        $user = User::find(auth()->user()->id);
        $user->wallpaper = $wallpaper;
        $user->save();

        return reponse([
            'wallpaper' => $user->wallpaper,
            'result' => 200,
        ], 200);

    }
}
