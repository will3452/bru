<?php

namespace App\Http\Controllers\Admin;

use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventSetDayAwayUpdate extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $validated = $this->validate($request, [
            'event_day_away'=>'required'
        ]);

        Setting::find(1)->setDayAway($validated['event_day_away']);
        return back()->withSuccess("Done!");
    }
}
