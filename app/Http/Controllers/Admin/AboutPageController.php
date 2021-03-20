<?php

namespace App\Http\Controllers\Admin;

use App\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        return $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin.about');
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'content'=>'required'
        ]);

        $about = About::find(1);
        if($request->has('art')){

            $path = $request->art->store('public/art_page');
            $path_arr = explode('/', $path);
            $end_path = end($path_arr);
            $art = '/storage/art_page/'.$end_path;
            $about->art = $art;
        }
        
        $about->content = $request->content;
        $about->save();
        return back()->withSuccess('Done!');
    }

    
}
