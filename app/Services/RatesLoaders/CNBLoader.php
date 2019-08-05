<?php

namespace App\Services\RatesLoaders;

use App\Currency;

class CNBLoader implements IRatesLoader
{
    private $sysCurrency = null;
    private $date1;
    private $date2;

    private $url = "https://www.cnb.cz/cs/financni-trhy/devizovy-trh/kurzy-devizoveho-trhu/kurzy-devizoveho-trhu/vybrane.txt";

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

            $fullUrl = $this->url . $this->createParamString($currency->short_name, $date1, $date2);

            $data = $this->getDataFromCNB($fullUrl);

            $rateData = $this->parseData($data, $currency);
            array_push($arrayOfRates, $rateData);
        }

        return $arrayOfRates;


    }

    private function createParamString($currencyCode, $date1, $date2)
    {
        $mena = "mena=" . trim($currencyCode);
        $od = "od=" . $date1->format("d.m.Y");
        $do = "do=" . $date2->format("d.m.Y");

        $params = "?" . implode("&", array($od, $do, $mena, "&format=txt"));

        return $params;
    }

    private function getDataFromCNB($url)
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($curl);

        if (curl_errno($curl)) {
            throw new RatesLoaderException('Request Error:' . curl_error($curl), 3);
        }

        curl_close($curl);

        return $result;
    }

    private function parseData(string $data_txt, $currency)
    {
        $rows = explode("\n", $data_txt);

        $headers = explode("|", $rows[0]);

        $parts_mult = explode(":", $headers[1]);
        $mult = intval($parts_mult[1]);

        if ($mult === -1) {
            throw new RatesLoaderException("Parsing error for currency code: " . $currency->short_name,
                1);
        }

        $rate_data = new RateData($currency);

        for ($i = 2; $i < count($rows); $i++) {
            $row_str = $rows[$i];

            if (empty($row_str)) {
                continue;
            }

            $parts = explode("|", $row_str);

            $date_fmt = (new \DateTime(trim($parts[0])))->format("Y-m-d");

            $rate_data->addRate($date_fmt, floatval(str_replace(",", ".", $parts[1])), $mult);

        }


        return $rate_data;
    }
}
