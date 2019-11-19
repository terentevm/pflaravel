<?php

namespace App\Events;

use App\Expense;

class ExpenseUpdate
{
    public $model = null;

    /**
     * Create a new event instance.
     * @param \App\Expense $expense
     * @return void
     */
    public function __construct(Expense $expense)
    {
        $this->model = $expense;
    }

}
