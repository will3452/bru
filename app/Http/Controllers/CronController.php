<?php

namespace App\Http\Controllers;

use App\Message;
use Carbon\Carbon;

class CronController extends Controller
{

    public function index()
    {
        $this->deleteAllMessage();
    }

    public function deleteAllMessage()
    {
        $date = Carbon::now()->subDays(Message::DAYDELETE);
        // return $date;
        $message = Message::whereDate('created_at', '<=', $date)->delete();
        // $message = DB::table('messages')->whereDate('created_at', '<=', $date)->get();

        // return DB::table('messages')->get();
    }
}
