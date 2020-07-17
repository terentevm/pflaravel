<?php


namespace App\Jobs\Documents\Debt;


use App\Debt;
use App\Jobs\IJob;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\Authenticatable;

class CreateDebt implements IJob
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

        $debt = new Debt($this->data);
        $debt->setUser($this->user);
        $debt->save();

        event(new \App\Events\DebtCreate($debt));

        DB::commit();

        return $debt;
    }
}