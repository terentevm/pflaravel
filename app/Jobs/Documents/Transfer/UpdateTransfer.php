<?php


namespace App\Jobs\Documents\Transfer;


use App\Jobs\IJob;
use App\Transfer;
use Illuminate\Support\Facades\DB;

class UpdateTransfer implements IJob
{
    protected $transfer;
    protected $data;

    public function __construct(Transfer $transfer, $data)
    {
        $this->transfer = $transfer;
        $this->data = $data;
    }

    public function handle()
    {
        DB::beginTransaction();

        $this->transfer->update($this->data);

        event(new \App\Events\TransferUpdate($this->transfer));

        DB::commit();

    }
}