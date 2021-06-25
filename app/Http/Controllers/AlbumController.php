<?php

namespace App\Http\Controllers;

use App\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums = auth()->user()->albums;
        return view('albums.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('albums.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'type'=>'required',
            'type_of_work'=>'required',
            'title'=>'required',
            'desc'=>'required',
            'credits'=>'required',
            'cover'=>'required',
            'cpy'=>'required',
            'group_id'=>""
        ]);
        if(!in_array($data['type'], ['song', 'art'])){
            toast('something is wrong', 'error');
            return back();
        }

        //storing the  book cover
        $path = $data['cover']->store('/public/album_cover');
        $expPath = explode('/', $path);
        $endPath = end($expPath);
        $data['cover'] = '/storage/album_cover/'.$endPath;

        $album = auth()->user()->albums()->create($data);
        return redirect()->route('albums.show', $album)->withSuccess('Album created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $album = Album::findOrFail($id);
        return view('albums.show', compact('album'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $album = auth()->user()->albums()->findOrFail($id);

        $request->validate([
            'work_id'=>'required',
        ]);
        
        if($album->type == 'song'){
            $album->songs()->toggle($request->work_id);
        }
        if($album->type == 'art'){
            $album->arts()->toggle($request->work_id);
        }

        toast('Done', 'success');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
