<?php
/**
 * Created by PhpStorm.
 * User: zaich
 * Date: 05.09.2019
 * Time: 11:07
 */

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ReportIncomesRepository
{
    public static function getIncomes($userId, $dateBegin, $dateEnd, $currency_id, $period = 1)
    {
        $sql = 'select * from report_incomes(?,?,?,?,?) order by period asc';
        $result = DB::select($sql, [$userId, $dateBegin, $dateEnd, $currency_id, $period]);

        return collect($result);
    }
}