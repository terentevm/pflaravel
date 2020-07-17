<?php

namespace App\Http\Controllers;

use App\Events\IncomeUpdate;
use App\Http\Resources\IncomeResource;
use App\Income;
use App\IncomeRow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Income::with('wallet')
            ->filter($request)
            ->orderBy('date', 'desc')
            ->paginate($this->paginationCount);

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

        $income = $this->dispatch(new \App\Jobs\Documents\Income\CreateIncome(
            Auth::user(),
            $request->only(['id', 'date', 'wallet_id', 'sum', 'comment'])
        ));

        return response()->json([
            'id' => $income->id
        ])->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $id
     * @return \App\Http\Resources\IncomeResource
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

        $income = Income::findOrFail($id);

        $this->dispatch(new \App\Jobs\Documents\Income\UpdateIncome(
            $income,
            $request->only(['date', 'wallet_id', 'sum', 'comment'])
        ));

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
        $count = Income::destroy($id);

        return $count > 0 ? response('DELETED', 200) : response('NOT DELETED', 500);
    }
}
