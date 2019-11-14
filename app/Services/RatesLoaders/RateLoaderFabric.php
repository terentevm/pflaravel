<?php
/**
 * Created by PhpStorm.
 *
 * Date: 02.08.2019
 * Time: 20:28
 */

namespace App\Services\RatesLoaders;

use App\Currency;

class RateLoaderFabric
{
    public function load(Currency $sysCurrency, $currencies, \DateTime $date1, \DateTime $date2)
    {
        switch (strtoupper(trim($sysCurrency->short_name))) {
            case 'RUB':
                $loader = new RUCBLoader($sysCurrency);
                break;
            case 'EUR':
                $loader = new ECBLoader($sysCurrency);
                break;
            case 'CZK':
                $loader = new CNBLoader($sysCurrency);
                break;
            default:
                throw new RatesLoaderException('Rates loader support only RUB, EUR or CZK as a system currency');
        }

        return $loader->load($currencies, $date1, $date2);
    }
}