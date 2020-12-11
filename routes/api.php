<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

ApiRoute::version('v1', function (){
    ApiRoute::get('/test', function (){
        return ['message' => 'A API esta operacional sem autenticação'];
    });

    ApiRoute::group(['namespace' => 'CodeFlix\Http\Controllers\API', 'as' => 'api'], function (){
        ApiRoute::post('/access_token', 'AuthController@accessToken')->name('.access_token');
    });

    ApiRoute::group(['middleware' => 'api.throttle', 'limit' => 60, 'expires' => 1], function (){
        //endpoints que precisam de autenticação
    });
});
