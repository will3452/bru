<?php

namespace App\Http\Controllers;

use App\Message;
use Carbon\Carbon;

class CronController extends Controller
{
    public function deleteAllMessage()
    {
        $date = Carbon::now()->subDays(30);
        $messages = Message::where('created_at', '>=', $date)->get();

        return $messages;
    }
}
