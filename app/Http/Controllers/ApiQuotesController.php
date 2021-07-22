<?php

namespace App\Http\Controllers;

use App\Book;
use App\Quote;
use Illuminate\Http\Request;

class ApiQuotesController extends Controller
{
    public function extractImage(Request $request){
        $data  = $request->validate([
            'bg_code'=>'required',
            'message'=>'required',
            'book_id'=>'required',
            'chapter_id'=>'required'
        ]);

        $data['user_id'] = auth()->user()->id;
        $data['author'] = Book::find($data['book_id'])->author;

        $quote = Quote::create($data);

        return response([
            'quote'=>$quote,
            'result'=>200
        ], 200);
    }

    public function allQuotes(){
        $quotes = Quote::where('user_id', auth()->user()->id)->get();
        return response([
            'quotes'=>$quotes,
            'size'=>count($quotes ?? []),
            'result'=>200
        ],200);
    }

    public function getQuote($id){
        $quote = Quote::find($id);
        return response([
            'quote'=>$quote,
            'result'=>200
        ], 200);
    }
}
