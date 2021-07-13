<?php

namespace App\Http\Controllers;

use App\Event;
use App\Setting;
use Illuminate\Http\Request;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = auth()->user()->events;
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
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
            "hosted_by" => "required"
        ], $messages = [
            'after' => 'Event should at least be '.($dayAway+1).' days away.'
        ]);

       auth()->user()->events()->create($validated);

        return back()->with('success', 'item stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event $event
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // abort(401);
        $event = Event::findOrFail($id);
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $validated = $this->validate($request, [
            "name" => "required",
            "date" => "required|after:".date(now()->addDays(59)),
            "cost" => "required",
            "gem" => "required",
            "type" => "required",
            "hosted_by" => "required"
        ]);

        $event->update($validated);

        return back()->with('message', 'item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return back()->with('message', 'item deleted successfully');
    }
}
