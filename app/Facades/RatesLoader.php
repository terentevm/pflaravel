<?php
/**
 * Created by PhpStorm.
 * User: zaich
 * Date: 02.08.2019
 * Time: 20:23
 */

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class RatesLoader extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'RateLoader';
    }
}