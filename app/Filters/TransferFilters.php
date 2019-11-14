<?php
/**
 * Created by PhpStorm.
 *
 * Date: 17.09.2019
 * Time: 17:48
 */

namespace App\Filters;


class TransferFilters extends FiltersAbstract
{
    protected $filters = [
        'begin' => BeginFilter::class,
        'end' => EndFilter::class,
        'wallet_from' => WalletFromFilter::class,
        'wallet_to' => WalletToFilter::class
    ];
}