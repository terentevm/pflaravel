<?php


namespace App\Jobs;


use App\Currency;

class CreateCurrency
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        return Currency::create($this->data);
    }
}