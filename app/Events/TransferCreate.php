<?php

namespace App\Events;

use App\Transfer;

class TransferCreate
{
    public $model;

    /**
     * Create a new event instance.
     * @param \App\Transfer $transfer
     * @return void
     */
    public function __construct(Transfer $transfer)
    {
        $this->model = $transfer;
    }


}
