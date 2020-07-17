<?php


namespace App\Jobs\Documents\Debt;


use App\Debt;
use App\Jobs\IJob;
use Illuminate\Support\Facades\DB;

class UpdateDebt implements IJob
{
    protected $debt;
    protected $data;

    public function __construct(Debt $debt, $data)
    {
        $this->debt = $debt;
        $this->data = $data;
    }

    public function handle()
    {
        DB::beginTransaction();

        $this->debt->update($this->data);

        event(new \App\Events\DebtUpdate($this->debt));

        DB::commit();

    }
}