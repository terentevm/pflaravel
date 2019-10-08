<?php

namespace App\Http\Controllers;

use App\Events\MoneyTransactionEvent;
use App\Events\RegIncomeEvent;
use App\Http\Resources\IncomeResource;
use App\Income;
use App\IncomeRow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $incomes = Income::with('wallet')->filter($request)->orderBy('date',
            'desc')->paginate(15);

        return $incomes;
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

        $income = Income::create($request->only(['id', 'date', 'wallet_id', 'sum', 'comment']));

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
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $income = Income::with(['wallet'])->where('id', $id)->first();

        return new IncomeResource($income);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();

        $income = Income::findOrFail($id);

        $rows = IncomeRow::where('doc_id', $id);

        $rows->delete();

        $income->update($request->only(['date', 'wallet_id', 'sum', 'comment']));

        $income->rows()->createMany($request->input('rows'));

        event(new MoneyTransactionEvent($income, 'update'));

        event(new RegIncomeEvent($income));

        DB::commit();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Income $income
     * @return \Illuminate\Http\Response
     */
    public function destroy(Income $income)
    {
        $count = $income->destroy();
    }
}