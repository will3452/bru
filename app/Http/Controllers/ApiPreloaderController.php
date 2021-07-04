<?php

namespace App\Http\Controllers;

use App\Preloader;
use Illuminate\Http\Request;

class ApiPreloaderController extends Controller
{
    public function random(){
        
        $preloader = Preloader::inRandomOrder()->first();

        return response([
            'preloader'=>$preloader
        ], 200);

    }
}
