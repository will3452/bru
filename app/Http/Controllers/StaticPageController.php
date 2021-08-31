<?php

namespace App\Http\Controllers;

class StaticPageController extends Controller
{
    public function home()
    {
        return view('static.home');
    }

    public function contact()
    {
        return view('static.contact');
    }

     public function about()
    {
        return view('static.about');
    }
}
