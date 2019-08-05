<?php

namespace App\Services\RatesLoaders;

use App\Currency;


class ECBLoader implements IRatesLoader
{
    private $sysCurrency = null;

    private $url = 'https://www.ecb.europa.eu/stats/eurofxref/eurofxref-hist.zip';

    private $data = [];

    public function __construct(Currency $sysCurrency)
    {
        $this->sysCurrency = $sysCurrency;
    }

    public function load(array $currencyList, \DateTime $date1, \DateTime $date2): array
    {

        if ($date1 > $date2) {
            throw new RatesLoaderException("Invalid parameters passed. Date 2 must be more then date 1",
                2);
        }

        $arrayOfRates = [];

        if (empty($this->data)) {
            $this->makeRequest($date1, $date2);
        }

        foreach ($currencyList as $currency) {
            if ($currency->short_name == $this->sysCurrency->short_name) {
                $rateData = new RateData($currency);
                $rateData->addRate('1980-01-01', 1, 1);

                array_push($arrayOfRates, $rateData);
                continue;
            }

            $ratesByCurrency = $this->getRatesByCurrency($currency);

            $rateData = new RateData($currency);
            $rateData->setRates($ratesByCurrency['rates']);
            array_push($arrayOfRates, $rateData);
        }

        return $arrayOfRates;
    }

    private function makeRequest($date1, $date2)
    {
        $tempFile = tempnam(sys_get_temp_dir(), 'rates');

        if ($tempFile === false) {
            throw new Exception("Can't create temp file! ", 4);
        }
        $stream_context = stream_context_create([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
                'verify_depth' => 0
            ]
        ]);

        $source = fopen($this->url, 'r', null, $stream_context);
        $dest = fopen($tempFile, 'w');

        stream_copy_to_stream($source, $dest);

        fclose($source);
        fclose($dest);

        if (($handle = fopen('zip://' . $tempFile . '#eurofxref-hist.csv', 'r')) !== false) {

            $header = [];
            $index = 0;

            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                if ($index === 0) {
                    $header = $data;
                    $index++;
                    continue;
                }

                $rate_date = new \DateTime($data[0]);

                if ($rate_date <= $date1 || $rate_date >= $date2) {
                    continue;
                }

                $rates = [];


                for ($i = 1; $i < count($header); $i++) {
                    $rate = floatval($data[$i]);
                    $rates[$header[$i]] = $rate;
                }

                $this->data[$data[0]] = $rates;
                $index++;
            }

            fclose($handle);
        }

        unlink($tempFile);

    }

    private function getRatesByCurrency($currency)
    {
        $ratesByCurrency = [];
        $filterCode = strtoupper($currency->short_name);

        foreach ($this->data as $date => $rates) {
            if (array_key_exists($filterCode, $rates)) {
                $rate = $rates[$filterCode];

                if ($rate !== 0) {

                    $mult = $this->defineMult($rate);

                    $ratesByCurrency[$date] = [
                        'rate' => round($mult / $rate, 5, PHP_ROUND_HALF_UP),
                        'mult' => $mult
                    ];
                }

            }
        }

        return [
            'mult' => $mult,
            'rates' => $ratesByCurrency
        ];

    }

    private function defineMult($rate)
    {
        if ((1 / $rate) >= 0.1) {
            return 1;
        } elseif ((1 / $rate) >= 0.01) {
            return 100;
        } elseif ((1 / $rate) >= 0.001) {
            return 1000;
        } elseif ((1 / $rate) >= 0.0001) {
            return 10000;
        } else {
            return 100000;
        }
    }
}