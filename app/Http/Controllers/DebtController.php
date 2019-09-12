<?php

namespace App\Http\Controllers;

use App\Debt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Events\MoneyTransactionEvent;

class DebtController extends Controller
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

        $debt = Debt::create($request->only([
            'id',
            'date',
            'wallet_id',
            'debt_forgiveness',
            'type',
            'contact_id',
            'debit',
            'credit',
        ]));

        event(new MoneyTransactionEvent($debt, 'create'));

        DB::commit();

        return response()->json([
            'id' => $debt->id
        ])->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Debt  $debt
     * @return \Illuminate\Http\Response
     */
    public function show(Debt $debt)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Debt  $debt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Debt $debt)
    {
        DB::beginTransaction();

        $debt->update($request->only([
            'id',
            'date',
            'wallet_id',
            'debt_forgiveness',
            'type',
            'contact_id',
            'debit',
            'credit',
        ]));

        event(new MoneyTransactionEvent($debt, 'update'));

        DB::commit();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Debt  $debt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Debt $debt)
    {
        //
    }
}
