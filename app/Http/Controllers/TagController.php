<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Book;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function store(Book $book){
        // dd(request()->all());
        $rtag = request()->tag;
        if(request()->has('tag')){
            $tag_len = count(request()->tag) < (10 - $book->tags()->count()) ? count(request()->tag) : (10 - $book->tags()->count());
            for($i = 0; $i < $tag_len; $i++){
                $tags = Tag::where('name', $rtag[$i])->get();
                $isexist = $book->tags()->where('name',$rtag[$i])->get();
                if(count($isexist)){
                    continue;
                }
                if(!count($tags)){
                    $tag = Tag::create(['name'=>$rtag[$i]]);
                    $tag->books()->attach($book->id);
                }else {
                    $tags[0]->books()->attach($book->id);
                }
            }
        }

        return back()->withSuccess('Done');
    }

    // public function index(){
    //     return view('tags.index');
    // }
}
