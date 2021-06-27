<?php

use App\Testing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
        Route::get('/test', function(){
            return response(['message'=>'you are authenticated'], 201);
        });
        Route::post('/logout', 'ApiAuthController@logout');
    });

    // public
    Route::post('/register', 'ApiAuthController@register');
    Route::post('/login', 'ApiAuthController@login');

    Route::post('/testing', function(Request $request){
        $request->validate([
            'myname'=>'required'
        ]);

        // 
        $testing = Testing::create(['myname'=>$request->myname]);
        // return response(['result'=>$testing], 201);
        return "success!";
    });
    
});
