<?php

namespace App\Http\Controllers;

use App\ChangeBalance;
use App\Events\MoneyTransactionEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChangeBalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->user()->cant('createCheckRowLimit', \App\ModelByUser::class)) {
            abort(403, "Rows limit exceeded for user!");
        }

        DB::beginTransaction();

        $cb = ChangeBalance::create($request->only([
            'id',
            'date',
            'wallet_id',
            'new_balance',
            'sum_expend',
            'sum_income'
        ]));

        event(new MoneyTransactionEvent($cb, 'create'));

        DB::commit();

        return response()->json([
            'id' => $cb->id
        ])->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ChangeBalance  $changeBalance
     * @return \Illuminate\Http\Response
     */
    public function show(ChangeBalance $changeBalance)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ChangeBalance  $changeBalance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChangeBalance $changeBalance)
    {
        DB::beginTransaction();

        $changeBalance->update($request->only([
            'id',
            'date',
            'wallet_id',
            'new_balance',
            'sum_expend',
            'sum_income'
        ]));

        event(new MoneyTransactionEvent($changeBalance, 'update'));

        DB::commit();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ChangeBalance  $changeBalance
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChangeBalance $changeBalance)
    {
        //
    }
}
