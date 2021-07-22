<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class ApiBookPreviewController extends Controller
{
    public function show($id){
        $book = Book::find($id);
        $chapters = $book->chapters()->paginate(1);
        return response([
            'chapters'=>$chapters,
            'book_title'=>$book->title,
            'book_author'=>$book->author,
            'result'=>200
        ],200);
    }
}
