<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiNewspaperController extends Controller
{
    public function newspaper(){
        $newspaper = Newspaper::with('pages')->get();
        return response([
            'newspaper'=>$newspaper,
            'result'=>200
        ], 200);
    }
}
