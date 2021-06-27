<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use App\Bulletin;
use App\Preloader;
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
        $banners = Banner::get();
        return view('admin.images.banners', compact('banners'));
    }

    public function storeBanner(){
        $data = request()->validate([
            'image'=>'required'
        ]);

        //storage iamge
         $path = $data['image']->store('/public/banner');
         $expPath = explode('/', $path);
         $endPath = end($expPath);
         $data['image'] = '/storage/banner/'.$endPath;
        Banner::create($data);
        toast('Banner uploaded!', 'success');
        return back();
    }

    public function removeBanner($id){
        $data = Banner::findOrFail($id);
        $data->delete();
        toast('banner removed', 'success');
        return back();
    }

    public function preloaders(){
        $preloaders = Preloader::get();
        return view('admin.images.preloader', compact('preloaders'));
    }

    public function storePreloader(){
        $data = request()->validate([
            'image'=>'required'

        ]);

        //storage iamge
        $path = $data['image']->store('/public/banner');
        $expPath = explode('/', $path);
        $endPath = end($expPath);
        $data['image'] = '/storage/banner/'.$endPath;
        Preloader::create($data);
        toast('Preloader uploaded!', 'success');
        return back();

    }

    public function removePreloader($id){
        $data = Preloader::findOrFail($id);
        $data->delete();
        toast('preloader removed', 'success');
        return back();
    }

    public function bulletin(){
        $bulletins = Bulletin::get();
        return view('admin.images.bulletin', compact('bulletins'));
    }

    public function storeBulletin(){
        $data = request()->validate([
            'image'=>'required',
            'name'=>'required'
        ]);

        //storage iamge
        $path = $data['image']->store('/public/banner');
        $expPath = explode('/', $path);
        $endPath = end($expPath);
        $data['image'] = '/storage/banner/'.$endPath;
        Preloader::create($data);
        toast('Preloader uploaded!', 'success');
        return back();
    }

    public function newspaper(){


    }

    public function storeNewspaper(){

    }


    
}
