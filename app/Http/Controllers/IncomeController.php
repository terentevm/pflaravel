<?php

namespace App\Http\Controllers;

use App\Events\MoneyTransactionEvent;
use App\Events\RegIncomeEvent;
use App\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IncomeController extends Controller
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        $income = Income::create($request->only(['id', 'date', 'sum', 'comment']));

        $income->rows()->createMany($request->input('rows'));

        event(new MoneyTransactionEvent($income, 'create'));

        event(new RegIncomeEvent($income));

        DB::commit();

        return response()->json([
            'id' => $income->id
        ])->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Income $income
     * @return \Illuminate\Http\Response
     */
    public function show(Income $income)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Income $income
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Income $income)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Income $income
     * @return \Illuminate\Http\Response
     */
    public function destroy(Income $income)
    {
        //
    }
}
