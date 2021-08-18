<?php

Route::prefix('tickets')->name('tickets.')->middleware('auth')->group(function () {
    //delete ticket
    Route::post('delete/book/{book}', 'TicketController@bookDestroy')->name('book.delete');
    Route::post('delete/art/{art}', 'TicketController@artDestroy')->name('art.delete');
    Route::post('delete/chapter/{chapter}', 'TicketController@chapterDestroy')->name('chapter.delete');
    Route::post('delete/trailer/{thrailer}', 'TicketController@thrailerDestroy')->name('thrailer.delete');
    Route::post('delete/audio/{audio}', 'TicketController@audioDestroy')->name('audio.delete');
    Route::post('delete/song/{song}', 'TicketController@songDestroy')->name('song.delete');
    Route::post('delete/podcast/{podcast}', 'TicketController@podcastDestroy')->name('podcast.delete');

    //edit ticket
    Route::post('edit/book/{book}', 'TicketController@bookUpdate')->name('book.update');
    Route::post('edit/art/{art}', 'TicketController@artUpdate')->name('art.update');
    Route::post('edit/chapter/{chapter}', 'TicketController@chapterUpdate')->name('chapter.update');
    Route::post('edit/trailer/{thrailer}', 'TicketController@thrailerUpdate')->name('thrailer.update');
    Route::post('edit/audio/{audio}', 'TicketController@audioUpdate')->name('audio.update');
    Route::post('edit/song/{song}', 'TicketController@songUpdate')->name('song.update');
    Route::post('edit/podcast/{podcast}', 'TicketController@podcastUpdate')->name('podcast.update');

});
