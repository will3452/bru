<?php

namespace App\Http\Controllers;

use App\Pen;
use Illuminate\Http\Request;

class PenController extends Controller
{
    public function store(){
        $validated = request()->validate([
            'picture'=>'required',
            'name'=>'required',
            'gender'=>'required',
            'country'=>'required'
        ]);
        $validated['picture'] = $validated['picture']->store('public/pen');
        $path = explode('/', $validated['picture']);
        $end_path = end($path);
        $validated['picture'] = '/storage/pen/'.$end_path;
        auth()->user()->pens()->create($validated);
        return back()->withSuccess('Done!');
    }

    public function destroy($id){
        $pen = Pen::find($id);
        $pen->delete();
        return back()->withSuccess('Done!');
    }

    public function updatePicture(){
        request()->validate([
            'picture'=>'required',
            'pen_id'=>'required'
        ]);

        $pen = Pen::find(request()->pen_id);
        $picture = request()->picture->store('public/pen');
        $path = explode('/', $picture);
        $end_path = end($path);
        $picture = '/storage/pen/'.$end_path;
        $pen->picture = $picture;
        $pen->save();
        return back()->withSuccess('Done!');
    }
}
