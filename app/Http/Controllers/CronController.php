<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CronController extends Controller
{

    public function index()
    {
        // $this->deleteAllMessage();
    }

    public function deleteAllMessage()
    {
        $date = Carbon::now()->subDays(30);
        // return $date;
        $message = DB::table('messages')->whereDate('created_at', '<=', $date)->delete();
        // $message = DB::table('messages')->whereDate('created_at', '<=', $date)->get();

        // return DB::table('messages')->get();
    }

}
