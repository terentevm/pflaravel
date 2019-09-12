<?php
/**
 * Created by PhpStorm.
 * User: zaich
 * Date: 21.08.2019
 * Time: 12:58
 */

namespace App\Events;

use App\Income;

class RegIncomeEvent
{
    public $model = null;
    /**
     * Create a new event instance.
     *
     * @param  \App\Income  $model
     * @return void
     */
    public function __construct(Income $model)
    {
        $this->model = $model;

    }
}