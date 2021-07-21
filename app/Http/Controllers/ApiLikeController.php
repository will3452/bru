<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiLikeController extends Controller
{   public function sanitize($data){
        unset($data['work_type']);
        unset($data['work_id']);
        return $data;
    }

    public function storeChapterLike($data){
        $chapter = Chapter::find($data['work_id']);
        $data = $this->sanitize($data);

        $like = $chapter->likes()->toggle($data);

        return $like;
    }

    public function storeLike(Request $request){
        $data = $request->validate([
            'work_type'=>'required',
            'work_id'=>'required',
        ]);

        $userId = auth()->user()->id;
        $data['user_id'] = $userId;
        $likes = null;
        if($request->work_type == 'chapter'){
            $likes = $this->storeChapterLike($data);
        }

        return response([
            'hearts'=>$likes, 
            'result'=>200
        ], 200);
    }
}
