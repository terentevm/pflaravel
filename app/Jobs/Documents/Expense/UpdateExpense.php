<?php


namespace App\Jobs\Documents\Expense;

use App\Expense;
use App\Jobs\IJob;
use App\User;
use Illuminate\Support\Facades\DB;

class UpdateExpense implements IJob
{
    protected $expense;
    protected $data;

    public function __construct(Expense $expense, $data)
    {
        $this->expense = $expense;
        $this->data = $data;
    }

    public function handle()
    {
        DB::beginTransaction();

        $this->expense->rows()->delete();

        $this->expense->update($this->data);

        $this->expense->rows()->createMany($this->data['rows']);

        event(new \App\Events\ExpenseUpdate($this->expense));

        DB::commit();

    }
}