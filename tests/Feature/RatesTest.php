<?php

namespace Tests\Feature;

use App\Rates;
use App\User;
use Tests\TestCase;
use Carbon\Carbon;

class RatesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetLastRates()
    {
        $user = new User([
            'id' => '6f046823-206b-4a3b-8c66-d03879b4c8e0',
            'login' => 'mick911@mail.ru'
        ]);

        $currencies = [
            "7e2776cf-3bab-4631-9fce-953703c134d6",
            "f9132e88-9057-41a0-bcd7-6f3ac963ad9b"
        ];
        $date = Carbon::parse('2019-02-03');

        Rates::getLastRates($user, $currencies, $date);
    }
}
