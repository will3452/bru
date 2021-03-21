<?php

namespace App\Http\Controllers\Admin;

use App\GroupType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupTypeController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
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
            'name'=>'required|unique:group_types,name'
        ]);

        GroupType::create($validated);

        return redirect(route('admin.group.index').'?createType=true')->with(['success'=>'Done!']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        GroupType::find($id)->delete();
        return redirect(route('admin.group.index').'?createType=true')->with(['success'=>'Done!']);
    }
}
