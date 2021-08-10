<?php

namespace App\Http\Controllers;

use App\User;
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

    public function getWeek()
    {
        $startWeek = now()->startOfWeek();
        $endWeek = now()->endOfWeek();
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
            'month_year' => now()->isoFormat('MM Y'),
        ], 200);
    }
}
