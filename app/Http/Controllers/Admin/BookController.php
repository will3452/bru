<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use Illuminate\Http\Request;
use App\Notifications\BookUpdates;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;

class BookController extends Controller
{
    public function __construct(){
        $this->middleware(['auth:admin', 'checkrole:book']);
    }
    public function list(){
        $books = Book::get();
        return view('admin.books.list', compact('books'));
    }

    public function show(Book $book){
        return view('admin.books.show', compact('book'));
    }

    public function update(Book $book){
        $validated = request()->validate([
            'changed'=>'required',
            'category'=>'',
            'title'=>'',
            'genre'=>'',
            'type'=>'',
            'language'=>'',
            'lead_character'=>'',
            'lead_college'=>'',
            'blurb'=>'',
            'cost'=>'',
            'review_question_1'=>'',
            'review_question_2'=>'',
            'credit_page'=>'',
            'publish_date'=>''
        ]);
        unset($validated['changed']);
        $d = $book->update($validated);
        // Notification::send($book->user, new BookUpdates($book));
        return back()->withSuccess('Save Changed!');
    }
}
