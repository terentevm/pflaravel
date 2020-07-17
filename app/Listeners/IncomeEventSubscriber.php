<?php

namespace App\Listeners;

use App\Enums\DocumentType;
use App\Enums\TransactionType;
use App\Events\IncomeCreate;
use App\Events\IncomeUpdate;
use App\Income;
use Illuminate\Support\Facades\DB;

class IncomeEventSubscriber
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
            'App\Events\IncomeCreate',
            'App\Listeners\IncomeEventSubscriber@handleIncomeCreate'
        );

        $events->listen(
            'App\Events\IncomeUpdate',
            'App\Listeners\IncomeEventSubscriber@handleIncomeUpdate'
        );
    }

    public function handleIncomeCreate(IncomeCreate $event)
    {
        $this->createMoneyTransaction($event->model);
        $this->AddToIncomeRegister($event->model);

    }

    public function handleIncomeUpdate(IncomeUpdate $event)
    {
        $this->updateMoneyTransaction($event->model);

        $this->AddToIncomeRegister($event->model);
    }

    private function createMoneyTransaction(Income $income)
    {
        $income->transactionReg()->create([
            'user_id' => $income->user_id,
            'date' => $income->date,
            'wallet_id' => $income->wallet_id,
            'document_id' => $income->id,
            'document_type' => DocumentType::Income,
            'type' => TransactionType::Income,
            'sum' => floatval($income->sum)
        ]);
    }

    private function updateMoneyTransaction(Income $income)
    {
        $income->transactionReg()->update([
            'date' => $income->date,
            'wallet_id' => $income->wallet_id,
            'sum' => floatval($income->sum)
        ]);
    }

    private function AddToIncomeRegister(Income $income)
    {
        $sql = 'SELECT FROM add_to_reg_incomes(:incomeId)';
        DB::statement($sql, ['incomeId' => $income->id]);
    }

}
