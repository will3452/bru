<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BookViewerController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Book $book)
    {
        $pages = $book->chapters()->orderBy('sq')->simplePaginate(1);
        return view('books.viewer', compact('book', 'pages'));
    }
}
