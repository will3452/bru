<?php

namespace App\Http\Controllers;

use App\Book;
use App\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreChapterRequest;
use App\Http\Requests\StoreNovelFormRequest;

class ChapterController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Book $book){
        return view('chapters.index', compact('book'));
    }

    public function create(Book $book){
        if($book->category == 'Series'){
            $selection_books = auth()->user()->books()->where('series_id',null)->where('id','!=',$book->id)->get();
            return view('chapters.series_create', compact(['book', 'selection_books']));
        }
        if($book->category == 'Novel' || $book->category == 'Anthology'){
            return view('chapters.novel_create', compact('book'));
        }else{
            return view('chapters.create', compact('book'));
        }
    }

    public function storeNovel(StoreNovelFormRequest $request,Book $book){
        // dd($request->validated());
        $chapter = $book->chapters()->create($request->validated());

        if($request->has('art') || $request->has('cpy')){
            $chapter->cpy()->create();
        }
        return redirect()->route('books.show', $book)->withSuccess('Chapter Added');
    }
    
    public function storeSeries(Book $book){
        request()->validate([
            'books.*' => ''
        ]);
        Book::whereIn('id', request()->books)->update(['series_id'=>$book->id]);
        
        return redirect()->route('books.show', $book)->withSuccess('Done');
    }

    public function store (StoreChapterRequest $request, Book $book){
        $chapter = $book->chapters()->create($request->validated());
        $chapter->cpy()->create();
        return redirect()->route('books.show', $book)->withSuccess('Done');
    }

    public function  removeSeries(Book $book, Book $b1){
        $b1->series_id = null;
        $b1->save();
        return back()->withSuccess('Remove Done!');
    }

    public function removeNovel(Book $book, Chapter $chapter){
        Storage::delete($chapter->opath);
        $chapter->delete();
        return back()->withSuccess('Done');
    }

    public function destroy(Book $book, Chapter $chapter){
        Storage::delete($chapter->opath);
        Storage::delete($chapter->ocontent);
        $chapter->delete();
        return back()->withSuccess('Done');
    }


}
