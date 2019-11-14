<?php
/**
 * Created by PhpStorm.
 *
 * Date: 10.10.2019
 * Time: 17:43
 */

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ReportCompareExpensesIncomesRepository
{
    public function getData(string $userId, string $begin, string $end, string $currencyId)
    {
        $result = DB::select(
            'select * from comparison_expenses_incomes_by_periods(?,?,?,?)',
            [
                $userId,
                $begin,
                $end,
                $currencyId
            ]
        );

        return $result;
    }
}