<?php
/**
 * Created by PhpStorm.
 *
 * Date: 30.08.2019
 * Time: 20:57
 */

namespace App\Services;


use App\Currency;
use App\Rates;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class Converter
{
    /**
     * The currency in which should be recalculated balances
     * @var Currency
     */
    private $resultCurrency;

    /**
     * Converter constructor.
     * @param Currency $resultCurrency
     */
    public function __construct(Currency $resultCurrency)
    {
        $this->resultCurrency = $resultCurrency;
    }

    /**
     * @param Collection $data
     * @param Carbon $date
     * @param string $propCurrency
     * @param string $propForConvert
     * @param string $propForConverted
     * @return Collection
     */
    public function convert(
        Collection $data,
        Carbon $date,
        string $propCurrency,
        string $propForConvert,
        string $propForConverted = ''
    ) {

        if (empty($propForConverted)) {
            $propForConverted = $propForConvert;
        }

        $rates = Rates::getLastRates(Auth::user(),
            $data->pluck($propCurrency)->toArray(),
            $date);

        $rates = collect($rates);

        $resRateData = $this->getResultRateData($date);

        $converted = $data->map(function ($item, $key) use (
            $rates,
            $propCurrency,
            $propForConvert,
            $propForConverted,
            $resRateData
        ) {

            $rate = $this->getRate($rates, $item->$propCurrency);
            $amount = $item->$propForConvert;

            if (is_null($rate) || is_null($resRateData)) {
                return $item;
            }

            $item->$propForConverted = $this->convertAmount($amount, $rate->rate,
                $rate->mult, $resRateData->rate, $resRateData->mult);

            return $item;

        });

        return $converted;
    }

    private function getResultRateData(Carbon $date)
    {
        $rates = Rates::getLastRates(Auth::user(), [$this->resultCurrency->id], $date);

        return count($rates) > 0 ? $rates[0] : null;

    }

    function getRate(Collection $rates, string $currency_id)
    {
        return $rates->where('curr_id', $currency_id)->first();
    }

    public function convertAmount($amount, $rateFrom, $multFrom, $rateTo, $multTo)
    {
        if ($amount === 0 || $rateFrom === 0 || $multFrom === 0 || $rateTo === 0 || $multTo === 0) {
            return 0;
        }

        $result = ($amount * $rateFrom * $multTo) / ($rateTo * $multFrom);

        return round($result, 2);
    }
}