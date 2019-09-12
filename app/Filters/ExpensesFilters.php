<?php
/**
 * Created by PhpStorm.
 * User: zaich
 * Date: 19.08.2019
 * Time: 15:13
 */

namespace App\Filters;

use App\Filters\BeginFilter;

class ExpensesFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'begin' => BeginFilter::class,
        'end' => EndFilter::class,
        'wallet' => WalletFilter::class
    ];
}