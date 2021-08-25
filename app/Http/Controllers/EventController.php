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
        $events = [];

        if (!request()->filter || request()->filter == 'approved') {
            $events = auth()->user()->events()->approved()->get();
        } else {
            $events = auth()->user()->events()->pending()->get();
        }

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

        // return 'this is under maintenance';
        $dayAway = ((int) Setting::find(1)->event_day_away) - 1;

        $validated = $this->validate($request, [
            "name" => "required",
            "date" => "required|date_format:Y-m-d|after:" . date(now()->addDays($dayAway)),
            "cost" => "",
            "gem" => "",
            "type" => "",
            'desc' => 'required',
            "hosted_by" => "required",
        ], $messages = [
            'after' => 'Event should at least be ' . ($dayAway + 1) . ' days away.',
        ]);
        $event = auth()->user()->events()->create($validated);

        if ($request->work_type) {
            $wt = $request->work_type;
            $wb = $request->work_id;

            switch ($wt) {
                case "book":
                    $event->book_id = $wb;
                    break;
                case "art":
                    $event->art_id = $wb;
                    break;
                case "film":
                    $event->thrailer_id = $wb;
                    break;
                case "song":
                    $event->song_id = $wb;
                    break;
                case "audio":
                    $event->audio_id = $wb;
                    break;
                case "podcast":
                    $event->podcast_id = $wb;
                    break;
            }

            $event->save();
        }

        if ($event->type) {
            return redirect()->route('events.show', $event->id);
        }

        return back()->with('success', 'event stored successfully');
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
        if (!$event->game()->count()) {
            $event->game()->create([
                'prizes' => 'Art Scene',
                'other_prize' => request()->has('other_prize') ? request()->other_prize : null,
            ]);
        }
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
            "date" => "required|after:" . date(now()->addDays(59)),
            "cost" => "required",
            "gem" => "required",
            "type" => "required",
            "hosted_by" => "required",
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

    public function updatePrizes(Event $event)
    {
        $data = request()->validate([
            'prize' => 'required',
            'other_prize' => '',
        ]);
        if ($event->game) {
            $event->game()->update([
                'prizes' => implode(', ', $data['prize']),
                'other_prize' => request()->has('other_prize') ? request()->other_prize : null,
            ]);
        } else {
            $event->game()->create([
                'prizes' => implode(', ', $data['prize']),
                'other_prize' => request()->has('other_prize') ? request()->other_prize : null,
            ]);
        }

        toast('prizes updated!', 'success');
        return back();
    }

    public function updateBanner(Event $event)
    {

        $data = request()->validate([
            'banner_image' => 'required',
            'banner_title' => 'required',
        ]);

        $path = $data['banner_image']->store('/public/event_banner');
        $arrpath = explode('/', $path);
        $endPath = end($arrpath);

        $data['banner_image'] = '/storage/event_banner/' . $endPath;
        $event->update($data);
        toast('banner updated', 'success');
        return back();
    }

    public function updateSlot(Event $event)
    {
        $data = request()->validate([
            'number_of_tries' => 'required',
        ]);
        // return $event;

        if (!$event->game->slot()->count()) {
            $event->game->slot()->create($data);
        } else {
            $event->game->slot()->update($data);
        }
        toast('Slot machine updated', 'success');
        return back();
    }

    public function updateArt($id)
    {
        $data = request()->validate([
            'art_id' => 'required',
        ]);

        $event = Event::find($id);
        $event->game()->update($data);
        toast('Art updated!', 'success');
        return back();
    }

}
