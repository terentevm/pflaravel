<?php
/**
 * Created by PhpStorm.
 * User: zaich
 * Date: 14.09.2019
 * Time: 22:21
 */

namespace App\Filters;


class IncomeFilters extends FiltersAbstract
{
    protected $filters = [
        'begin' => BeginFilter::class,
        'end' => EndFilter::class,
        'wallet' => WalletFilter::class
    ];
}