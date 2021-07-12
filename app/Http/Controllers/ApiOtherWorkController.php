<?php

namespace App\Http\Controllers;

use App\Art;
use App\Book;
use Illuminate\Http\Request;

class ApiOtherWorkController extends Controller
{
    public function getWorks(Request $request){
        $request->validate([
            'work_type'=>'required',
            'work_id'=>'required'
        ]);
        return 1;

        $others = [];

        if($request->work_type == 'art'){

            $art = Art::find($request->work_id);
            $author = $art->user;
            $others = $author->arts()->where('id', '!=', $art->id)->get();
            
        }else if($request->work_type == 'book'){
            $book = Book::find($request->work_id);
            $author = $book->user;
            $others = $author->books()->where('id', '!=', $book->id)->get();
        }

        return response([
            'work'=>$others, 
            'work_size'=>count($others ?? []),
            'result'=>200
        ], 200);
    }
}
