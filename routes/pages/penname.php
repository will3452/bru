<?php

//pennames store
Route::post('/profile/penname', 'PenController@store')->name('penname.store');

Route::post('/profile/penname-picture', 'PenController@updatePicture')->name('penname.update.picture');

Route::delete('/profile/pename/{id}', 'PenController@destroy')->name('penname.destroy');
