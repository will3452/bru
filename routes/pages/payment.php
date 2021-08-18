<?php

//payment
Route::get('payment-pay', 'PaymentController@pay')->name('payment.pay');

Route::get('payment-success', 'PaymentController@success')->name('payment.success');

Route::get('payment-failed', 'PaymentController@success')->name('payment.failed');
