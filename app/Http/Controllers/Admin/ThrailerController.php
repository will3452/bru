<?php

namespace App\Http\Controllers\Admin;

use App\Thrailer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ThrailerController extends Controller
{
    public function __construct(){
        return $this->middleware(['auth:admin', 'checkrole:trailer']);
    }
    public function index(){
        $thrailers = Thrailer::get();
        return view('admin.thrailers.index', compact('thrailers'));
    }
}
