<?php
/**
 * Created by PhpStorm.
 * User: zaich
 * Date: 21.08.2019
 * Time: 12:51
 */

namespace App\Events;


use App\Expense;

class RegExpensesEvent
{
    public $model = null;
    /**
     * Create a new event instance.
     *
     * @param  \App\Expense  $model
     * @return void
     */
    public function __construct(Expense $model)
    {
        $this->model = $model;

    }
}