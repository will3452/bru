<?php

namespace App\Http\Controllers;

use App\Audio;
use Illuminate\Support\Str;
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
        $code = Str::random(8);
        $validated['code'] = $code;
        $validated['cpy'] = now();
        if(request()->has('free_art')){
            $path = request()->free_art->store('public/free_arts');
            $arr_path = explode('/', $path);
            $end_path = end($arr_path);
            $validated['free_art'] = '/storage/free_arts/'.$end_path;
        }
        $audio = auth()->user()->audio()->create($validated);

        
        return redirect(route('audio.index').'?id='.$audio->id);

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
    public function update(Request $request, Audio $audio)
    {
        $validated = $this->validate($request, [
            "code"=>'required',
        ]);

        if($validated['code'] == $audio->code){
            if(empty($audio->approved)){
                $audio->approved = date("Y/m/d");
            }
            $audio->save();
        }else {
            return back()->withErrors('Invalid Code, please contact the Adminstrator');
        }

        return back()->with('success', 'Item updated successfully');
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

    public function updateSome(Audio $audio){
        $validated = request()->validate([
            'language'=>'',
            'gender'=>'',
            'lead_character'=>'',
            'lead_college'=>'',
            'blurb'=>'',
            'review_question_1'=>'',
            'review_question_2'=>'',
            'credit_page'=>'',
            'publish_date'=>''
        ]);
        $audio->update($validated);

        return back()->withSuccess('Done!');

    }
}
