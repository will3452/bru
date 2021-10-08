<?php

use App\Log;
use App\Supports\Dragonpay;

Route::get('/payment-test', function () {
    return view('payment_test');
});

Route::post('/payment-post', function () {
    $data = request()->validate([
        'email'=>'email|required',
        'description'=>'required|max:200',
        'amount'=>'numeric|required',
    ]);

    $parameters = Dragonpay::createParameters($data['amount'], 'PHP', $data['description'], $data['email']);

    $parameters = Dragonpay::getDigestString($parameters);

    $url = Dragonpay::getURL($parameters);
    return redirect()->to($url);
});

Route::post('/payment-postback', function () {
    return 'result=OK';
});


Route::get('/payment-result', function () {
    return request()->all();
});
