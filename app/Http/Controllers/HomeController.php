<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
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

        if (auth()->user()->disabled != null) {
            auth()->logout();
            return back();
        }

        if (auth()->user()->role == 'student') {
            Auth::logout();
        }

        return view('home', compact('widget'));
    }
}
