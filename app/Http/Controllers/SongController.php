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
            'desc'=>'',
            'credits'=>'',
            'associated_type'=>'',
            'book_id'=>'',
            'group_id'=>'',
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
        $validated['description'] = $validated['desc'];
        unset($validated['desc']);
        $validated['cpy'] = now();
        $pathCover = $request->cover->store('/public/book_cover');

        $arr_cover = explode('/', $pathCover);
        $end_arr_cover = end($arr_cover);
        $validated['cover'] = '/storage/book_cover/'.$end_arr_cover;

        $song = auth()->user()->songs()->create($validated);
        return redirect(route('songs.index').'?id='.$song->id);
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
            'genre'=>'required',
            'artist'=>'required',
            'desc'=>'',
            'credits'=>'',
            'associated_type'=>'',
            'book_id'=>'',
            'group_id'=>'',
            'audio_id'=>'',
            'art_id'=>'',
            'thrailer_id'=>'',
            'cost_type'=>'required',
            'copyright'=>'',
        ]);
        $validated['description'] = $validated['desc'];
        unset($validated['desc']);
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
