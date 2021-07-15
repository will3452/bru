<?php

namespace App\Http\Controllers;

use App\Book;
use App\User;
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

    public function show($id){
        // return $id;
        $book = Book::find($id);
        
        $userid = $book->user_id;

        $user = User::find($userid);
        
        $other = $user->books;

        return response([
            'author'=>$user,
            'book'=>$book,
            'other_works'=>$other,
            'is_in_collection'=>auth()->user()->isBookIsInTheBox($id),
            'result'=>200
        ], 200);

    }

    public function summary(){
        $a = Book::where('genre', 'Teen and Young Adult')->count();
        $b = Book::where('genre', 'New Adult')->count();
        $c = Book::where('genre', 'Romance')->count();
        $d = Book::where('genre', 'Detective and Mystery')->count();
        $e = Book::where('genre', 'Action')->count();
        $f = Book::where('genre', 'Historical')->count();
        $g = Book::where('genre', 'Thriller and Horror')->count();
        $h = Book::where('genre', 'LGBTQIA+')->count();
        $i = Book::where('genre', 'Poetry')->count();
        return response([
            'teen_and_young_adult'=>$a,
            'new_adult'=>$b,
            'romance'=>$c,
            'detective_and_mystery'=>$d,
            'action'=>$e,
            'historical'=>$f,
            'thriller_and_horror'=>$g,
            'lgbtqia'=>$h,
            'poetry'=>$i,
            'result'=>200
        ],200);
    }
}
