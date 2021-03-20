<?php

namespace App\Http\Controllers\Admin;

use App\AboutAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutAccountController extends Controller
{

    public function __construct(){
        return $this->middleware('auth:admin');
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'name'=>'required',
            'title'=>'required',
            'ig_link'=>'required',
            'fb_link'=>'required',
            'picture'=>'required'
        ]);
        $path = $request->picture->store('public/about_account');
        $arr_path = explode('/', $path);
        $end_path = end($arr_path);
        $validated['picture']  = '/storage/about_account/'.$end_path;
        // dd($validated);
        AboutAccount::create($validated);
        return back()->withSuccess('Done!');
    }

    public function update(Request $request, $id)
    {
        $validated = $this->validate($request, [
            'name'=>'required',
            'title'=>'required',
            'ig_link'=>'required',
            'fb_link'=>'required',
            'picture'=>'required'
        ]);
        $path = $request->picture->store('public/about_account');
        $arr_path = explode('/', $path);
        $end_path = end($arr_path);
        $validated['picture']  = '/storage/about_account/'.$end_path;
        // dd($validated);
        AboutAccount::find($id)->update($validated);
        return back()->withSuccess('Done!');
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
