<?php

namespace App\Listeners;

use App\Events\TransferCreate;
use App\Events\TransferUpdate;
use App\Transfer;
use App\Enums\DocumentType;
use App\Enums\TransactionType;

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
        $this->createMoneyTransaction($event->model);
    }

    public function handleTransferUpdate(TransferUpdate $event)
    {
        $this->updateMoneyTransaction($event->model);
    }

    private function createMoneyTransaction(Transfer $transfer)
    {
        $transfer->transactionReg()->createMany([
            [
                'user_id' => $transfer->user_id,
                'date' => $transfer->date,
                'wallet_id' => $transfer->wallet_id_from,
                'document_id' => $transfer->id,
                'document_type' => DocumentType::Transfer,
                'type' => TransactionType::Expense,
                'sum' => floatval($transfer->sum_from * -1)
            ],
            [
                'user_id' => $transfer->user_id,
                'date' => $transfer->date,
                'wallet_id' => $transfer->wallet_id_to,
                'document_id' => $transfer->id,
                'document_type' => DocumentType::Transfer,
                'type' => TransactionType::Income,
                'sum' => floatval($transfer->sum_to)
            ]
        ]);
    }

    private function updateMoneyTransaction(Transfer $transfer)
    {
        $transfer->transactionReg()->delete();

        $this->createMoneyTransaction($transfer);

    }
}
