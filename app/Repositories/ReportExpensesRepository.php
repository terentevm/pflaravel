<?php
/**
 * Created by PhpStorm.
 * User: zaich
 * Date: 05.09.2019
 * Time: 11:07
 */

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ReportExpensesRepository
{
    public static function getExpenses($userId, $dateBegin, $dateEnd, $currency_id, $period = 1)
    {
        $sql = 'select * from report_expenses(?,?,?,?,?) order by period asc';

        $result = DB::select($sql, [$userId, $dateBegin, $dateEnd, $currency_id, $period]);

        return collect($result);
    }
}