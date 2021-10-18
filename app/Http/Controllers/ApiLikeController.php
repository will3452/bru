<?php

namespace App\Http\Controllers;

use App\Chapter;
use Illuminate\Http\Request;

class ApiLikeController extends Controller
{
    public function sanitize($data)
    {
        unset($data['work_type']);
        unset($data['work_id']);
        return $data;
    }

    public function storeChapterLike($data)
    {
        $chapter = Chapter::find($data['work_id']);
        $data = $this->sanitize($data);
        $like = null;

        if ($chapter->likes()->where('user_id', auth()->user()->id)->count()) {
            $chapter->likes()->where('user_id', auth()->user()->id)->delete();
        } else {
            $like = $chapter->likes()->create(['user_id'=>auth()->user()->id]);
        }

        return $like;
    }

    public function storeLike(Request $request)
    {
        $data = $request->validate([
            'work_type'=>'required',
            'work_id'=>'required',
        ]);

        $userId = auth()->user()->id;
        $data['user_id'] = $userId;
        $likes = null;
        if ($request->work_type == 'chapter') {
            $likes = $this->storeChapterLike($data);
            $numberOfLikes = Chapter::find($data['work_id'])->likes()->count();
        }

        return response([
            'number_of_likes'=>$numberOfLikes,
            'hearts'=>$likes,
            'result'=>200
        ], 200);
    }
}
