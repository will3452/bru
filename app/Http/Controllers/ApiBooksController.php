<?php

namespace App\Http\Controllers;

use App\PublishedBook;
use Illuminate\Http\Request;

class ApiBooksController extends Controller
{
    public function index()
    {
        if (request()->has('_limit')) {
            $books = PublishedBook::limit(request()->_limit)->get();
        } else {
            $books = PublishedBook::get();
        }

        return response($books, 200);
    }

    public function show($id)
    {
        $book = PublishedBook::find($id);

        if (!$book) {
            return response([
                'message'=>'not found'
            ]);
        }

        return response($book, 200);
    }
}
