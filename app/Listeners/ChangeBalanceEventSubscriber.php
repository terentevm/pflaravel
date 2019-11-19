<?php

namespace App\Listeners;

use App\ChangeBalance;
use App\Events\ChangeBalanceCreate;
use App\Events\ChangeBalanceUpdate;
use App\RegMoneyTransaction;

class ChangeBalanceEventSubscriber
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {

        $events->listen(
            'App\Events\ChangeBalanceCreate',
            'App\Listeners\ChangeBalanceEventSubscriber@handleChangeBalanceCreate'
        );

        $events->listen(
            'App\Events\ChangeBalanceUpdate',
            'App\Listeners\ChangeBalanceEventSubscriber@handleChangeBalanceUpdate'
        );
    }

    public function handleChangeBalanceCreate(ChangeBalanceCreate $event)
    {
        $this->addToMoneyTransactionRegister($event->model);
    }

    public function handleChangeBalanceUpdate(ChangeBalanceUpdate $event)
    {
        $records = RegMoneyTransaction::where('cb_id', $event->model->id);
        $records->delete();

        $this->addToMoneyTransactionRegister($event->model);
    }

    private function addToMoneyTransactionRegister(ChangeBalance $cb)
    {
        RegMoneyTransaction::create([
            'user_id' => $cb->user_id,
            'date' => $cb->date,
            'wallet_id' => $cb->wallet_id,
            'expend_id' => null,
            'income_id' => null,
            'transfer_id' => null,
            'cb_id' => $cb->id,
            'lend_id' => null,
            'sum' => $cb->sum_income > 0 ? $cb->sum_income : $cb->sum_expend * -1
        ]);
    }
}
