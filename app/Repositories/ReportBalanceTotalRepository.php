<?php
/**
 * Created by PhpStorm.
 * User: zaich
 * Date: 29.08.2019
 * Time: 14:56
 */

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ReportBalanceTotalRepository
{
    public function getBalanceTotal(string $userId, string $date)
    {
        $sql = 'SELECT * FROM balance_total(?,?)';

    }
}