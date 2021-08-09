<?php

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Luigel\Paymongo\Facades\Paymongo;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v1')->group(function () {

    // proctected via sanctum
    Route::middleware('auth:sanctum')->group(function () {
        // Route::get('/test', function(){
        //     return response(['message'=>'you are authenticated'], 201);
        // });
        Route::post('/logout', 'ApiAuthController@logout');
        Route::post('/vip-update', 'ApiVIPUpdateController@update');

        // bookshelves
        Route::get('/books', 'ApiBooksController@index');
        Route::get('/books/{id}', 'ApiBooksController@show');
        // Route::get('/audio-books', );

        // museum
        Route::get('/museum/{id}', 'ApiMuseumController@show');
        Route::get('/museum', 'ApiMuseumController@index');
        Route::get('/museum-summary', 'ApiMuseumController@summary');

        // library
        Route::get('/library/{id}', 'ApiLibraryController@show');
        Route::get('/library', 'ApiLibraryController@index');
        Route::get('/library-summary', 'ApiLibraryController@summary');

        // theater and songs

        Route::get('/theater/{id}', 'ApiTheaterController@show');
        Route::get('/theater', 'ApiTheaterController@index');
        Route::get('/theater-summary', 'ApiTheaterController@summary');

        Route::get('/orc/{id}', 'ApiTheaterController@orcShow');
        Route::get('/orc', 'ApiTheaterController@orcIndex');
        // Route::get('/orc-summary', 'ApiTheaterController@Orcsummary');

        //my-collections
        Route::get('/my-collections', 'ApiBoxController@list');
        Route::get('/get-work-on-my-collections', 'ApiBoxController@getWork');
        Route::post('/add-to-my-collection', 'ApiBoxController@add'); // add to collection or box
        Route::post('/remove-to-my-collection', 'ApiBoxController@remove'); // add to collection or box

        // media stations
        Route::get('/media-audio/{id}', 'ApiMediaStationController@audioBookShow'); //audiobook
        Route::get('/media-audio', 'ApiMediaStationController@audioBookIndex');
        Route::get('/media-audiobook-summary', 'ApiMediaStationController@audioBookSummary');

        Route::get('/media-podcast/{id}', 'ApiMediaStationController@podcastShow'); //audiobook
        Route::get('/media-podcast', 'ApiMediaStationController@podcastIndex');
        Route::get('/media-podcast-summary', 'ApiMediaStationController@podcastSummary');

        // announcement
        Route::get('/announcement', 'ApiAnnouncementController@index');

        // banner
        Route::get('/banner', 'ApiBannerController@index');

        Route::post('/avatar', 'ApiAvatarController@store');
        Route::post('/avatar/update', 'ApiAvatarController@update');
        Route::get('/avatar', 'ApiAvatarController@show');

        // purchase
        Route::post('/purchase', 'ApiPurchaseController@purchaseWork');
        Route::post('/purchase-preview', 'ApiPurchaseController@previewWork'); //test

        //newspaper
        Route::get('/newspaper', 'ApiNewspaperController@index');

        //books
        Route::get('/book-chapter/{id}', 'ApiBookPreviewController@show');
        Route::get('/get-book-questions/{id}', 'ApiBookPreviewController@getQuestionFeedbacks');
        Route::post('/book-feedback/{id}', 'ApiBookPreviewController@postFeedback');

        // comments
        Route::get('/comments', 'ApiCommentController@getComments');
        Route::post('/comments', 'ApiCommentController@storeComment');

        Route::post('/likes', 'ApiLikeController@storeLike');

        // get others works
        Route::get('/other-works', 'ApiOtherWorkController@getWorks');

        // contacts
        Route::get('/explore', 'ApiContactController@searchUser');

        // bulletin
        Route::get('/bulletin', 'ApiBulletinController@index');
        Route::get('/bulletin/{id}', 'ApiBulletinController@show');

        // quotes
        Route::get('/quotes/{id}', 'ApiQuotesController@getQuote');
        Route::post('/quotes', 'ApiQuotesController@extractImage');
        Route::get('/quotes', 'ApiQuotesController@allQuotes');

        //playlist under collections of songs, audio, and podcasts
        Route::get('/playlists', 'ApiPlaylistController@index');
        Route::get('/playlists-mixed', 'ApiPlaylistController@mixIndex');
        Route::post('/playlists', 'ApiPlaylistController@togglePlaylist');

        // events
        Route::get('/events', 'ApiEventController@index');
        Route::get('/events/{id}', 'ApiEventController@show');
        Route::post('/deduct-cost', 'ApiEventController@deductCost');

        // quiz games
        Route::post('/games/quiz', 'ApiEventController@checkAnswer');

        //slot machine
        Route::post('/games/bet', 'ApiEventController@bet');

        //spins
        Route::post('/games/spin', 'ApiEventController@spin');

        //puzzle
        Route::post('/games/solve', 'ApiEventController@solve');

        Route::get('/latest-log', 'ApiDailyLogController@getLatestLog');
        Route::post('/get-log', 'ApiDailyLogController@storeLog');

        // users
        Route::get('/users', 'ApiUsersController@getUsers');
        Route::get('/users/{id}', 'ApiUsersController@showUser');

        //add friend users
        Route::post('/add-friend', 'ApiUsersController@addFriend');
        Route::get('/all-friends', 'ApiUsersController@allFriends');
        Route::post('/accept-friend', 'ApiUsersController@acceptFriend');
        Route::post('/decline-friend', 'ApiUsersController@denyFriend');
        Route::post('/un-friend', 'ApiUsersController@unFriend');
        Route::get('/requests-friend', 'ApiUsersController@friendRequests');

        // follow controller
        Route::post('/follow', 'ApiUsersController@toggleFollow');
        Route::get('/followers', 'ApiUsersController@getFollowers');

        // messages
        Route::post('/send-message', 'ApiMessageController@sendMessage');
        Route::get('/get-inbox', 'ApiMessageController@getInbox');
        Route::get('/get-outbox', 'ApiMessageController@getOutbox');
        Route::get('/get-message/{id}', 'ApiMessageController@readInbox');
        Route::get('/get-message-out{id}', 'ApiMessageController@readOutbox');
        Route::get('/unread-messages', 'ApiMessageController@unreadMessages');
        Route::post('/remove-message/{id}', 'ApiMessageController@removeMessage');

        // ecommerce
        Route::get('/products', 'ApiProductsController@getProducts');
        Route::get('/products-own', 'ApiProductsController@getMyProducts');
        Route::get('/products/{id}', 'ApiProductsController@showProduct');
        Route::post('/products/{id}', 'ApiProductsController@purchaseProduct');

        //diary
        Route::post('/diary', 'ApiDiaryController@addDiary');

    });

    // public
    Route::post('/register', 'ApiAuthController@register');
    Route::post('/login', 'ApiAuthController@login');

    // preloader
    Route::get('/preloader', 'ApiPreloaderController@random');

    // Route::get('/testing-json',  function(Request $request){
    //     return User::get();
    // });

    // Route::get('/testing-image',  function(Request $request){
    //     return url('/artwork.png');
    // });

});

Route::post('webhook/paymongo', function (Request $request) {

    $data = Arr::get($request->all(), 'data.attributes');

    if ($data['type'] !== 'source.chargeable') {
        return response()->noContent();
    }

    $source = Arr::get($data, 'data');
    $sourceData = $source['attributes'];

    if ($sourceData['status'] === 'chargeable') {
        $payment = Paymongo::payment()->create([
            'amount' => $sourceData['amount'] / 100,
            'currency' => $sourceData['currency'],
            'description' => $sourceData['type'] . ' test from src ' . $source['id'] . ', email : ' . $sourceData['billing']['email'],
            'source' => [
                'id' => $source['id'],
                'type' => $source['type'],
            ],
        ]);
    }
    return response()->noContent();
});
// payment-pay?user_id=1&amount=164&type=gcash
//testing
