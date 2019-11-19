<?php

namespace App\Listeners;

use App\Events\TransferCreate;
use App\Events\TransferUpdate;
use App\Transfer;
use App\RegMoneyTransaction;

class TransferEventSubscriber
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
            'App\Events\TransferCreate',
            'App\Listeners\TransferEventSubscriber@handleTransferCreate'
        );

        $events->listen(
            'App\Events\TransferUpdate',
            'App\Listeners\TransferEventSubscriber@handleTransferUpdate'
        );
    }

    public function handleTransferCreate(TransferCreate $event)
    {
        $this->addToMoneyTransactionRegister($event->model);
    }

    public function handleTransferUpdate(TransferUpdate $event)
    {
        $records = RegMoneyTransaction::where('transfer_id', $event->model->id);
        $records->delete();

        $this->addToMoneyTransactionRegister($event->model);
    }

    private function addToMoneyTransactionRegister(Transfer $transfer)
    {
        RegMoneyTransaction::create([
            'user_id' => $transfer->user_id,
            'date' => $transfer->date,
            'wallet_id' => $transfer->wallet_id_from,
            'expend_id' => null,
            'income_id' => null,
            'transfer_id' => $transfer->id,
            'cb_id' => null,
            'lend_id' => null,
            'sum' => $transfer->sum_from * -1
        ]);

        RegMoneyTransaction::create([
            'user_id' => $transfer->user_id,
            'date' => $transfer->date,
            'wallet_id' => $transfer->wallet_id_to,
            'expend_id' => null,
            'income_id' => null,
            'transfer_id' => $transfer->id,
            'cb_id' => null,
            'lend_id' => null,
            'sum' => $transfer->sum_to
        ]);
    }
}
