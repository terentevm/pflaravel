<?php
/**
 * Created by PhpStorm.
 *
 * Date: 13.04.2019
 * Time: 20:43
 */

namespace App\Services\RatesLoaders;

use App\Currency;

class RateData
{
    public $currency;

    private $rates = [];

    public function __construct(Currency $currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function code(): string
    {
        return $this->currency->short_name;
    }

    /**
     * @return int
     */
    public function getMult(): int
    {
        return $this->mult;
    }

    /**
     * @return array
     */
    public function getRates(): array
    {
        return $this->rates;
    }

    /**
     * @return mixed
     */
    public function getCurrencyId()
    {
        return $this->currency->id;
    }

    public function setRates(array $rates)
    {
        $this->rates = [];

        foreach ($rates as $date => $rate) {
            $this->addRate($date, $rate['rate'], $rate['mult']);
        }
    }

    public function addRate(string $date, float $rate, int $mult = 1)
    {
        $dateInt = strtotime($date);
        $this->rates[$dateInt] = [
            'date' => $date,
            'rate'=>$rate,
            'mult' => $mult
        ];
    }

}