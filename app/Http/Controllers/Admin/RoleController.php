<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');

    }
    public function index()
    {
        if(auth()->user()->type != 'super admin') abort(401);
        $roles = Role::get();
        return view('admin.role.index', compact('roles'));
    }
    
}
