<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin', 'checkrole:dashboard']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::count();

        $widget = [
            'users' => $users,
            //...
        ];

        return view('admin.home', compact('widget'));
    }
}
