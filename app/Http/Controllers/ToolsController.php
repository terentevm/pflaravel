<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Facades\RatesLoader;
use App\Http\Requests\LoadRatesRequest;
use App\Rates;
use App\Settings;

class ToolsController extends Controller
{
    public function loadRates(LoadRatesRequest $request)
    {
        $currencies = Currency::find($request->input('currencies'))->all();
        $settings = Settings::with('currency')->first();

        $date1 = \DateTime::createFromFormat('Y-m-d', $request->input('dateFrom'));
        $date2 = \DateTime::createFromFormat('Y-m-d', $request->input('dateTo'));

        $rates = RatesLoader::load($settings->currency, $currencies, $date1, $date2);

        Rates::storeRates($rates, $request->input('dateFrom'), $request->input('dateTo'));

    }
}
