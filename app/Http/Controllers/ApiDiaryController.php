<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiDiaryController extends Controller
{
    public function addDiary()
    {
        $user = User::find(auth()->user()->id);
        $data = request()->validate([
            'body' => 'required',
        ]);

        $user->diaries()->create($data);
        return response([
            'result' => 200,
        ], 200);
    }

    public function getDate($month = '2021-12', $n = '1')
    {
        $f = 'Y-m-d';

        //if you want to record time as well, then replace today() with now()
        //and remove startOfDay()
        $today = Carbon::parse($month);
        $date = $today->copy()->firstOfMonth(Carbon::MONDAY)->startOfDay();
        $eom = $today->copy()->endOfMonth(Carbon::SUNDAY)->startOfDay();

        $dates = [];

        for ($i = 1; $date->lte($eom); $i++) {

            //record start date
            $startDate = $date->copy();

            //loop to end of the week while not crossing the last date of month
            while ($date->dayOfWeek != Carbon::SUNDAY && $date->lte($eom)) {
                $date->addDay();
            }

            $dates['w' . $i] = $startDate->format($f) . ' - ' . $date->format($f);
            $date->addDay();
        }
        [$first_date, $last_date] = explode(' - ', $dates['w' . (string) $n]);
        // dd($first_date, $last_date);
        [, , $first_day] = explode('-', $first_date);
        [, , $last_day] = explode('-', $last_date);

        $date = explode(' - ', $dates['w' . (string) $n]);

        return $date[0];
    }

    public function getWeek()
    {

        $startWeek = now()->startOfWeek(Carbon::MONDAY);
        $endWeek = now()->endOfWeek(Carbon::SUNDAY);
        $date = now();

        if (request()->date) {
            $noWeek = request()->noweek;
            $date = $this->getDate(request()->date, $noWeek);
            $startWeek = Carbon::parse($date)->startOfWeek(Carbon::MONDAY);
            $endWeek = Carbon::parse($date)->endOfWeek(Carbon::SUNDAY);
            $date = Carbon::parse($date);
        }

        $user = User::find(auth()->user()->id);
        $weeks = \DB::table('logs')
            ->where('user_id', $user->id)
            ->where('created_at', '>=', $startWeek)
            ->where('created_at', '<=', $endWeek)
            ->get()
            ->groupBy(function ($log) {
                return Carbon::parse($log->created_at)
                    ->isoFormat('dddd');
            });
        $ownentry = $user->diaries()->whereDate('created_at', now())
            ->first();

        return response([
            'result' => 200,
            'weeks' => $weeks,
            'own_entry' => $ownentry,
            'month_year' => $date->isoFormat('MMM Y'),
        ], 200);
    }

    public function last3Month()
    {
        $dates = collect();
        $dates->push([
            'label' => now()->isoFormat('MMMM Y'),
            'value' => now()->format('Y-m'),
        ]);
        $dates->push([
            'label' => now()->submonth()->isoFormat('MMMM Y'),
            'value' => now()->submonth()->format('Y-m'),
        ]);
        $dates->push([
            'label' => now()->submonth()->submonth()->isoFormat('MMMM Y'),
            'value' => now()->submonth()->submonth()->format('Y-m'),
        ]);
        return $dates;
    }
}
