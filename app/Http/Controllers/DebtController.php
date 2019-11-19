<?php

namespace App\Http\Controllers;

use App\Debt;
use App\Events\DebtCreate;
use App\Events\DebtUpdate;
use App\Events\MoneyTransactionEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DebtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //ToDo To write out debt index method
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

        event(new DebtCreate($debt));

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
        //ToDo To write out debt show method
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

        event(new DebtUpdate($debt));

        DB::commit();

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
        $count = Debt::destroy($id);
        return $count > 0 ? response('DELETED', 200) : response('NOT DELETED', 500);
    }
}
