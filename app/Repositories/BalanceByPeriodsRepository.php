<?php
/**
 * Created by PhpStorm.
 *
 * Date: 09.09.2019
 * Time: 14:58
 */

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class BalanceByPeriodsRepository
{
    public function getBalanceByPeriods(
        string $userId,
        string $begin,
        string $end,
        string $currencyId,
        string $periodicity
    ) {
        $result = DB::select(
            'select * from balance_by_periods(?,?,?,?,?)',
            [
                $userId,
                $begin,
                $end,
                $currencyId,
                $this->convertPeriodicityToPostgresFormat($periodicity)
            ]
        );

        return $result;
    }

    private function convertPeriodicityToPostgresFormat(string $periodicity)
    {
        switch ($periodicity) {
            case 'year':
                return '1 year';
                break;
            case 'month':
                return '1 month';
                break;
            case 'week':
                return '1 week';
                break;
            case 'day':
                return '1 day';
                break;
            default:
                return '1 month';

        }
    }
}