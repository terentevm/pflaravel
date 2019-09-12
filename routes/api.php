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

    //For settings available GET and PUT methods only

    Route::get('settings', 'SettingsController@index');
    Route::post('settings', 'SettingsController@update');

    Route::apiResources([
        'currencies' => 'CurrencyController',
        'wallets' => 'WalletsController',
        'itemsexpense' => 'ItemsExpenditureController',
        'itemsincome' => 'ItemsIncomeController',
        'contacts' => 'ContactsController',
        'expenses' => 'ExpensesController',
        'incomes' => 'IncomeController',
        'transfers' => 'TransferController',
        'balancechanges' => 'ChangeBalanceController',
        'debts' => 'DebtController'
    ]);

    Route::post('tools/loadrates', 'ToolsController@loadRates');

    Route::post('reports/balance', 'ReportsController@balance');
    Route::post('reports/expenses', 'ReportsController@expenses');
    Route::post('reports/incomes', 'ReportsController@incomes');
    Route::post('reports/balance-by-periods', 'ReportsController@balanceByPeriods');
});