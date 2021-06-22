<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeriesController extends Controller
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
        $series = auth()->user()->series;
        return view('series.index', compact('series'));
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
            toast('something is wrong', 'error');
            return back();
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
        $series = Series::findOrFail($id);
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
        $series = auth()->user()->series()->findOrFail($id);

        $request->validate([
            'work_id'=>'required',
        ]);

        if($series->type == 'book'){
            $series->books()->toggle($request->work_id);
        }

        if($series->type == 'audio book'){
            $series->audios()->toggle($request->work_id);
        }

        if($series->type == 'film'){
            $series->films()->toggle($request->work_id);
        }

        if($series->type == 'podcast'){
            $series->podcasts()->toggle($request->work_id);
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
