<?php
/**
 * Created by PhpStorm.
 * User: zaich
 * Date: 21.08.2019
 * Time: 12:59
 */

namespace App\Listeners;

use App\Events\RegIncomeEvent;
use Illuminate\Support\Facades\DB;

class RegIncomeListener
{
    public function handle(RegIncomeEvent $event)
    {
        $sql = 'SELECT FROM add_to_reg_incomes(:incomeId)';
        $res = DB::statement($sql, ['incomeId' => $event->model->id]);
    }
}