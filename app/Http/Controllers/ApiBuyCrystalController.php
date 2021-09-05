<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ApiBuyCrystalController extends Controller
{
    public function store(Request $request)
    {
        $user = User::find(auth()->user()->id);

        if ($user->wallet == null) {
            return response([
                'alert' => "You Don't Have Enough Balance in your wallet!",
                'result' => 404,
            ], 200);
        } else if ($user->wallet->balance < $request->price) {
            return response([
                'alert' => "You Don't Have Enough Balance in your wallet!",
                'result' => 404,
            ], 200);
        }

        $user->wallet->update([
            'balance' => $user->wallet - $request->price,
        ]);

        //notif here
        //records transaction here

        $sPackage = $request->package; // selected package

        if ($sPackage == 'a') {
            $user->royalties->update([
                'hall_pass' => $user->royalties->hall_pass + 3,
                'purple_crystal' => $user->royalties->purple_crystal + 3,
            ]);
        }

        if ($sPackage == 'b') {
            $user->royalties->update([
                'hall_pass' => $user->royalties->hall_pass + 3,
                'purple_crystal' => $user->royalties->purple_crystal + 8,
            ]);
        }

        if ($sPackage == 'c') {
            $user->royalties->update([
                'hall_pass' => $user->royalties->hall_pass + 6,
                'purple_crystal' => $user->royalties->purple_crystal + 11,
            ]);
        }

        if ($sPackage == 'd') {
            $user->royalties->update([
                'hall_pass' => $user->royalties->hall_pass + 5,
                'purple_crystal' => $user->royalties->purple_crystal + 18,
            ]);
        }

        if ($sPackage == 'e') {
            $user->royalties->update([
                'hall_pass' => $user->royalties->hall_pass + 8,
                'purple_crystal' => $user->royalties->purple_crystal + 21,
            ]);
        }

        return response([
            'result' => 200,
            'alert' => 'Transaction Success!',
            'new_balance' => $user->royalties,
        ], 200);

    }
}
