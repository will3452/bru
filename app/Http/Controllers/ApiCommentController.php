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
            $comments = Chapter::find($request->work_id) ? Chapter::find($request->work_id)->comments()->with('user')->latest()->get():null;
        }
        
        return response([
            'hearts'=>12, //dummy
            'comments'=>$comments,
            'size'=>count($comments ?? []),
            'result'=>200
        ], 200);
    }

    public function storeChapterComment($data){
        $chapter = Chapter::find($data['work_id']);
        $data = $this->sanitize($data);

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
