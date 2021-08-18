<?php 

Route::post('/aan/checker', 'CheckerController@aanChecker')->name('aan.check');

Route::post('/pen/checker', 'CheckerController@penChecker')->name('pen.check');

Route::post('/email/checker', 'CheckerController@emailChecker')->name('email.check');

Route::post('/genre/checker', 'CheckerController@genreChecker')->name('genre.check');
