<?php

namespace App\Http\Controllers;

use App\Bulletin;
use Illuminate\Http\Request;

class ApiBulletinController extends Controller
{
    public function index(){
        return Bulletin::get();
    }


    public function show($id){
        return Bulletin::findOrFail($id);
    }
}
