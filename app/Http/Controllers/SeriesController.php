<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('series.create');
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
            'cpy'=>'required'
        ]);
        if(!in_array($data['type'], ['book', 'audio book', 'podcast', 'film'])){
            return back()->withError('Invalid!');
        }

        //storing the  book cover
        $path = $data['cover']->store('/public/series_cover');
        $expPath = explode('/', $path);
        $endPath = end($expPath);
        $data['cover'] = '/storage/series_cover/'.$endPath;


        //saving the data
        $series =  auth()->user()->series()->create($data);
        return redirect()->route('series.show', $series)->withSuccess('Series created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $series = auth()->user()->series()->findOrFail($id);
        return view('series.show', compact('series'));
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
