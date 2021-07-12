<?php

namespace App\Http\Controllers;

use App\Chapter;
use Illuminate\Http\Request;

class ApiCommentController extends Controller
{

    public function sanitize($data){
        unset($data['work_type']);
        unset($data['work_id']);
        return $data;
    }


    public function getComments(Request $request){
        $request->validate([
            'work_type'=>'required',
            'work_id'=>'required'
        ]);

        $comments = [];

        if($request->work_type == 'chapter'){
            $comments = Chapter::find($request->work_id)->comments()->latest()->limit(3)->get();
        }

        return response([
            'comments'=>$comments,
            'size'=>count($comments),
            'result'=>200
        ], 200);
    }

    public function storeChapterComment($data){
        $data = $this->sanitize($data);
        $chapter = Chapter::find($id);

        $comment = $chapter->comments()->create($data);

        return $comment;
    }

    public function storeComment(Request $request){
        $data = $request->validate([
            'work_type'=>'required',
            'work_id'=>'required',
            'message'=>'required',
            'reply_to'=>''
        ]);

        $userId = auth()->user()->id;
        $data['user_id'] = $userId;
        $comment = null;
        if($request->work_type == 'chapter'){
            $comment = $this->storeChapterComment($data);
        }


        return response([
            'comment'=>$comment, 
            'result'=>200
        ], 200);
    }
}
