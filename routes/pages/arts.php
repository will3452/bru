<?php

Route::prefix('arts')->name('arts.')->middleware(['auth'])->group(function () {
    Route::get('/create', 'ArtSceneController@create')->name('create');
    Route::get('/list', 'ArtSceneController@list')->name('list');
    Route::post('/', 'ArtSceneController@store')->name('store');
    Route::get('/{art}', 'ArtSceneController@show')->name('show');
    Route::put('/{art}', 'ArtSceneController@update')->name('update');
    Route::delete('/{art}', 'ArtSceneController@destroy')->name('destroy');
});
