<?php

use App\Log;
use App\MarketTransaction;
use App\Supports\Dragonpay;
use App\Transaction;

Route::get('/payment-test', function () {
    return view('payment_test');
});

Route::post('/payment-post', function () {
    $data = request()->validate([
        'description'=>'required|max:200',
        'amount'=>'numeric|required',
    ]);

    $data['email'] = auth()->user()->email;

    $parameters = Dragonpay::createParameters($data['amount'], 'PHP', $data['description'], $data['email']);

    $parameters = Dragonpay::getDigestString($parameters);

    $url = Dragonpay::getURL($parameters);
    return redirect()->to($url);
});

Route::post('/pay-for-marketing', function () {
    $data = request()->validate([
        'market_id'=>'required',
        'description'=>'required|max:200',
        'amount'=>'numeric|required',
    ]);

    $data['email'] = auth()->user()->email;

    session(['market_id'=>$data['market_id']]);

    unset($data['market_id']);

    $parameters = Dragonpay::createParameters($data['amount'], 'PHP', $data['description'], $data['email']);

    $parameters = Dragonpay::getDigestString($parameters);

    $url = Dragonpay::getURL($parameters);
    return redirect()->to($url);
});

Route::get('/payment-result', function () {
    $data = request()->validate([
        'refno'=>'required',
        'txnid'=>'required|unique:transactions,txnid',
        'message'=>'required',
        'status'=>'required',
    ]);
    $transaction = Transaction::create($data);

    if (session()->has('market_id')) {
        $transaction->marketTransaction()->create(['market_id'=>session('market_id')]);
    }

    if (request()->status == 'S') {
        return view('payment.success');
    } elseif (request()->status == 'P') {
        return view('payment.pending');
    } elseif (request()->status == 'F') {
        return view('payment.failed');
    }
    return view('payment.error');
});
