<?php

Route::prefix('events')->name('events.')->middleware(['auth'])->group(function () {
    Route::get('/create', 'EventController@create')->name('create');
    Route::post('/', 'EventController@store')->name('store');
    Route::get('/', 'EventController@index')->name('index');
    Route::get('/{event}', 'EventController@show')->name('show');
    Route::put('/update-price/{event}', 'EventController@updatePrizes')->name('update.prizes');
    Route::put('/update-banner/{event}', 'EventController@updateBanner')->name('update.banner');
    Route::put('/update-game-slot/{event}', 'EventController@updateSlot')->name('update.slot');
});

Route::post('questions', 'QuestionController@create')->name('question.create');
