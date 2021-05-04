<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Book;
use Illuminate\Http\Request;
use App\Http\Requests\BookForms;
use Illuminate\Support\Facades\Hash;

class BookController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        return view('books.index');
    }

    public function store(BookForms $request){
        // dd($request->tag);
        $rtag = $request->tag;
        
        $validated = $request->validated();
        $validated['cpy'] = now();
        unset($validated['tag']);
        $book = auth()->user()->books()->create($validated);
        

        //attaching tags
        if($request->has('tag')){
            $tag_len = count($request->tag) < 10 ? count($request->tag) : 10;
            for($i = 0; $i < $tag_len; $i++){
                $tags = Tag::where('name', $rtag[$i])->get();
                if(!count($tags)){
                    $tag = Tag::create(['name'=>$rtag[$i]]);
                    $tag->books()->attach($book->id);
                }else {
                    $tags[0]->books()->attach($book->id);
                }
            }
        }

        return redirect(route('books.list').'?id='.$book->id);
    }
    

    public function create(){
        return view('books.create');
    }

    public function list(){
        if(request()->has('filter')){
            if(request()->filter == 'all'){
                $books = auth()->user()->books;
            }else if(request()->filter == 'published'){
                $books = auth()->user()->books()->whereNotNull('publish_date')->get();
            }else if(request()->filter == 'not-yet'){
                $books = auth()->user()->books()->whereNull('publish_date')->get();
            }
        }else {
            $books = auth()->user()->books;
        }

        return view('books.list', compact('books'));
    }

    public function show(Book $book){
        return view('books.show', compact('book'));
    }

    public function update(Book $book){
        $validated = request()->validate([
            'category'=>'',
            'genre'=>'',
            'type'=>'',
            'language'=>'',
            'lead_character'=>'',
            'lead_college'=>'',
            'blurb'=>'',
            'review_question_1'=>'',
            'review_question_2'=>'',
            'credit_page'=>'',
            'publish_date'=>''
        ]);

        $d = $book->update($validated);
        return redirect(route('home'))->withSuccess('Save Changed!');
    }

    public function destroy(Book $book){
        
        if(!Hash::check(request()->password, auth()->user()->password)){
            return abort(401);
        } else {
            if(request()->has('reason_delete')) {
                $book->reason_delete = request()->reason_delete;
                $book->save();
            }
            $book->delete();
            return redirect()->route('books.list');
        }
    }


    public function updateFront(Book $book){
        request()->validate([
            'front'=>'required'
        ]);

        $path = request()->front->store('public/fronts');
        $arr_path = explode('/', $path);
        $end_path = end($arr_path);
        $front = '/storage/fronts/'.$end_path;
        $book->front = $front;
        $book->save();
        return redirect()->route('books.show', $book)->withSuccess('Done!');
    }
}
