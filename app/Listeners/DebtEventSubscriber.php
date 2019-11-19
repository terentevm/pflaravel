<?php

namespace App\Listeners;

use App\Debt;
use App\Events\DebtCreate;
use App\Events\DebtUpdate;
use App\RegMoneyTransaction;

class DebtEventSubscriber
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
            'App\Events\DebtCreate',
            'App\Listeners\DebtEventSubscriber@handleDebtCreate'
        );

        $events->listen(
            'App\Events\DebtUpdate',
            'App\Listeners\DebtEventSubscriber@handleDebtUpdate'
        );
    }

    public function handleDebtCreate(DebtCreate $event)
    {
        $this->addToMoneyTransactionRegister($event->model);
    }

    public function handleDebtUpdate(DebtUpdate $event)
    {

        $records = RegMoneyTransaction::where('lend_id', $event->model->id);
        $records->delete();

        $this->addToMoneyTransactionRegister($event->model);

    }

    private function addToMoneyTransactionRegister(Debt $debt)
    {
        $sum = $debt->type === 'borrow_money' || $debt->type === 'repay_money'
            ? $debt->debit
            : $debt->credit * -1;

        RegMoneyTransaction::create([
            'user_id' => $debt->user_id,
            'date' => $debt->date,
            'wallet_id' => $debt->wallet_id,
            'expend_id' => null,
            'income_id' => null,
            'transfer_id' => null,
            'cb_id' => null,
            'lend_id' => $debt->id,
            'sum' => $sum
        ]);
    }
}
