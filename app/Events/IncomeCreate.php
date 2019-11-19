<?php

namespace App\Events;

use App\Income;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class IncomeCreate
{
    public $model;

    /**
     * Create a new event instance.
     * @param \App\Income $income
     *
     * @return void
     */
    public function __construct(Income $income)
    {
        $this->model = $income;
    }
}
