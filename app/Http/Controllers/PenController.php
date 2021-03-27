<?php

namespace App\Http\Controllers;

use App\Pen;
use Illuminate\Http\Request;

class PenController extends Controller
{
    public function store(){
        $validated = request()->validate([
            'name'=>'required',
            'gender'=>'required',
            'country'=>'required'
        ]);

        auth()->user()->pens()->create($validated);
        return back()->withSuccess('Done!');
    }

    public function destroy($id){
        $pen = Pen::find($id);
        $pen->delete();
        return back()->withSuccess('Done!');
    }
}
