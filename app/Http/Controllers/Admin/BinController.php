<?php

namespace App\Http\Controllers\Admin;

use App\Art;
use App\Book;
use App\Thrailer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BinController extends Controller
{
    public function __construct(){
        return $this->middleware(['auth:admin', 'checkrole:bin']);
    }
    public function index(){
        $type = 'book';
        if(request()->type == null || request()->type =='books'){
            $books = Book::withTrashed()->whereNotNull('deleted_at')->get();
        }else if(request()->type == 'arts'){
            $type = 'art';
            $books = Art::withTrashed()->whereNotNull('deleted_at')->get();
        }else if(request()->type == 'trailers'){
            $type = 'trailer';
            $books = Thrailer::withTrashed()->whereNotNull('deleted_at')->get();
        }
        // dd($books);
        return view('admin.bin.index', compact(['books','type']));
    }

    public function restore($id){
        Book::withTrashed()->where('id', $id)->restore();

        return back()->withSuccess('Book restored!');
    }
}
