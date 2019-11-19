<?php

namespace App\Events;

use App\Debt;

class DebtCreate
{

    public $model;

    /**
     * Create a new event instance.
     * @param \App\Debt $debt
     * @return void
     */
    public function __construct(Debt $debt)
    {
        $this->model = $debt;
    }

}
