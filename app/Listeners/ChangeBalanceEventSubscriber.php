<?php

namespace App\Listeners;

use App\ChangeBalance;
use App\Events\ChangeBalanceCreate;
use App\Events\ChangeBalanceUpdate;
use App\Enums\DocumentType;
use App\Enums\TransactionType;

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
        $this->createMoneyTransaction($event->model);
    }

    public function handleChangeBalanceUpdate(ChangeBalanceUpdate $event)
    {
        $this->updateMoneyTransaction($event->model);
    }

    private function createMoneyTransaction(ChangeBalance $cb)
    {
        $t_type = $cb->sum_income > 0 ? TransactionType::Income : TransactionType::Expense;

        $cb->transactionReg()->create([
            'user_id' => $cb->user_id,
            'date' => $cb->date,
            'wallet_id' => $cb->wallet_id,
            'document_id' => $cb->id,
            'document_type' => DocumentType::ChangeBalance,
            'type' => $t_type,
            'sum' => $cb->sum_income > 0 ? $cb->sum_income : $cb->sum_expend * -1
        ]);
    }

    private function updateMoneyTransaction(ChangeBalance $cb)
    {
        $t_type = $cb->sum_income > 0 ? TransactionType::Income : TransactionType::Expense;

        $cb->transactionReg()->update([
            'date' => $cb->date,
            'wallet_id' => $cb->wallet_id,
            'type' => $t_type,
            'sum' => $cb->sum_income > 0 ? $cb->sum_income : $cb->sum_expend * -1
        ]);
    }
}
