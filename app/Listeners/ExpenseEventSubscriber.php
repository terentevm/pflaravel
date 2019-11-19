<?php

namespace App\Listeners;

use App\Events\ExpenseUpdate;
use Illuminate\Support\Facades\DB;
use App\Events\ExpenseCreate;
use App\Expense;
use App\RegMoneyTransaction;

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
        $this->addToMoneyTransactionRegister($event->model);
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
        $records = RegMoneyTransaction::where('expend_id', $event->model->id);
        $records->delete();

        $this->addToMoneyTransactionRegister($event->model);

        $this->AddToExpensesRegister($event->model);
    }

    private function addToMoneyTransactionRegister(Expense $expense)
    {
        RegMoneyTransaction::create([
            'user_id' => $expense->user_id,
            'date' => $expense->date,
            'wallet_id' => $expense->wallet_id,
            'expend_id' => $expense->id,
            'income_id' => null,
            'transfer_id' => null,
            'cb_id' => null,
            'lend_id' => null,
            'sum' => $expense->sum * -1
        ]);
    }

    private function AddToExpensesRegister(Expense $expense)
    {
        $sql = 'SELECT FROM add_to_reg_expenses(:expendId)';
        DB::statement($sql, ['expendId' => $expense->id]);
    }
}
