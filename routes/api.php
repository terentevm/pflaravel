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

Route::post('login', 'UserController@login');
Route::post('signup', 'UserController@signup');

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('details', 'UserController@details');
    Route::apiResources([
        'currencies' => 'CurrencyController',
        'wallets' => 'WalletsController'
    ]);

    Route::post('tools/loadrates', 'ToolsController@loadRates');
});