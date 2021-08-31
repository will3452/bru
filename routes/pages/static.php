<?php

use App\Http\Controllers\StaticPageController;

Route::prefix('/')->name('static.')->group(function () {

    Route::get('/', [StaticPageController::class, 'home'])->name('home');
    Route::get('/contact', [StaticPageController::class, 'contact'])->name('contact');
    Route::get('/about', [StaticPageController::class, 'about'])->name('about');

});

// Route::view('/', 'landing');

// //static website
// Route::view('/about', 'about');

// Route::view('/contact', 'contactus');

Route::view('/bru', 'bru');

Route::view('/terms-and-conditions', 'terms_and_condition');

Route::view('/privacy-policy', 'privacy_policy');

Route::get('/please-input-aan', 'InputAanController')->name('input.aan');

//please contact route
Route::get('please-contact', 'PleaseContactController')->name('please-contact');

//please download route
Route::get('reader-please-download', 'PleaseDownloadController')->name('please-download');
