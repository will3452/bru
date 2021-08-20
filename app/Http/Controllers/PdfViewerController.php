<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PdfViewerController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $url = $request->pdf ?? '';

        return view('pdftviewer', compact('url'));

    }
}
