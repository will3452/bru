<?php 

Route::prefix('marketing')->name('marketing.')->middleware('auth')->group(function () {
    //marketing here
    Route::get('/create', 'MarketingController@createMarketing')->name('create');
    Route::get('/createPdf/{id}', 'MarketingController@createPDF')->name('createPdf');
    Route::get('/{id}', 'MarketingController@show')->name('show');
    Route::get('/', 'MarketingController@index')->name('index');
    Route::post('/', 'MarketingController@store')->name('store');

});
