<?php
/**
 * Created by PhpStorm.
 *
 * Date: 21.08.2019
 * Time: 12:49
 */

namespace App\Listeners;

use App\Events\RegExpensesEvent;
use Illuminate\Support\Facades\DB;

class RegExpensesListener
{
    public function handle(RegExpensesEvent $event)
    {
        $sql = 'SELECT FROM add_to_reg_expenses(:expendId)';
        DB::statement($sql, ['expendId' => $event->model->id]);
    }
}