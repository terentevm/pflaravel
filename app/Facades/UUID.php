<?php
/**
 * Created by PhpStorm.
 *
 * Date: 24.07.2019
 * Time: 14:04
 */

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class UUID extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'uuid';
    }
}