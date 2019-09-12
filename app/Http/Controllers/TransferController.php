<?php

namespace App\Http\Controllers;

use App\Events\MoneyTransactionEvent;
use App\Transfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
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
        DB::beginTransaction();

        $transfer = Transfer::create($request->only([
            'id',
            'date',
            'wallet_id_from',
            'wallet_id_to',
            'sum_from',
            'sum_to',
            'comment'
        ]));

        event(new MoneyTransactionEvent($transfer, 'create'));

        DB::commit();

        return response()->json([
            'id' => $transfer->id
        ])->setStatusCode(201);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function show(Transfer $transfer)
    {


    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transfer $transfer)
    {
        DB::beginTransaction();

        $transfer->update($request->only([
            'id',
            'date',
            'wallet_id_from',
            'wallet_id_to',
            'sum_from',
            'sum_to',
            'comment'
        ]));

        event(new MoneyTransactionEvent($transfer, 'update'));

        DB::commit();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transfer $transfer)
    {
        //
    }
}
