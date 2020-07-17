<?php

namespace App\Listeners;

use App\Debt;
use App\Events\DebtCreate;
use App\Events\DebtUpdate;

use App\Enums\DocumentType;
use App\Enums\TransactionType;
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
        $this->createMoneyTransaction($event->model);
    }

    public function handleDebtUpdate(DebtUpdate $event)
    {

        $this->updateMoneyTransaction($event->model);

    }

    private function createMoneyTransaction(Debt $debt)
    {

        $sum = $debt->type === 'borrow_money' || $debt->type === 'repay_money'
            ? $debt->debit
            : $debt->credit * -1;

        $t_type = $debt->type === 'borrow_money' || $debt->type === 'repay_money'
            ? TransactionType::Income
            : TransactionType::Expense;

        $debt->transactionReg()->create([
            'user_id' => $debt->user_id,
            'date' => $debt->date,
            'wallet_id' => $debt->wallet_id,
            'document_id' => $debt->id,
            'document_type' => DocumentType::Debt,
            'type' => $t_type,
            'sum' => $sum
        ]);
    }

    private function updateMoneyTransaction(Debt $debt)
    {

        $sum = $debt->type === 'borrow_money' || $debt->type === 'repay_money'
            ? $debt->debit
            : $debt->credit * -1;

        $t_type = $debt->type === 'borrow_money' || $debt->type === 'repay_money'
            ? TransactionType::Income
            : TransactionType::Expense;

        $debt->transactionReg()->update([
            'date' => $debt->date,
            'wallet_id' => $debt->wallet_id,
            'type' => $t_type,
            'sum' => floatval($sum)
        ]);
    }
}
