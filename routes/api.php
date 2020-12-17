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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

ApiRoute::version('v1', function (){
    ApiRoute::get('/test', function (){
        return ['message' => 'A API esta operacional sem autenticação'];
    });

    ApiRoute::group([
        'namespace' => 'CodeFlix\Http\Controllers\API',
        'as' => 'api'
    ], function (){
        ApiRoute::post('/access_token', [
            'uses' => 'Auth\AuthController@accessToken',
            'middleware' => 'api.throttle',
            'limit' => 10,
            'expires' => 1
        ])->name('.access_token');
        ApiRoute::post('/refresh_token', [
            'uses' => 'Auth\AuthController@refreshToken',
            'middleware' => 'api.throttle',
            'limit' => 10,
            'expires' => 1
        ])->name('.refresh_token');

        ApiRoute::group(['middleware' => ['api.throttle', 'api.auth'], 'limit' => 60, 'expires' => 1], function (){
            ApiRoute::post('/logout','Auth\AuthController@logout')->name('.logout');
            ApiRoute::get('/test2', function (){
                return ['message' => 'A API esta operacional com autenticação'];
            });
            ApiRoute::get('/user', function (Request $request){
                return $request->user('api');
                //return app(\Dingo\Api\Auth\Auth::class)->user();
                //return Auth::guard('api')->user();
            });
            ApiRoute::get('/categories','CategoriesController@index')->name('.categories.index');
        });
    });

});
