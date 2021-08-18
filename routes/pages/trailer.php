<?php 


Route::prefix('trailers')->name('thrailers.')->middleware(['auth'])->group(function () {
    Route::get('/', 'ThrailerController@index')->name('index');
    Route::post('/{thrailer}/cover', 'ThrailerController@updateCover')->name('cover.update');
    Route::get('/create', 'ThrailerController@create')->name('create');
    Route::get('/{thrailer}', 'ThrailerController@show')->name('show');
    Route::post('/', 'ThrailerController@store')->name('store');
    // Route::get('/{thrailer}/edit', 'ThrailerController@edit')->name('edit');
    Route::put('/{thrailer}', 'ThrailerController@update')->name('update');
    Route::delete('/{thrailer}', 'ThrailerController@destroy')->name('destroy');

});
