<?php 

Route::prefix('books')->name('books.')->middleware(['auth'])->group(function () {
    Route::get('/', 'BookController@index')->name('index');
    Route::get('/list', 'BookController@list')->name('list');
    Route::post('/', 'BookController@store')->name('store');
    Route::put('/front/update/{book}', 'BookController@updateFront')->name('update.front');
    Route::get('/create', 'BookController@create')->name('create');
    Route::get('/{book}', 'BookController@show')->name('show');
    Route::put('/{book}', 'BookController@update')->name('update');
    Route::delete('/{book}', 'BookController@destroy')->name('destroy');

    //chapters preview
    Route::prefix('/{book}/previews-chapters')->name('previews.')->group(function () {
        Route::get('/', 'BookViewerController')->name('show');
    });

    //chapters
    Route::prefix('/{book}/chapters')->name('chapters.')->group(function () {
        Route::get('/', 'ChapterController@index')->name('index');
        Route::post('/', 'ChapterController@store')->name('store');
        Route::get('/create', 'ChapterController@create')->name('create');
        Route::delete('/{chapter}', 'ChapterController@destroy')->name('remove');
        Route::post('/series', 'ChapterController@storeSeries')->name('store.series');
        Route::post('/novel', 'ChapterController@storeNovel')->name('store.novel');
        Route::delete('/series/{b1}', 'ChapterController@removeSeries')->name('remove.series');
        Route::delete('/novel/{chapter}', 'ChapterController@removeNovel')->name('remove.novel');
        Route::get('/{chapter}', 'ChapterController@show')->name('show');
        Route::put('/{chapter}', 'ChapterController@update')->name('update');
    });

    Route::prefix('tags/{book}')->name('tags.')->group(function () {
        Route::post('/', 'TagController@store')->name('store');
    });

    Route::get('/update-front/{id}', function ($id) {
        return view('books.update-front', compact('id'));
    })->name('update-front');

});

Route::get('pdf-viewer', );
