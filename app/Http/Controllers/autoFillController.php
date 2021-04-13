<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class autoFillController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return auth()->user()->books()->where('title','LIKE',"%".$request->title."%")->first() ?? [];
    }
}
