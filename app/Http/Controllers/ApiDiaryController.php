<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ApiDiaryController extends Controller
{
    public function addDiary()
    {
        $user = User::find(auth()->user()->id);
        $data = request()->validate([
            'body' => 'required',
        ]);

        $user->diaries()->create($data);
        return response([
            'result' => 200,
        ], 200);
    }
}
