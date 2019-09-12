<?php
/**
 * Created by PhpStorm.
 * User: zaich
 * Date: 20.08.2019
 * Time: 11:17
 */

namespace App\Listeners;

use App\ChangeBalance;
use App\Debt;
use App\Events\MoneyTransactionEvent;
use App\Expense;
use App\Income;
use App\RegMoneyTransaction;
use App\Transfer;

class MoneyTransactionHandler
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
     * Handle the event.
     *
     * @param  \App\Events\MoneyTransactionEvent $event
     * @return void
     */
    public function handle(MoneyTransactionEvent $event)
    {

        switch ($event) {
            case $event->model instanceof Expense:

                $this->createTransactionFromExpense($event->model, $event->eventType);
                break;

            case $event->model instanceof Income:

                $this->createTransactionFromIncome($event->model, $event->eventType);
                break;

            case $event->model instanceof Transfer:

                $this->createTransactionFromTransfer($event->model, $event->eventType);
                break;

            case $event->model instanceof ChangeBalance:

                $this->createTransactionFromChangeBalance($event->model, $event->eventType);
                break;

            case $event->model instanceOf Debt:

                $this->createTransactionFromDebt($event->model, $event->eventType);
                break;

            default:
                return;
        }
    }

    private function createTransactionFromExpense(Expense $model, string $eventType)
    {
        if ($eventType === 'update') {
            $records = RegMoneyTransaction::where('expend_id', $model->id);
            $records->delete();
        }

        RegMoneyTransaction::create([
            'user_id' => $model->user_id,
            'date' => $model->date,
            'wallet_id' => $model->wallet_id,
            'expend_id' => $model->id,
            'income_id' => null,
            'transfer_id' => null,
            'cb_id' => null,
            'lend_id' => null,
            'sum' => $model->sum * -1
        ]);


    }

    private function createTransactionFromIncome(Income $model, string $eventType)
    {
        if ($eventType === 'update') {
            $records = RegMoneyTransaction::where('income_id', $model->id);
            $records->delete();
        }

        $collapsed_rows = [];

        $model->rows->map(function ($item) use (&$collapsed_rows) {

            if (array_key_exists($item->wallet_id, $collapsed_rows)) {
                $collapsed_rows[$item->wallet_id] += $item->sum;
            } else {
                $collapsed_rows[$item->wallet_id] = floatval($item->sum);
            }

        });

        foreach ($collapsed_rows as $wallet_id => $sum) {
            RegMoneyTransaction::create([
                'user_id' => $model->user_id,
                'date' => $model->date,
                'wallet_id' => $wallet_id,
                'expend_id' => null,
                'income_id' => $model->id,
                'transfer_id' => null,
                'cb_id' => null,
                'lend_id' => null,
                'sum' => $sum
            ]);
        }

    }

    private function createTransactionFromTransfer(Transfer $model, string $eventType)
    {
        if ($eventType === 'update') {
            $records = RegMoneyTransaction::where('transfer_id', $model->id);
            $records->delete();
        }

        RegMoneyTransaction::create([
            'user_id' => $model->user_id,
            'date' => $model->date,
            'wallet_id' => $model->wallet_id_from,
            'expend_id' => null,
            'income_id' => null,
            'transfer_id' => $model->id,
            'cb_id' => null,
            'lend_id' => null,
            'sum' => $model->sum_from * -1
        ]);

        RegMoneyTransaction::create([
            'user_id' => $model->user_id,
            'date' => $model->date,
            'wallet_id' => $model->wallet_id_to,
            'expend_id' => null,
            'income_id' => null,
            'transfer_id' => $model->id,
            'cb_id' => null,
            'lend_id' => null,
            'sum' => $model->sum_to
        ]);
    }

    private function createTransactionFromChangeBalance(ChangeBalance $model, string $eventType)
    {
        if ($eventType === 'update') {
            $records = RegMoneyTransaction::where('cb_id', $model->id);
            $records->delete();
        }

        RegMoneyTransaction::create([
            'user_id' => $model->user_id,
            'date' => $model->date,
            'wallet_id' => $model->wallet_id,
            'expend_id' => null,
            'income_id' => null,
            'transfer_id' => null,
            'cb_id' => $model->id,
            'lend_id' => null,
            'sum' => $model->sum_income > 0 ? $model->sum_income : $model->sum_expend * -1
        ]);

    }

    private function createTransactionFromDebt(Debt $model, string $eventType)
    {
        if ($eventType === 'update') {
            $records = RegMoneyTransaction::where('lend_id', $model->id);
            $records->delete();
        }

        $sum = $model->type === 'borrow_money' || $model->type === 'repay_money'
            ? $model->debit
            : $model->credit * -1;


        RegMoneyTransaction::create([
            'user_id' => $model->user_id,
            'date' => $model->date,
            'wallet_id' => $model->wallet_id,
            'expend_id' => null,
            'income_id' => null,
            'transfer_id' => null,
            'cb_id' => null,
            'lend_id' => $model->id,
            'sum' => $sum
        ]);

    }
}