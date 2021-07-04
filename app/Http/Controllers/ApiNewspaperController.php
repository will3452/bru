<?php

namespace App\Http\Controllers;

use App\Newspaper;
use Illuminate\Http\Request;

class ApiNewspaperController extends Controller
{
    public function index(){
        $newspaper = Newspaper::with('pages')->get();
        return response([
            'newspaper'=>$newspaper,
            'result'=>200
        ], 200);
    }
}
