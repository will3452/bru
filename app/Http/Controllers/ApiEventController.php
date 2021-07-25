<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class ApiEventController extends Controller
{
    public function index(){
        $events = Event::get();
    return response([
            'events'=>$events, 
            'result'=>200
        ], 200); 
    }

    public function show($id){
        $event = Event::find($id);
        return response([
            'event'=>$event, 
            'result'=>200
        ], 200);
    }
}
