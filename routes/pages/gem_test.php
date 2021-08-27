<?php

use App\Testing;

Route::get('/test', function () {
    return view('test_gem');
});

Route::post('/test', function () {
    $data = request()->validate([
        'email' => 'required',
        'value' => 'required',
    ]);

    $user = App\User::where('email', $data['email'])->first();
    if (!$user) {
        return 'no user found!';
    }

    $royalties = [
        'hall_pass' => $data['value'],
        'white_crystal' => $data['value'],
        'silver_ticket' => $data['value'],
        'purple_crystal' => $data['value'],
    ];
    $user->royalties()->update($royalties);
    return back()->withSuccess('added!');
});

Route::get('/vplayer', function () {
    $src = request()->src;
    return view('test-video', compact('src'));
});

Route::get('/command-test', function () {
    return Testing::get();
});

Route::get('/command-run-test', function () {
    Testing::create([
        'myname' => \Str::random(5),

    ]);
});
