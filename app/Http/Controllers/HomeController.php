<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $widget = [
            'users' => [],
            //...
        ];

        if(auth()->user()->disabled != null){
            auth()->logout();
            return back();
        }

        return view('home', compact('widget'));
    }
}
