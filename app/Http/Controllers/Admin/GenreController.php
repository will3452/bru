<?php

namespace App\Http\Controllers\Admin;

use App\Genre;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GenreController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin', 'checkrole:genre']);
    }
    public function list(){
        $genres = Genre::get();
        return view('admin.genres.list', compact('genres'));
    }

    public function show(Genre $genre){
        return view('admin.genres.show', compact('genre'));
    }

    public function update(Genre $genre){
        $validated = request()->validate([
            'name'=>'',
            'icon'=>'',
            'description'=>'',
            'heat'=>'',
            'violence'=>'',
            'age_restriction'=>'',
        ]);
        if(request()->violence) $validated['violence'] = implode('_', $validated['violence']);
        else $validated['violence'] = null;
        if(request()->heat) $validated['heat'] = implode('_', $validated['heat']);
        else $validated['heat'] = null;

        if(request()->age_restriction){
            $validated['heat'] = null;
            $validated['violence'] = null;
        }else {
            $validated['age_restriction'] = null;
        }
        $genre->update($validated);
        return back()->withSuccess('Updated!');
    }

    public function guard(){
        return Auth::guard('admin');
    }
}
