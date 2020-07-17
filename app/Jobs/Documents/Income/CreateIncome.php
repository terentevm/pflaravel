<?php


namespace App\Jobs\Documents\Income;


use App\Income;
use App\Jobs\IJob;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\DB;

class CreateIncome implements IJob
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

        $income = new Income($this->data);
        $income->setUser($this->user);
        $income->save();

        $income->rows()->createMany($this->data['rows']);

        event(new \App\Events\IncomeCreate($income));

        DB::commit();

        return $income;
    }
}