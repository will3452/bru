<?php

use App\Supports\Dragonpay;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

Route::get('/pre-register', 'PreregisterController@index');
Route::post('/pre-register', 'PreregisterController@save');
Route::view('/pre-success', 'preregister_success');

include __DIR__ .'/pages/dragonpay.php';


include __DIR__ . '/pages/static.php'; //static

//auth users
include __DIR__ . '/pages/auth.php';

include __DIR__ . '/pages/penname.php'; //penname

//admin
include __DIR__ . '/pages/admin.php'; //admin

//checkers
include __DIR__ . '/pages/checker.php';

//books
include __DIR__ . '/pages/books.php';

//arts
include __DIR__ . '/pages/arts.php';

//trailer
include __DIR__ . '/pages/trailer.php';

//marketing
include __DIR__ . '/pages/marketing.php';

//large video files handler
include __DIR__ . '/pages/large_video_handler.php';

//events
include __DIR__ . '/pages/events.php';

Route::resource('audio', 'AudioController');
//
Route::post('autofill-aduio-book', 'autoFillController')->name('auto.fill');

//update content such as: languages, male, college, blurb etc..,
Route::put('audio/update-some/{audio}', 'AudioController@updateSome')->name('audio.updatesome');

Route::resource('songs', 'SongController')->middleware('auth');

Route::resource('group', 'GroupController')->middleware('auth');

Route::resource('group-member', 'GroupMemberController')->middleware('auth');

Route::resource('inbox', 'InboxController')->middleware('auth');

Route::resource('podcast', 'PodcastController')->middleware('auth');

Route::resource('series', 'SeriesController')->middleware('auth');

Route::resource('collections', 'CollectionController')->middleware('auth');

Route::resource('albums', 'AlbumController')->middleware('auth');

//tickets
include __DIR__ . '/pages/tickets.php';

// ajax
Route::post('password-confirm', function () { //to check the password
    $ipassword = request()->password;
    return Hash::check($ipassword, auth()->guard('admin')->user()->password);
})->name('password-confirm');

//support chat //customer support
Route::view('support-chat', 'support_chat');

include __DIR__ . '/pages/payment.php';

// banner
Route::view('/banner-for-mobile', 'banner');

Route::view('/users', 'users-contact');

Route::view('/banner-maker', 'banner_editor')->middleware('auth');

//author & artist report
Route::get('/report', 'ReportController');

include __DIR__ . '/pages/gem_test.php';

// captcha
include __DIR__ . '/pages/captcha.php';

//cron
include __DIR__ . '/pages/cron.php';

//factory
include __DIR__ . '/pages/factory.php';

Route::get('/wallets', function () {
    return 'under maintenance!';
});

Route::get('/zip-download', function () {
    $files = ['appstore.png', 'artwork.png', 'storage/arts/3bBuuY1C8bqdCCvPLSWYmvaaGxJXe0QlpYMoFWnB.jpeg'];

    $name = "files.zip";

    $zip = new ZipArchive;

    $zip->open($name, ZipArchive::CREATE);

    foreach ($files as $file) {
        $zip->addFile($file);
    }

    $zip->close();

    header('Content-Type: application/zip');
    header('Content-disposition: attachment; filename=' . $name);
    header('Content-Length: ' . filesize($name));
    readfile($name);
});
