<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware(['auth:admin', 'checkrole:event']);
    }
    public function index()
    {
        $dayAway = Setting::find(1)->event_day_away;

        $events = Event::orderBy('created_at')->get();
        return view('admin.events.index', compact(['events', 'dayAway']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dayAway = ((int)Setting::find(1)->event_day_away) - 1;
        $validated = $this->validate($request, [
            "name" => "required",
            "date" => "required|date_format:Y-m-d|after:".date(now()->addDays($dayAway)),
            "cost" => "required",
            "gem" => "required",
            "type" => "required",
            "hosted_by" => ""
        ], $messages = [
            'after' => 'Event should at least be '.($dayAway+1).' days away.'
        ]);

        $validated['hosted_by'] = 'Admin';
        $validated['status'] = now();
        $validated['remark'] = 'approved';

        auth()->guard('admin')->user()->events()->create($validated);
        toast('Event was Created!', 'success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.show', compact('event'));
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
        $event = Event::findORFail($id);
        $data = request()->validate([
            'q'=>'required'
        ]);
        $data['q'] == 'cancelled' ? $event->remark = "cancelled" : $event->remark = "approved";
        $data['q'] != 'cancelled' ? $event->status = now() : $event->status = null;
        $event->save();
        toast('Event Updated', 'success');
        return back();
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
