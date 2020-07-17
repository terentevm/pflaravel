<?php


namespace App\Jobs\Documents\Expense;

use App\Expense;
use App\Jobs\IJob;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\DB;

class CreateExpense implements IJob
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

        $expense = new Expense($this->data);
        $expense->setUser($this->user);
        $expense->save();

        $expense->rows()->createMany($this->data['rows']);

        event(new \App\Events\ExpenseCreate($expense));

        DB::commit();

        return $expense;
    }

}