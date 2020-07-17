<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\RegMoneyTransaction;
use App\User;
class TransactionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $user = User::where('login', 'mick911@mail.ru')->first();
        $this->be($user);
        $sql = RegMoneyTransaction::with('Wallet', 'Wallet.Currency')->limit(50)->get()->toArray();
    }
}
