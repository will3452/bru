<?php

namespace App\Http\Controllers\Admin;

use App\Art;
use App\Book;
use App\Audio;
use App\Thrailer;
use Carbon\Carbon;
use App\Recommendation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecommendationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth:admin');

    }
    public function index()
    {
        return view('admin.recommendation.index');
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->validate($request,[
            'id'=>'required',
            'to_date'=>'required',
            'from_date'=>'required'
        ], ['id.required'=>'item is required!']);
        
        $from = Carbon::parse($validated['from_date']);
        $to = Carbon::parse($validated['to_date']);

        if($request->type == 'Book'){
            Book::find($request->id)->recommendation()->create(['remark'=>$request->remark, 'from_date'=>$from, 'to_date'=>$to]);
        }else if($request->type == 'Art'){
            Art::find($request->id)->recommendation()->create(['remark'=>$request->remark, 'from_date'=>$from, 'to_date'=>$to]);
        }else if($request->type == 'Audio'){
            Audio::find($request->id)->recommendation()->create(['remark'=>$request->remark, 'from_date'=>$from, 'to_date'=>$to]);

        }else if($request->type == 'Thrailer'){
            Thrailer::find($request->id)->recommendation()->create(['remark'=>$request->remark, 'from_date'=>$from, 'to_date'=>$to]);
        }

        return back()->withSuccess('Items Added.');
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Recommendation::find($id)->delete();
        return back()->withSuccess('Items removed.');

    }
}
