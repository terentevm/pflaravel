<?php

namespace App\Listeners;

use App\Events\IncomeCreate;
use App\Events\IncomeUpdate;
use App\Income;
use App\RegMoneyTransaction;
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
        $this->addToMoneyTransactionRegister($event->model);
        $this->AddToIncomeRegister($event->model);

    }

    public function handleIncomeUpdate(IncomeUpdate $event)
    {
        $records = RegMoneyTransaction::where('income_id', $event->model->id);
        $records->delete();
    }

    private function addToMoneyTransactionRegister(Income $income)
    {
        RegMoneyTransaction::create([
            'user_id' => $income->user_id,
            'date' => $income->date,
            'wallet_id' => $income->wallet_id,
            'expend_id' => null,
            'income_id' => $income->id,
            'transfer_id' => null,
            'cb_id' => null,
            'lend_id' => null,
            'sum' => floatval($income->sum)
        ]);
    }

    private function AddToIncomeRegister(Income $income)
    {
        $sql = 'SELECT FROM add_to_reg_incomes(:incomeId)';
        DB::statement($sql, ['incomeId' => $income->id]);
    }

}
