<?php

namespace App\Http\Controllers;

use App\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
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
        $collections = auth()->user()->collections()->get();
        return view('collections.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('collections.create');
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
            'type_of_work'=>'required',
            'title'=>'required',
            'desc'=>'required',
            'credits'=>'required',
            'cover'=>'required',
            'cpy'=>'required'
        ]);

        unset($data['cpy']);
        
        //storing the  book cover
        $path = $data['cover']->store('/public/collection_cover');
        $expPath = explode('/', $path);
        $endPath = end($expPath);
        $data['cover'] = '/storage/collection_cover/'.$endPath;

        $collection = auth()->user()->collections()->create($data);
        return redirect()->route('collections.show', $collection)->withSuccess('Collection created!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $collection = Collection::findOrFail($id);
        return view('collections.show', compact('collection'));

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
        $collection = auth()->user()->collections()->findOrFail($id);

        $request->validate([
            'work_id'=>'required',
            'type'=>'required'
        ]);

        switch($request->type){
            case 'book':
                $collection->books()->toggle($request->work_id);
                break;
            case 'audio book':
                $collection->audios()->toggle($request->work_id);
                break;
            case 'art':
                $collection->arts()->toggle($request->work_id);
                break;
            case 'film':
                $collection->films()->toggle($request->work_id);
                break;
            case 'song':
                $collection->songs()->toggle($request->work_id);
                break;
            case 'podcast':
                $collection->podcasts()->toggle($request->work_id);
                break;
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
