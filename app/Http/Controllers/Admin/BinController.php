<?php

namespace App\Http\Controllers\Admin;

use App\Art;
use App\Audio;
use App\Book;
use App\Http\Controllers\Controller;
use App\Song;
use App\Thrailer;
use Illuminate\Http\Request;

class BinController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth:admin', 'checkrole:bin']);
    }
    public function index()
    {
        $type = 'book';
        if (request()->type == null || request()->type == 'books') {
            $books = Book::withTrashed()->whereNotNull('deleted_at')->get();
        } else if (request()->type == 'arts') {
            $type = 'art';
            $books = Art::withTrashed()->whereNotNull('deleted_at')->get();
        } else if (request()->type == 'trailers') {
            $type = 'trailer';
            $books = Thrailer::withTrashed()->whereNotNull('deleted_at')->get();
        } else if (request()->type == 'audio') {
            $type = 'audio';
            $books = Audio::withTrashed()->whereNotNull('deleted_at')->get();
            // return $books;
        } else if (request()->type == 'song') {
            $type = 'song';
            $books = Song::withTrashed()->whereNotNull('deleted_at')->get();
            // return $books;
        }
        // dd($books);
        return view('admin.bin.index', compact(['books', 'type']));
    }

    public function restore($id)
    {
        $type = request()->type ?? 'book';
        if ($type == 'art') {
            Art::withTrashed()->where('id', $id)->restore();
        } else if ($type == 'trailer') {
            Thrailer::withTrashed()->where('id', $id)->restore();
        } else if ($type == 'book') {
            Book::withTrashed()->where('id', $id)->restore();
        } else if ($type == 'audio') {
            Audio::withTrashed()->where('id', $id)->restore();
        } else if ($type == 'song') {
            Song::withTrashed()->where('id', $id)->restore();
        }
        toast(ucwords($type) . 'is restored!', 'success');
        return back();
    }
}
