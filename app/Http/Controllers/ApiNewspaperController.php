<?php

namespace App\Http\Controllers;

use App\Newspaper;

class ApiNewspaperController extends Controller
{
    public function index()
    {
        $newspaper = Newspaper::with('pages')->get();
        return response([
            'newspaper' => $newspaper,
            'result' => 200,
        ], 200);
    }
}
