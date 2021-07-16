<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MarketingController extends Controller
{
    public function createMarketing(){
        return view('marketing.create');
    }

    public function index(){    
        return 'Under maintenance';
    }
}
