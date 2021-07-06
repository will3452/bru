<?php

namespace App\Http\Controllers;

use App\Banner;
use Illuminate\Http\Request;

class ApiBannerController extends Controller
{
    public function index(){
        $banners = Banner::latest()->get();

        return response([
            'banners'=>$banners,
            'size'=>count($banners),
            'result'=>200
        ], 200);
        
    }
}
