<?php

namespace App\Http\Controllers;

use App\Song;
use Illuminate\Http\Request;

class SongController extends Controller
{
    public function __construct(){
         $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     
    public function index()
    {
        $songs = auth()->user()->songs;
        return view('songs.index',compact('songs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('songs.create');        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'title'=>'required',
            'genre'=>'required',
            'artist'=>'required',
            'artist_others'=>'',
            'composer'=>'required',
            'composer_others'=>'',
            'lyricist'=>'required',
            'lyricist_others'=>'',
            'description'=>'',
            'credits'=>'',
            'associated_type'=>'',
            'book_id'=>'',
            'audio_id'=>'',
            'art_id'=>'',
            'thrailer_id'=>'',
            'cost_type'=>'required',
            'cost'=>'',
            'copyright'=>'',
            'cover'=>'',
            'file'=>'',
            'cpy'=>'',
        ]);

        $pathCover = $request->cover->store('/public/book_cover');
        $pathFile = $request->file->store('/public/songs');

        $arr_cover = explode('/', $pathCover);
        $end_arr_cover = end($arr_cover);
        $validated['cover'] = '/storage/book_cover/'.$end_arr_cover;

        $arr_file = explode('/', $pathFile);
        $end_arr_file = end($arr_file);
        $validated['file'] = '/storage/songs/'.$end_arr_file;

        auth()->user()->songs()->create($validated);
        return back()->withSuccess('Done!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $song = Song::find($id);
        return view('songs.show', compact('song'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $this->validate($request, [
            'title'=>'required',
            'genre'=>'required',
            'artist'=>'required',
            'artist_others'=>'',
            'composer'=>'required',
            'composer_others'=>'',
            'lyricist'=>'required',
            'lyricist_others'=>'',
            'description'=>'',
            'credits'=>'',
            'associated_type'=>'',
            'book_id'=>'',
            'audio_id'=>'',
            'art_id'=>'',
            'thrailer_id'=>'',
            'cost_type'=>'required',
            'cost'=>'',
            'copyright'=>'',
        ]);
        Song::find($id)->update($validated);

        return back()->withSuccess('Done!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Song::find($id)->delete();
        return redirect()->route('songs.index')->withSuccess('Done!');
    }
}
