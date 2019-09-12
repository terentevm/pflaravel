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
     *
     * @return \Illuminate\Http\Response
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CurrencyRequest $request)
    {
        $input = $request->all();

        $currency = Currency::create($input);

        return response()->json([
            'id' => $currency->id
        ])->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new CurrencyResource(Currency::findOrFail($id));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CurrencyUpdateRequest $request, $id)
    {
        $currency = Currency::findOrFail($id);

        $currency->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Currency::destroy($id);
    }
}
