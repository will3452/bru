<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminRoleController extends Controller
{
    public function update(Request $request, Admin $admin){
        $admin->roles()->toggle($request->id);
        return 1;
    }
}
