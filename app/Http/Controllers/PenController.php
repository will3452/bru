<?php

namespace App\Http\Controllers;

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
}
