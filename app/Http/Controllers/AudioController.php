<?php

namespace App\Http\Controllers;

use App\Audio;
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
        // xx = book --> for security
        if(request()->has('xx')){
            $book = auth()->user()->books()->find(request()->xx);
            return view('audio.create', compact('book'));
        }

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
        $validated['cpy'] = now();

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
        $audio = Audio::findOrFail($id);
        return view('audio.show', compact('audio'));
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
        $validated = $this->validate($request, [
            'title'=>'required',
            'language'=>'required',
            'cost'=>'',
            'lead_character'=>'required',
            'lead_college'=>'required',
            'review_question_1'=>'required',
            'review_question_2'=>'required',
            'credit_page'=>'required',
            'blurb'=>'required',
        ]);

        Audio::findOrFail($id)->update($validated);
        return  back()->withSuccess('Done!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Audio::findOrFail($id)->delete();
        return redirect()->route('audio.index')->withSuccess('Done!');
    }
}
