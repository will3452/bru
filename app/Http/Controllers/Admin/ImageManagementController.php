<?php

namespace App\Http\Controllers\Admin;

use App\Announcement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageManagementController extends Controller
{
    
    public function index(){
        return view('admin.images.menu');
    }

    public function announcementInMarquee(){
        $announcements = Announcement::get();
        return view('admin.images.announcement', compact('announcements'));
    }

    public function storeAnnouncementInMarquee(){
        $data = request()->validate([
            'content'=>'required'
        ]);

        Announcement::create($data);
        toast('Announcement added!');
        return redirect(route('admin.images.announcement'));
    }

    public function removeAnnouncement($id){
        Announcement::findOrFail($id)->delete();
        toast('Announcement removed');
        return redirect(route('admin.images.announcement'));
    }


    public function banner(){

    }

    public function storeBanner(){

    }

    public function preloader(){
        
    }

    public function storePreloader(){

    }

    public function newspaper(){


    }

    public function storeNewspaper(){

    }


    
}
