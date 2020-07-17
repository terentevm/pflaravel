<?php


namespace App\Jobs\Documents\Transfer;


use App\Jobs\IJob;
use App\Transfer;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\Authenticatable;

class CreateTransfer implements IJob
{
    private $data;
    private $user;

    public function __construct(Authenticatable $user, $data)
    {
        $this->user = $user;
        $this->data = $data;
    }

    public function handle()
    {
        DB::beginTransaction();

        $transfer = new Transfer($this->data);
        $transfer->setUser($this->user);
        $transfer->save();

        event(new \App\Events\TransferCreate($transfer));

        DB::commit();

        return $transfer;
    }
}