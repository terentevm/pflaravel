<?php

namespace App\Listeners;

use App\Events\ExpenseUpdate;
use Illuminate\Support\Facades\DB;
use App\Events\ExpenseCreate;
use App\Expense;
use App\Enums\DocumentType;
use App\Enums\TransactionType;

class ExpenseEventSubscriber
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
            'App\Events\ExpenseCreate',
            'App\Listeners\ExpenseEventSubscriber@handleExpenseCreate'
        );

        $events->listen(
            'App\Events\ExpenseUpdate',
            'App\Listeners\ExpenseEventSubscriber@handleExpenseUpdate'
        );
    }

    /**
     * Handle the event.
     *
     * @param  ExpenseCreate $event
     * @return void
     */
    public function handleExpenseCreate(ExpenseCreate $event)
    {
        $this->createMoneyTransaction($event->model);
        $this->AddToExpensesRegister($event->model);
    }

    /**
     * Handle the event.
     *
     * @param  ExpenseUpdate $event
     * @return void
     */
    public function handleExpenseUpdate(ExpenseUpdate $event)
    {
        $this->updateMoneyTransaction($event->model);

        $this->AddToExpensesRegister($event->model);
    }

    private function createMoneyTransaction(Expense $expense)
    {
        $expense->transactionReg()->create([
            'user_id' => $expense->user_id,
            'date' => $expense->date,
            'wallet_id' => $expense->wallet_id,
            'document_id' => $expense->id,
            'document_type' => DocumentType::Expense,
            'type' => TransactionType::Expense,
            'sum' => floatval($expense->sum * -1)
        ]);
    }

    private function updateMoneyTransaction(Expense $expense)
    {
        $expense->transactionReg()->update([
            'date' => $expense->date,
            'wallet_id' => $expense->wallet_id,
            'sum' => floatval($expense->sum * -1)
        ]);
    }

    private function AddToExpensesRegister(Expense $expense)
    {
        $sql = 'SELECT FROM add_to_reg_expenses(:expendId)';
        DB::statement($sql, ['expendId' => $expense->id]);
    }
}
