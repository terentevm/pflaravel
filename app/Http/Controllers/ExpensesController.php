<?php

namespace App\Http\Controllers;

use App\Events\ExpenseCreate;
use App\Events\ExpenseUpdate;
use App\Expense;
use App\ExpenseRow;
use App\Http\Resources\ExpenseResource;
use App\Jobs\Documents\Expense\CreateExpense;
use App\Jobs\Documents\Expense\UpdateExpense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return Expense::with('wallet')->filter($request)->orderBy('date',
            'desc')->paginate($this->paginationCount);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->user()->cant('createCheckRowLimit', \App\ModelByUser::class)) {
            abort(403, "Rows limit exceeded for user!");
        }

        $expense = $this->dispatch(new CreateExpense(
            Auth::user(),
            $request->only([
                'id',
                'user_id',
                'date',
                'wallet_id',
                'sum',
                'comment'
            ]
        )));

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
        $expense = Expense::findOrFail($id);

        $this->dispatch(
            new UpdateExpense($expense, $request->only(['date', 'wallet_id', 'sum', 'comment']))
        );

        return response("OK", 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $count = Expense::destroy($id);

        return $count > 0 ? response('DELETED',200) : response('NOT DELETED',500);
    }
}
