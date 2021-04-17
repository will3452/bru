<?php

namespace App\Http\Controllers\Admin;

use App\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin', 'checkrole:group']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::where('status','pending')->whereNull('approved')->get();// pending status
        if(request()->has('status') && request()->status != 'pending'){

            if(request()->has('status') && request()->status ==  'dis'){
                $groups = Group::where('status','disapproved')->get();
            }else {
                $groups = Group::where('status','approved')->whereNotNull('approved')->get();
            }
            // dd($groups);
            
        }
        return view('admin.groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $group = Group::find($id);
        $group->reason = '';
        $group->status = 'approved';
        $group->approved = now();
        $group->save();
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
        Group::find($id)->delete();
        return back()->withSuccess('Done!');
    }

    public function updateReason($id){
        $group = Group::findOrFail($id);
        request()->validate([
            'reason'=>'required'
        ]);
        $group->reason = request()->reason;
        $group->status = 'disapproved';
        $group->save();
        return back()->withSuccess('Done!');

    }
}
