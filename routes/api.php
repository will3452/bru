<?php

use App\Book;
use App\User;
use App\Testing;
use App\TestingUser;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Luigel\Paymongo\Facades\Paymongo;
use App\Http\Controllers\API\PaymongoWebhookController;

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


Route::prefix('v1')->group(function(){
    
    // proctected via sanctum
    Route::middleware('auth:sanctum')->group(function(){
        // Route::get('/test', function(){
        //     return response(['message'=>'you are authenticated'], 201);
        // });
        Route::post('/logout', 'ApiAuthController@logout');
        Route::post('/vip-update', 'ApiVIPUpdateController@update');

        // bookshelves
        Route::get('/books', 'ApiBooksController@index');
        Route::get('/books/{id}', 'ApiBooksController@show');
        // Route::get('/audio-books', ); 
        
        
       



        Route::post('/avatar', 'ApiAvatarController@store');
        Route::post('/avatar/update', 'ApiAvatarController@update');
        Route::get('/avatar', 'ApiAvatarController@show');

        Route::get('/newspaper', 'ApiNewspaperController@index');

    });

    // public
    Route::post('/register', 'ApiAuthController@register');
    Route::post('/login', 'ApiAuthController@login');

    // preloader
    Route::get('/preloader', 'ApiPreloaderController@random');

     // museum
     Route::get('/museum', 'ApiMuseumController@index');


    
    
    

    // Route::get('/testing-json',  function(Request $request){
    //     return User::get();
    // });

    // Route::get('/testing-image',  function(Request $request){
    //     return url('/artwork.png');
    // });



    
});

Route::post('webhook/paymongo', function(Request $request){
        
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
            'description' => $sourceData['type'].' test from src ' . $source['id']. ', email : '.$sourceData['billing']['email'],
            'source' => [
                'id' => $source['id'],
                'type' => $source['type'],
            ]
        ]);
    }
    return response()->noContent();
});
// payment-pay?user_id=1&amount=164&type=gcash
//testing