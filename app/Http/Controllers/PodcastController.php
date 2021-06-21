<?php

namespace App\Http\Controllers;

use App\Series;
use Illuminate\Http\Request;

class PodcastController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $podcasts = auth()->user()->podcasts;
        return view('podcast.index', compact('podcasts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('podcast.create');
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
            'title'=>'required',
            'part_of'=>'required',
            'type_of_work'=>'required',
            'host'=>'required',
            'desc'=>'required',
            'audio_desc'=>'required',
            'cpy'=>'required',
            'credits'=>'required',
            'episode_type'=>'required',
            'file'=>'required',
            'cover'=>'required',
            'cost'=>'',
            'group_id'=>'',
            'episode_number',
            'series_id'=>'',
        ]);
        // dd($data);
        $data['cpy'] = now();
        //storing the cover
        $path = $data['cover']->store('public/podcast_cover');
        $arr_path = explode('/', $path);
        $end_path = end($arr_path);
        $data['cover'] = '/storage/podcast_cover/'.$end_path;

        $podcast = auth()->user()->podcasts()->create($data);
        if($request->has('series_id')){
            Series::find($request->series_id)->podcasts()->attach($podcast->id);
        }

        toast('podcast created!', 'success');
        
        return redirect(route('podcast.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('podcast.show',  ['podcast'=>auth()->user()->podcasts()->findOrFail($id)]);
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
        //
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
