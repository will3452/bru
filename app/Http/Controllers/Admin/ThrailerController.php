<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Thrailer;

class ThrailerController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth:admin', 'checkrole:trailer']);
    }
    public function index()
    {
        $thrailers = Thrailer::get();
        return view('admin.thrailers.index', compact('thrailers'));
    }

    public function approve($id)
    {
        Thrailer::find($id)->update(['approved' => now()]);
        toast('Work Approved!', 'success');
        return back();
    }
}
