<?php

namespace App\Http\Controllers;

use App\Quote;
use App\QuoteDiary;
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
            $rdate = Carbon::parse(request()->date);
            $noWeek = request()->noweek;
            $date = $this->getDate($rdate, $noWeek);
            $startWeek = Carbon::parse($date)->startOfWeek(Carbon::MONDAY);
            $endWeek = Carbon::parse($date)->endOfWeek(Carbon::SUNDAY);
            $date = Carbon::parse($date);
        }

        $user = User::find(auth()->user()->id ?? 6);
        $weeks = DB::table('logs')
            ->where('user_id', $user->id)
            ->where('created_at', '>=', $startWeek)
            ->where('created_at', '<=', $endWeek)
            ->get()
            ->groupBy(function ($log) {
                return strtolower(Carbon::parse($log->created_at)
                        ->isoFormat('dddd'));
            });
        $ownentry = $user->diaries()->whereDate('created_at', now())
            ->first();

        if (!request()->day) {
            return response([
                'result' => 200,
                'weeks' => $weeks,
                'own_entry' => $ownentry,
                'month_year' => $date->isoFormat('MMMM Y'),
            ], 200);
        } else {
            return response([
                'result' => 200,
                'day' => $weeks[request()->day] ?? [],
                'own_entry' => $ownentry,
                'month_year' => $date->isoFormat('MMMM Y'),
            ], 200);
        }
    }

    public function lastMonth()
    {
        $limit = request()->limit;
        $dates = collect();
        $cweek = now()->startOfWeek(Carbon::MONDAY)->weekOfMonth;
        $selected_date = now();
        while ($limit > 0) {
            $dates->push([
                'label' => $selected_date->isoFormat('MMMM Y'),
                'value' => $selected_date->format('Y-m'),
            ]);
            $selected_date = $selected_date->submonth();
            $limit--;
        }
        return response([
            'result' => 200,
            'c_week' => $cweek,
            'dates' => $dates,
        ]);
    }

    public function getCurrentEntry()
    {
        $user = User::find(auth()->user()->id);
        $current = $user->diaries()->whereDate('created_at', now())->latest()->first();

        return response([
            'own_entry' => $current ?? '',
            'result' => 200
            , 200]);
    }

    public function getCurrentSaveQuote()
    {
        $qd = QuoteDiary::where('user_id', auth()->user()->id)->get();
        $quotes = collect([]);
        foreach ($qd as $q) {
            $qt = $q->quote;
            $qt->load('book');
            $qt->date_time = $q->created_at->format('m-d-Y h:i A');
            $quotes->push($qt);
        }

        return response([
            'quotes'=>$quotes,
        ], 200);
    }

    public function getGalleryQuote()
    {
        $qq = Quote::where('user_id', auth()->user()->id)->get();

        $quotes = collect([]);

        foreach ($qq as $quote) {
            $quote->load('book');
            if (!$quote->quoteDiaries()->count()) {
                $quote->date_time = $quote->created_at->format('m-d-Y h:i A');
                $quotes->push($quote);
            }
        }

        return response([
            'quotes'=>$quotes
        ], 200);
    }
}
