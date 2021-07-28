<?php

namespace App\Http\Controllers;

use App\Book;
use App\User;
use Illuminate\Http\Request;

class ApiBookPreviewController extends Controller
{
    public function show($id){
        $book = Book::find($id);
        $user = User::find(auth()->user()->id);

        if(!$user->isBookIsInTheBox($book->id)){
            $chapters = $book->chapters()->limit(1)->paginate(1);
            return response([
                'chapters'=>$chapters,
                'book_title'=>$book->title,
                'book_author'=>$book->author,
                'result'=>200
            ],200);
        }

        $chapters = $book->chapters()->paginate(1);
        return response([
            'chapters'=>$chapters,
            'book_title'=>$book->title,
            'book_author'=>$book->author,
            'result'=>200
        ],200);
    }

    public function getQuestionFeedbacks($id){
        $book = Book::find($id);
        return response([
            'review_question_1'=>$book->review_question_1,
            'review_question_2'=>$book->review_question_2,
            'result'=>200
        ], 200);
    }
}
