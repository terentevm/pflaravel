<?php

namespace App\Http\Controllers;

use App\Events\MoneyTransactionEvent;
use App\Events\RegExpensesEvent;
use App\Expense;
use App\ExpenseRow;
use App\Http\Resources\ExpenseResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $expenses = Expense::with('wallet')->filter($request)->orderBy('date',
            'desc')->paginate(15);

        return $expenses;
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

        $expense = Expense::create($request->only([
            'id',
            'user_id',
            'date',
            'wallet_id',
            'sum',
            'comment'
        ]));

        $expense->rows()->createMany($request->input('rows'));

        event(new MoneyTransactionEvent($expense, 'create'));

        event(new RegExpensesEvent($expense));

        DB::commit();

        return response()->json([
            'id' => $expense->id
        ])->setStatusCode(201);

    }

    /**
     * Display the specified resource.
     *
     * @param  string $id
     * @return \App\Http\Resources\ExpenseResource
     */
    public function show($id)
    {
        $expense = Expense::with(['wallet'])->where('id', $id)->first();

        return new ExpenseResource($expense);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        $expense = Expense::findOrFail($id);

        $rows = ExpenseRow::where('doc_id', $id);

        $rows->delete();

        $expense->update($request->only(['date', 'wallet_id', 'sum', 'comment']));

        $expense->rows()->createMany($request->input('rows'));

        event(new MoneyTransactionEvent($expense, 'update'));

        event(new RegExpensesEvent($expense));

        DB::commit();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense = Expense::findOrFail($id);

        $count = $expense->destroy();
    }
}
