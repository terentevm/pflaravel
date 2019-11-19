<?php

namespace App\Services\RatesLoaders;

use App\Currency;

class RUCBLoader implements IRatesLoader
{
    private $sysCurrency = null;

    private $url = 'http://cbrates.rbc.ru/tsv/cb/&code&.tsv';


    public function __construct(Currency $sysCurrency)
    {
        $this->sysCurrency = $sysCurrency;
    }

    /**
     * Loads currency rates from bank's api.
     * @param array Currency[] An array containing the currency to load. Each array element must be a database selection.
     * @param \DateTime $date1 'Y-m-d'
     * @param \DateTime $date2 'Y-m-d'
     * @return array RateData[]
     * @throws RatesLoaderException
     */
    public function load(array $currencyList, \DateTime $date1, \DateTime $date2): array
    {
        if ($date1 > $date2) {
            throw new RatesLoaderException("Invalid parameters passed. Date 2 must be more then date 1",
                2);
        }

        return $this->makeRequest($currencyList, $date1, $date2);


    }

    private function makeRequest($currencyList, $date1, $date2)
    {
        $arrayOfRates = [];

        foreach ($currencyList as $currency) {

            if ($currency->short_name == $this->sysCurrency->short_name) {
                $rateData = new RateData($currency);
                $rateData->addRate('1980-01-01', 1, 1);

                array_push($arrayOfRates, $rateData);
                continue;
            }

            $fullUrl = str_replace('&code&', $currency->code, $this->url);

            $rateData = null;

            if (($handle = fopen($fullUrl, 'r')) !== false) {

                $rateData = new RateData($currency);

                while (($data = fgetcsv($handle, 1000, "\t")) !== false) {

                    $rate_date = $this->getDateFromStr($data[0]);

                    if ($rate_date < $date1 || $rate_date > $date2) {
                        continue;
                    }

                    $rateData->addRate($rate_date->format('Y-m-d'), floatval($data[2]),
                        intval($data[1]));

                }
            }

            if (!is_null($rateData)) {
                array_push($arrayOfRates, $rateData);
            }


        }

        return $arrayOfRates;


    }

    function getDateFromStr($dateStr)
    {
        $d = (\DateTime::createFromFormat('Ymd', $dateStr))->setTime(0, 0, 0);

        return $d;
    }

}