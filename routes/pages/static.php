<?php
Route::view('/', 'landing');

//static website
Route::view('/about', 'about');

Route::view('/contact', 'contactus');

Route::view('/bru', 'bru');

Route::view('/terms-and-conditions', 'terms_and_condition');

Route::view('/privacy-policy', 'privacy_policy');

Route::get('/please-input-aan', 'InputAanController')->name('input.aan');

//please contact route
Route::get('please-contact', 'PleaseContactController')->name('please-contact');

//please download route
Route::get('reader-please-download', 'PleaseDownloadController')->name('please-download');
