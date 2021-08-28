<?php

use App\User;

//factory
Route::get('/book-factory/{no?}', function ($no = 1) {
    $user = User::where('email', request()->email ?? 'williamgalas2@gmail.com')->first();
    return App\Book::factory($no)->create([
        'user_id' => $user->id,
    ]);
});

Route::get('/art-factory/{no?}', function ($no = 1) {
    $user = User::where('email', request()->email ?? 'williamgalas2@gmail.com')->first();
    return App\Art::factory($no)->create([
        'user_id' => $user->id,
    ]);
});
