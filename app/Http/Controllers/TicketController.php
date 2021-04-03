<?php

namespace App\Http\Controllers;

use App\Art;
use App\Book;
use App\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TicketController extends Controller
{
    public function correctPassword($password){
        return Hash::check($password, auth()->user()->password);
    }

    public function __construct(){
        $this->middleware('auth');
    }

    // books

    public function bookDestroy(Book $book){
        if(!$this->correctPassword(request()->password)) return 2;
        $book->tickets()->create([
            'reason'=>request()->reason,
            'delete'=>now(),
            'user_id'=>auth()->user()->id
        ]);

        return 1;
    }
    public function bookUpdate(Book $book){
        if(!$this->correctPassword(request()->password)) return 2;
        $validated = request()->validate([
            'reason'=>'',
            'title'=>'',
            'cost'=>''
        ]);
        $validated['user_id'] = auth()->user()->id;
        $book->tickets()->create($validated);
        return 1;
    }

    // arts
    public function artDestroy(Art $art){
        if(!$this->correctPassword(request()->password)) return 2;
        $art->tickets()->create([
            'reason'=>request()->reason,
            'delete'=>now(),
            'user_id'=>auth()->user()->id
        ]);

        return 1;
    }
    public function artUpdate(Art $art){
        if(!$this->correctPassword(request()->password)) return 2;
        $validated = request()->validate([
            'reason'=>'',
            'title'=>'',
            'cost'=>''
        ]);
        $validated['user_id'] = auth()->user()->id;
        $art->tickets()->create($validated);
        return 1;
    }

    //chapter
    public function chapterDestroy(Chapter $chapter){
        if(!$this->correctPassword(request()->password)) return 2;
        $chapter->tickets()->create([
            'reason'=>request()->reason,
            'delete'=>now(),
            'user_id'=>auth()->user()->id
        ]);

        return 1;
    }
    public function chapterUpdate(Chapter $Chapter){
        if(!$this->correctPassword(request()->password)) return 2;
        $validated = request()->validate([
            'reason'=>'',
            'title'=>'',
            'cost'=>''
        ]);
        $validated['user_id'] = auth()->user()->id;
        $Chapter->tickets()->create($validated);
        return 1;
    }
}
