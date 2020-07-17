<?php


namespace App\Jobs\Documents\Income;


use App\Income;
use App\Jobs\IJob;
use Illuminate\Support\Facades\DB;

class UpdateIncome implements IJob
{

    protected $income;
    protected $data;

    public function __construct(Income $income, $data)
    {
        $this->income = $income;
        $this->data = $data;
    }

    public function handle()
    {
        DB::beginTransaction();

        $this->income->rows()->delete();

        $this->income->update($this->data);

        $this->income->rows()->createMany($this->data['rows']);

        event(new \App\Events\IncomeUpdate($this->income));

        DB::commit();


    }

}