<?php


namespace App\Jobs;


use App\Currency;

class UpdateCurrency
{
    private $data;
    private $currency;

    public function __construct(Currency $currency, $data)
    {
        $this->currency = $currency;
        $this->data = $data;
    }

    public function handle()
    {
        $this->currency->update($this->data);

        return $this->currency;
    }
}