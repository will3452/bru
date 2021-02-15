<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AudioForm;

class AudioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = auth()->user()->audio()->get();
        return view('audio.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('audio.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AudioForm $request)
    {
        $validated = $request->validated();

        $path = $validated['audio']->store('public/audios');
        $arr_path = explode('/', $path);
        $end_path = end($arr_path);
        $validated['audio'] = '/storage/audios/'.$end_path;

        if(request()->has('free_art')){
            $path = request()->free_art->store('public/free_arts');
            $arr_path = explode('/', $path);
            $end_path = end($arr_path);
            $validated['free_art'] = '/storage/free_arts/'.$end_path;
        }
        $audio = auth()->user()->audio()->create($validated);

        $audio->cpy()->create();
        
        return back()->withSuccess('Done! Audio book added!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
