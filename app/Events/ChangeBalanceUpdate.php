<?php

namespace App\Events;

use App\ChangeBalance;

class ChangeBalanceUpdate
{
    public $model;

    /**
     * Create a new event instance.
     * @param \App\ChangeBalance $cb
     * @return void
     */
    public function __construct(ChangeBalance $cb)
    {
        $this->model = $cb;
    }
}
