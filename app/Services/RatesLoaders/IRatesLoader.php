<?php

namespace App\Services\RatesLoaders;

interface IRatesLoader
{
    /**
     * Loads currency rates from bank's api.
     * @param array Currency[] An array containing the currency to load. Each array element must be a database selection.
     * @param \DateTime $date1 'Y-m-d'
     * @param \DateTime $date2 'Y-m-d'
     * @return array RateData[]
     * @throws RatesLoaderException
     */
    public function load(array $currencyList, \DateTime $date1, \DateTime $date2) : array;
}
