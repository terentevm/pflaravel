<?php

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

Route::get('/', function () {
    header("Cache-Control: no-cache, must-revalidate");
    return view('index');
});

Route::get('/conf', function () {
    dd(config('money.baseCurrencyList'));
});

Route::get('/expenses', 'ExpensesController@index');
Route::get('/testbalance', 'ReportsController@balance');