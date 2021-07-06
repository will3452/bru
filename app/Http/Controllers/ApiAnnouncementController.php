<?php

namespace App\Http\Controllers;

use App\Announcement;
use Illuminate\Http\Request;

class ApiAnnouncementController extends Controller
{
    public function index(){
        $announcements = Announcement::latest()->get();
        return response([
            'announcements'=>$announcements,
            'size'=>count($announcements),
            'result'=>200
        ], 200);
    }
}
