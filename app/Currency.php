<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class Currency extends ModelByUser
{
    public $timestamps = false;

    protected $table = 'ref_currencies';

    protected $primaryKey = 'id';

    protected $keyType = 'uuid';

    protected $fillable = [
        'id',
        'name',
        'code',
        'short_name',
        'user_id',
    ];

    protected $hidden = ['user_id'];

    public static function getSystemCurrency($input)
    {
        $sysCurrencyList = config('money.baseCurrencyList');

        $sysCurrency = !isset($input['currency']) || !array_key_exists($input['currency'],
            $sysCurrencyList)
            ? config('money.defaultSystemCurrency')
            : $sysCurrencyList[$input['currency']];

        return $sysCurrency;
    }

    public static function withRates(Collection $currencies, Carbon $date)
    {
        $id_arr = [];

        foreach ($currencies->toArray() as $currency) {
            array_push($id_arr, $currency['id']);
        }

        $lastRates = Rates::getLastRates(Auth::user(), $id_arr, $date);

        $currencies->each(function ($currency, $key) use ($lastRates) {

            $currency->rate = -1;
            $currency->mult = -1;

            foreach ($lastRates as $rateData) {
                if ($rateData->curr_id === $currency->id) {
                    $currency->rate = $rateData->rate;
                    $currency->mult = $rateData->mult;

                    break;
                }
            }
        });

        return $currencies;
    }
}
