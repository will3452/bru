<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PleaseContactController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $msg = $request->msg;
        return view('pleasecontact', compact('msg'));
    }
}
