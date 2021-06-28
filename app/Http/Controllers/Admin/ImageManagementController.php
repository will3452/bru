<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use App\Bulletin;
use App\Newspaper;
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
        Bulletin::create($data);
        toast('Bulletin uploaded!', 'success');
        return back();
    }


    public function removeBulletin($id){
        $data = Bulletin::findOrFail($id);
        $data->delete();
        toast('Bulletin removed', 'success');
        return back();
    }

    public function newspaper(){
        $newspapers = Newspaper::get();
        return view('admin.images.newspaper', compact('newspapers'));
    }

    public function storeNewspaper(){
        $data = request()->validate([
            'name'=>'required'
        ]);

        Newspaper::create($data);
        toast('Newspaper added!', 'success');
        return back();
    }

    public function showNewspaper($id){
        $newspaper = Newspaper::findOrFail($id);
        return view('admin.images.show_newspaper', compact('newspaper'));
    }

    public function removeNewspaper(){
        $newspaper = Newspaper::findOrFail(request()->id);
        foreach($newspaper->pages as $page){
            $page->delete();
        }
        $newspaper->delete();
        toast('Newspaper removed!', 'success');
        return back();
    }

    public function storePageNewspaper($id){
        // dd($id);
        $newspaper = Newspaper::findOrFail($id);
        $data = request()->validate([
            'content'=>'required'
        ]);

        //storage image
        $path = $data['content']->store('/public/newspaper');
        $expPath = explode('/', $path);
        $endPath = end($expPath);
        $data['content'] = '/storage/newspaper/'.$endPath;
        $newspaper->pages()->create($data);
        toast('Page added!', 'success');
        return back();

    }

    public function removePageNewspaper($id){
        $newspaper = Newspaper::findOrFail($id);
        $data = request()->validate([
            'page_id'=>'required'
        ]);

        $newspaper->pages()->findOrFail($data['page_id'])->delete();
        toast('Page removed!', 'success');
        return back();
    }

    
}
