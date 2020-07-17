<?php


namespace App\Jobs\Documents\ChangeBalance;


use App\ChangeBalance;
use App\Jobs\IJob;
use Illuminate\Support\Facades\DB;

class UpdateChangeBalance implements IJob
{
    protected $cb;
    protected $data;

    public function __construct(ChangeBalance $cb, $data)
    {
        $this->cb = $cb;
        $this->data = $data;
    }

    public function handle()
    {
        DB::beginTransaction();

        $this->cb->update($this->data);

        event(new \App\Events\ChangeBalanceUpdate($this->cb));

        DB::commit();

    }
}