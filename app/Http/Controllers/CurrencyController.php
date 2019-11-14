<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Http\Requests\CurrencyRequest;
use App\Http\Requests\CurrencyUpdateRequest;
use App\Http\Resources\CurrencyCollectionResource;
use App\Http\Resources\CurrencyResource;
use Carbon\Carbon;
use Illuminate\Http\Request;


class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request $request
     *
     * @return \App\Http\Resources\CurrencyCollectionResource;
     */
    public function index(Request $request)
    {
        $currencies = Currency::all();

        if ($request->input('withRates') === 'true') {

            $passedDate = $request->input('date');

            $dateFilter = isset($passedDate)
                ? Carbon::parse($passedDate)->endOfDay()
                : Carbon::now()->endOfDay();

            $currencies = Currency::withRates($currencies, $dateFilter);
        }

        $currencies->transform(function (Currency $currency) {
            return (new CurrencyResource($currency));
        });

        return new CurrencyCollectionResource($currencies);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CurrencyRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CurrencyRequest $request)
    {
        if ($request->user()->cant('createCheckRowLimit', \App\ModelByUser::class)) {
            abort(403, "Rows limit exceeded for user!");
        }

        $input = $request->all();

        $currency = Currency::create($input);

        return response()->json([
            'id' => $currency->id
        ])->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $id
     * @return \App\Http\Resources\CurrencyResource
     */
    public function show(string $id)
    {
        return new CurrencyResource(Currency::findOrFail($id));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CurrencyUpdateRequest $request
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function update(CurrencyUpdateRequest $request, string $id)
    {
        $currency = Currency::findOrFail($id);

        $currency->update($request->all());

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
        $count = Currency::destroy($id);
        return $count > 0 ? response('DELETED',200) : response('NOT DELETED',500);
    }
}
