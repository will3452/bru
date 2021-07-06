<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class ApiLibraryController extends Controller
{
    public function index(){
        // return request()->all();
        request()->validate([
            'genre'=>'required'
        ]);
        
        if(request()->has('_limit')){
            $books = Book::where('genre', request()->genre)->limit(request()->_limit)->get();
        }else {
            $books = Book::where('genre', request()->genre)->get();
        }
        return response([
            'books'=>$books,
            'size'=>count($books),
            'result'=>200
        ], 200);
    }
}
