<?php

Route::prefix('admin')->name('admin.')->group(function () {

    //home
    Route::get('home', 'Admin\HomeController@index')->name('home');
    //auth
    Route::get('login', 'Admin\Auth\LoginController@showLoginForm');
    Route::post('login', 'Admin\Auth\LoginController@login')->name('login');

    //profiles
    Route::get('/profile', 'Admin\ProfileController@index')->name('profile');
    Route::put('/profile', 'Admin\ProfileController@update')->name('profile.update');

    //bin
    Route::get('/bin', 'Admin\BinController@index')->name('bin.index');
    Route::put('/bin/{id}', 'Admin\BinController@restore')->name('bin.restore');

    //merch store
    Route::post('/store', 'Admin\ProductController@store')->name('product.store');
    Route::get('/store', 'Admin\ProductController@index')->name('product.index');
    Route::get('/store/create', 'Admin\ProductController@create')->name('product.add');

    //AAN
    Route::post('/aan', 'Admin\AANController@store')->name('aan.store');
    Route::get('/aan', 'Admin\AANController@index')->name('aan.index');
    Route::delete('/aan/{id}', 'Admin\AANController@destroy')->name('aan.destroy');

    //books
    Route::get('/books/list', 'Admin\BookController@list')->name('books.list');
    Route::put('/books/{book}', 'Admin\BookController@update')->name('books.update');
    Route::get('/books/{book}', 'Admin\BookController@show')->name('books.show');

    //genres
    Route::get('/genres/list', 'Admin\GenreController@list')->name('genres.list');
    Route::post('/genres', 'Admin\GenreController@store')->name('genres.store');
    Route::get('/genres/{genre}', 'Admin\GenreController@show')->name('genres.show');
    Route::put('/genres/{genre}', 'Admin\GenreController@update')->name('genres.update');
    Route::delete('/genres/{genre}', 'Admin\GenreController@destroy')->name('genres.delete');
    Route::get('/tags', 'TagController@index')->name('tags.index');

    //thrailers
    Route::get('/film', 'Admin\ThrailerController@index')->name('thrailers.index');

    //events
    Route::resource('/events', 'Admin\EventController');
    //setting the event day away
    Route::put('/event-day-away/setting', 'Admin\EventSetDayAwayUpdate')->name('event_set_day_away');

    //characters management
    Route::resource('/characters', 'Admin\\CharacterController');
    //pasword generator
    Route::get('/password-generates', 'Admin\\PasswordGeneratorController')->name('password.generate');
    //admins
    Route::resource('/admins', 'Admin\\AdminController');

    //roles
    Route::resource('/roles', 'Admin\\RoleController');

    //admin role
    Route::post('/admin-roles/{admin}', 'Admin\\AdminRoleController@update')->name('toggle-role');

    //arts
    Route::resource('/arts', 'Admin\\ArtController');

    //static
    Route::resource('/about', 'Admin\\AboutPageController');

    //recommendation list page
    Route::resource('/recommendation', 'Admin\\RecommendationController');

    //recommendation remarks
    Route::get('/recommendation-remarks', 'Admin\\RecomRemarksController@index')->name('recom.remarks');

    //music
    Route::resource('/songsgenre', 'Admin\\MusicGenreController');

    //about link account
    Route::resource('/aboutaccount', 'Admin\\AboutAccountController');

    //group approval,
    Route::resource('/group', 'Admin\\GroupController');
    Route::put('/group-disapprove/{id}', 'Admin\\GroupController@updateReason')->name('group.disapprove');

    //create type of group
    Route::resource('/grouptypes', 'Admin\\GroupTypeController');

    //users
    Route::resource('/users', 'Admin\\UserController');

    //ticket for edinting works
    Route::resource('/tickets', 'Admin\\TicketController');

    //messages
    Route::resource('/messages', 'AdminMessageController');

    //message delete all
    Route::post('/messages-delete', 'AdminMessageDeleteController')->name('messages.delete.all');

});


Route::prefix('admin/images')->name('admin.images.')->middleware('auth:admin')->group(function () {
    Route::get('/', 'Admin\ImageManagementController@index')->name('menu');

    Route::delete('/marquee-announcement/{id}', 'Admin\ImageManagementController@removeAnnouncement')->name('announcement.remove');
    Route::get('/marquee-announcement', 'Admin\ImageManagementController@announcementInMarquee')->name('announcement');
    Route::post('/marquee-announcement', 'Admin\ImageManagementController@storeAnnouncementInMarquee')->name('announcement.store');

    Route::delete('/banners/{id}', 'Admin\ImageManagementController@removeBanner')->name('banner.remove');
    Route::get('/banners', 'Admin\ImageManagementController@banner')->name('banner');
    Route::post('/banners', 'Admin\ImageManagementController@storeBanner');

    Route::delete('/preloaders/{id}', 'Admin\ImageManagementController@removePreloader')->name('preloader.remove');
    Route::get('/preloaders', 'Admin\ImageManagementController@preloaders')->name('preloader');
    Route::post('/preloaders', 'Admin\ImageManagementController@storePreloader');

    Route::delete('/bulletin/{id}', 'Admin\ImageManagementController@removeBulletin')->name('bulletin.remove');
    Route::get('/bulletin', 'Admin\ImageManagementController@bulletin')->name('bulletin');
    Route::post('/bulletin', 'Admin\ImageManagementController@storeBulletin');

    Route::delete('/newspaper/{id}/page', 'Admin\ImageManagementController@removePageNewspaper')->name('newspaper.page.remove');
    Route::delete('/newspaper/{id}', 'Admin\ImageManagementController@removeNewspaper')->name('newspaper.remove');
    Route::get('/newspaper/{id}', 'Admin\ImageManagementController@showNewspaper')->name('newspaper.show');
    Route::post('/newspaper/{id}', 'Admin\ImageManagementController@storePageNewspaper')->name('newspaper.page');
    Route::get('/newspaper', 'Admin\ImageManagementController@newspaper')->name('newspaper');
    Route::post('/newspaper', 'Admin\ImageManagementController@storeNewspaper');
});
