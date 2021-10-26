<?php

namespace App\Http\Controllers;

use App\Book;
use App\Quote;
use App\QuoteDiary;
use Illuminate\Http\Request;

class ApiQuotesController extends Controller
{
    public function extractImage(Request $request)
    {
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

    public function saveTodiary(Request $request)
    {
        $request->validate([
            'bg_code'=>'required',
            'message'=>'required',
            'book_id'=>'required',
            'chapter_id'=>'required'
        ]);

        $data['user_id'] = auth()->user()->id;
        $data['author'] = Book::find($data['book_id'])->author;

        $quote = Quote::create($data);

        QuoteDiary::crate([
            'user_id'=>auth()->user()->id,
            'quote_id'=>$quote->id,
        ]);

        return response([
            'result'=>'ok',
        ], 200);
    }

    public function allQuotes()
    {
        $quotes = Quote::with('book')->where('user_id', auth()->user()->id)->get();
        return response([
            'quotes'=>$quotes,
            'size'=>count($quotes ?? []),
            'result'=>200
        ], 200);
    }

    public function getQuote($id)
    {
        $quote = Quote::find($id);
        return response([
            'quote'=>$quote,
            'result'=>200
        ], 200);
    }
}
