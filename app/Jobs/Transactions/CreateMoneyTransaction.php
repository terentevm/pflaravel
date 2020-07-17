<?php


namespace App\Jobs\Transactions;

use Illuminate\Database\Eloquent\Model;

class CreateMoneyTransaction
{
    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function handle()
    {

    }

    protected function createTransaction(array $data) : void
    {
        \App\RegMoneyTransaction::create($data);
    }
}