<?php

namespace Tests\Unit;

use App\Currency;
use App\Facades\RatesLoader;
use App\Facades\UUID;
use Tests\TestCase;

class RatesLoaderTest extends TestCase
{
    public function testRatesLoaderRUB()
    {
        $sysCurrency = new Currency([
            "id" => UUID::gen(),
            "name" => "Russian rouble",
            "short_name" => "RUB",
            "code" => "643",
            "mult" => 1
        ]);

        $date1 = \DateTime::createFromFormat('Y-m-d', '2019-01-07');
        $date2 = \DateTime::createFromFormat('Y-m-d', '2019-01-31');

        $rates = RatesLoader::load($sysCurrency, $this->getCurrencyList(), $date1, $date2);

        $this->assertContainsOnlyInstancesOf('App\Services\RatesLoaders\RateData', $rates);
    }

    public function testRatesLoaderEUR()
    {
        $sysCurrency = new Currency([
            "name" => "Euro",
            "short_name" => "EUR",
            "code" => "978",
            "mult" => 1
        ]);

        $date1 = \DateTime::createFromFormat('Y-m-d', '2019-01-07');
        $date2 = \DateTime::createFromFormat('Y-m-d', '2019-01-31');

        $rates = RatesLoader::load($sysCurrency, $this->getCurrencyList(), $date1, $date2);

        $this->assertContainsOnlyInstancesOf('App\Services\RatesLoaders\RateData', $rates);
    }

    public function testRatesLoaderCZK()
    {
        $sysCurrency = new Currency([
            "id" => UUID::gen(),
            "name" => "Czech koruna",
            "short_name" => "CZK",
            "code" => "203",
            "mult" => 1
        ]);

        $date1 = \DateTime::createFromFormat('Y-m-d', '2019-01-07');
        $date2 = \DateTime::createFromFormat('Y-m-d', '2019-01-31');

        $rates = RatesLoader::load($sysCurrency, $this->getCurrencyList(), $date1, $date2);

        $this->assertContainsOnlyInstancesOf('App\Services\RatesLoaders\RateData', $rates);

    }

    /**
     * @expectedException App\Services\RatesLoaders\RatesLoaderException
     */
    public function testRatesLoaderFake()
    {
        $sysCurrency = new Currency([
            "id" => UUID::gen(),
            "name" => "Hungarian forint",
            "short_name" => "HUF",
            "code" => "348",
            "mult" => 1
        ]);

        $date1 = \DateTime::createFromFormat('Y-m-d', '2019-01-07');
        $date2 = \DateTime::createFromFormat('Y-m-d', '2019-01-31');

        $rates = RatesLoader::load($sysCurrency, $this->getCurrencyList(), $date1, $date2);

        $this->assertContainsOnlyInstancesOf('App\Services\RatesLoaders\RateData', $rates);
    }

    public function getCurrencyList()
    {
        $currency_rub = new Currency([
            "id" => UUID::gen(),
            "name" => "Russian rouble",
            "short_name" => "RUB",
            "code" => "643",
            "mult" => 1
        ]);

        $currency_huf = new Currency([
            "id" => UUID::gen(),
            "name" => "Hungarian forint",
            "short_name" => "HUF",
            "code" => "348",
            "mult" => 1
        ]);

        $currency_eur = new Currency([
            "id" => UUID::gen(),
            "name" => "Euro",
            "short_name" => "EUR",
            "code" => "978",
            "mult" => "1"
        ]);

        $currency_czk = new Currency([
            "id" => UUID::gen(),
            "name" => "Czech koruna",
            "short_name" => "CZK",
            "code" => "203",
            "mult" => "1"
        ]);

        return array($currency_rub, $currency_czk, $currency_huf, $currency_eur);
    }

}
