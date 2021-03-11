<?php

use App\Book;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Admin\Auth\LoginController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'welcome');

//static website
Route::view('/about', 'about');
Route::view('/contact', 'contact');
Route::view('/bru', 'bru');

Auth::routes();

Route::get('/please-input-aan', 'InputAanController' )->name('input.aan');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

//email verifications 
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
    auth()->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

//pennames store
Route::post('/profile/penname', 'PenController@store')->name('penname.store');

//admin

Route::prefix('admin')->name('admin.')->group(function(){

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
    Route::get('/genres/{genre}', 'Admin\GenreController@show')->name('genres.show');
    Route::put('/genres/{genre}', 'Admin\GenreController@update')->name('genres.update');
    Route::get('/tags', 'TagController@index')->name('tags.index');

    //thrailers
    Route::get('/thrailers', 'Admin\ThrailerController@index')->name('thrailers.index');

    //events
    Route::resource('/events', 'Admin\EventController');
    //setting the event day away
    Route::put('/event-day-away/setting', 'Admin\EventSetDayAwayUpdate')->name('event_set_day_away');

    //messages
    Route::resource('/messages', 'Admin\MessageController');

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
    Route::resource('/arts','Admin\\ArtController');

    //static
    Route::resource('/about', 'Admin\\AboutPageController');

    //recommendation list page
    Route::resource('/recommendation', 'Admin\\RecommendationController');

    //recommendation remarks 
    Route::get('/recommendation-remarks', 'Admin\\RecomRemarksController@index')->name('recom.remarks');
});

//checkers
Route::post('/aan/checker', 'CheckerController@aanChecker')->name('aan.check');
Route::post('/pen/checker', 'CheckerController@penChecker')->name('pen.check');
Route::post('/email/checker', 'CheckerController@emailChecker')->name('email.check');
Route::post('/genre/checker', 'CheckerController@genreChecker')->name('genre.check');


//books 
Route::prefix('books')->name('books.')->group(function(){
    Route::get('/', 'BookController@index')->name('index');
    Route::get('/list', 'BookController@list')->name('list');
    Route::post('/', 'BookController@store')->name('store');
    Route::put('/front/update/{book}', 'BookController@updateFront')->name('update.front');
    Route::get('/create', 'BookController@create')->name('create');
    Route::get('/{book}', 'BookController@show')->name('show');
    Route::put('/{book}', 'BookController@update')->name('update');
    Route::delete('/{book}', 'BookController@destroy')->name('destroy');

    //chapters preview
    Route::prefix('/{book}/previews-chapters')->name('previews.')->group(function(){
        Route::get('/', 'BookViewerController')->name('show');
    });

    //chapters
    Route::prefix('/{book}/chapters')->name('chapters.')->group(function(){
        Route::get('/', 'ChapterController@index')->name('index');
        Route::post('/', 'ChapterController@store')->name('store');
        Route::get('/create','ChapterController@create')->name('create');
        Route::delete('/{chapter}', 'ChapterController@destroy')->name('remove');
        Route::post('/series', 'ChapterController@storeSeries')->name('store.series');
        Route::post('/novel', 'ChapterController@storeNovel')->name('store.novel');
        Route::delete('/series/{b1}', 'ChapterController@removeSeries')->name('remove.series');
        Route::delete('/novel/{chapter}','ChapterController@removeNovel')->name('remove.novel');
    });
    
    Route::prefix('tags/{book}')->name('tags.')->group(function(){
        Route::post('/', 'TagController@store')->name('store');
    });

    route::get('/update-front/{id}',function($id){
        return view('books.update-front', compact('id'));
    })->name('update-front');
    
});

Route::prefix('arts')->name('arts.')->group(function(){
    Route::get('/create', 'ArtSceneController@create')->name('create');
    Route::get('/list', 'ArtSceneController@list')->name('list');
    Route::post('/', 'ArtSceneController@store')->name('store');
    Route::get('/{art}', 'ArtSceneController@show')->name('show');
    Route::put('/{art}', 'ArtSceneController@update')->name('update');
    Route::delete('/{art}', 'ArtSceneController@destroy')->name('destroy');
});

Route::prefix('trailers')->name('thrailers.')->group(function(){
    Route::get('/', 'ThrailerController@index')->name('index');
    Route::get('/create', 'ThrailerController@create')->name('create');
    Route::post('/', 'ThrailerController@store')->name('store');
    Route::get('/{thrailer}/edit', 'ThrailerController@edit')->name('edit');
    Route::put('/{thrailer}', 'ThrailerController@update')->name('update');
    Route::delete('/{thrailer}', 'ThrailerController@destroy')->name('destroy');
});


Route::prefix('events')->name('events.')->group(function(){
    Route::get('/create', 'EventController@create')->name('create');
    Route::post('/', 'EventController@store')->name('store');
    Route::get('/', 'EventController@index')->name('index');
    Route::get('/{id}', 'EventController@show')->name('show');
});

Route::resource('audio', 'AudioController');
Route::resource('songs', 'SongController');
Route::resource('inbox', 'InboxController');


//please contact route
Route::get('please-contact','PleaseContactController')->name('please-contact');
//please download route
Route::get('reader-please-download', 'PleaseDownloadController')->name('please-download');