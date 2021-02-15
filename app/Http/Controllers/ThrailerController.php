<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Thrailer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Notifications\VideoApproval;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;

class ThrailerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $thrailers = auth()->user()->thrailers()->get();

        return view('thrailers.index', compact('thrailers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('thrailers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            "title" => "required",
            "cost" => "required",
            "cpy" => "required",
            "gem" => "required",
            "author" => "required",
            "video" => "required"
        ]);

        $path = request()->video->store('/public/thrailers');
        $arr_path = explode('/', $path);
        $end_path = end($arr_path);
        $validated['video'] = '/storage/thrailers/'.$end_path;

        $video = auth()->user()->thrailers()->create($validated);
        $video->code = Str::random(8);
        $video->save();
        $video->cpy()->create();
        Notification::send(Admin::get(), new VideoApproval($video));
        return back()->with('success', 'item stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Thrailer $thrailer
     * @return \Illuminate\Http\Response
     */
    public function show(Thrailer $thrailer)
    {
        return view('thrailers.show', compact('thrailer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thrailer $thrailer
     * @return \Illuminate\Http\Response
     */
    public function edit(Thrailer $thrailer)
    {
        return view('thrailers.edit', compact('thrailer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Thrailer $thrailer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thrailer $thrailer)
    {
        $validated = $this->validate($request, [
            "title" => "required",
            "author" => "required",
            "code"=>'required',
            "cost"=>'required',
            "gem"=>'required'
        ]);

        if($validated['code'] == $thrailer->code){
            $thrailer->author = $validated['author'];
            $thrailer->title = $validated['title'];
            $thrailer->cost = $validated['cost'];
            $thrailer->gem = $validated['gem'];
            if(empty($thrailer->approved)){
                $thrailer->approved = date("Y/m/d");
            }
            $thrailer->save();
        }else {
            return back()->withErrors('Invalid Code, please contact the Adminstrator');
        }

        return back()->with('success', 'item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thrailer $thrailer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thrailer $thrailer)
    {
        request()->validate(['password'=>'required']);

        if(Hash::check(request()->password, auth()->user()->password )){
            // $arr_path = explode('/', $thrailer->video);
            // $end_path = end($arr_path);
            // Storage::delete('/public/thrailers/'.$end_path);
            $thrailer->delete();
        }else {
            return abort(401);
        }

        return redirect()->route('thrailers.index')->with('success', 'item deleted successfully');
    }
}
