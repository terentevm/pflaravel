<?php

namespace Tests\Feature;

use App\Income;
use App\IncomeRow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

use App\Wallet;
use App\User;
use App\ItemIncome;
use App\Events\IncomeCreate;
use App\Events\IncomeUpdate;

class IncomeCRUDTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return array
     */
    public function testGetCatalogs()
    {

        $user = User::where('login', 'mick911@mail.ru')->first();

        Auth::login($user);

        $this->assertInstanceOf(User::class, $user);

        $walletRub = Wallet::where('name', 'Свободные деньги (РУБ)')->where('user_id',
            $user->id)->first();

        $this->assertInstanceOf(Wallet::class, $walletRub);

        $walletCz = Wallet::where('name', 'Свободные деньги (CZK)')
            ->where('user_id', $user->id)->first();

        $this->assertInstanceOf(Wallet::class, $walletCz);

        $item1 = ItemIncome::where('name', 'Прочие доходы')
            ->where('user_id', $user->id)->first();

        $this->assertInstanceOf(ItemIncome::class, $item1);


        $item2 = ItemIncome::where('name', 'Изменение остатка')
            ->where('user_id', $user->id)->first();

        $this->assertInstanceOf(ItemIncome::class, $item2);

        return [
            'user' => $user,
            'wallet1' => $walletRub,
            'wallet2' => $walletCz,
            'item1' => $item1,
            'item2' => $item2
        ];
    }

    /**
     * @depends testGetCatalogs
     */
    public function testCreate($params)
    {
        DB::beginTransaction();

        $income = Income::create([
            'user_id' => $params['user']->id,
            'date' => '2019-11-25',
            'wallet_id' => $params['wallet1']->id,
            'sum' => 10000
        ]);

        $this->assertDatabaseHas('doc_income_header', [
            'id' => $income->id
        ]);

        $income->rows()->createMany([
            [
                'user_id' => $params['user']->id,
                'doc_id' => $income->id,
                'item_id' => $params['item1']->id,
                'sum' => 10000
            ]
        ]);

        $this->assertDatabaseHas('doc_income_rows', [
            'doc_id' => $income->id,
            'item_id' => $params['item1']->id,
            'sum' => 10000
        ]);

        event(new IncomeCreate($income));

        $this->assertDatabaseHas('reg_money_trans', [
            'income_id' => $income->id,
            'wallet_id' => $income->wallet_id,
            'sum' => 10000,
        ]);

        $this->assertDatabaseHas('reg_incomes', [
            'income_id' => $income->id,
            'item_id' => $params['item1']->id,
            'sum' => 10000,
        ]);

        DB::commit();

        return ['id' => $income->id, 'params' => $params];
    }

    /**
     * @depends testCreate
     */
    public function testUpdate($params)
    {

        Auth::login($params['params']['user']);

        $income = Income::find($params['id']);

        DB::beginTransaction();

        $rows = IncomeRow::where('doc_id', $income->id);

        $rows->delete();

        $income->date = '2019-11-25';
        $income->wallet_id = $params['params']['wallet2']->id;
        $income->sum = 30000;

        $income->save();

        $this->assertDatabaseHas('doc_income_header', [
            'id' => $income->id,
            'wallet_id' => $params['params']['wallet2']->id,
            'sum' => 30000
        ]);

        $income->rows()->createMany([
            [
                'user_id' => $params['params']['user']->id,
                'doc_id' => $income->id,
                'item_id' => $params['params']['item2']->id,
                'sum' => 30000
            ]
        ]);


        $this->assertDatabaseHas('doc_income_rows', [
            'doc_id' => $income->id,
            'item_id' => $params['params']['item2']->id,
            'sum' => 30000
        ]);

        $this->assertDatabaseMissing('doc_income_rows', [
            'doc_id' => $income->id,
            'item_id' => $params['params']['item1']->id,
            'sum' => 10000
        ]);

        event(new IncomeUpdate($income));

        $this->assertDatabaseHas('reg_money_trans', [
            'income_id' => $income->id,
            'wallet_id' => $income->wallet_id,
            'sum' => 30000,
        ]);

        $this->assertDatabaseMissing('reg_money_trans', [
            'income_id' => $income->id,
            'wallet_id' => $income->wallet_id,
            'sum' => 10000,
        ]);

        $this->assertDatabaseHas('reg_incomes', [
            'income_id' => $income->id,
            'item_id' => $params['params']['item2']->id,
            'sum' => 30000,
        ]);

        $this->assertDatabaseMissing('reg_incomes', [
            'income_id' => $income->id,
            'item_id' => $params['params']['item1']->id,
            'sum' => 10000,
        ]);

        DB::commit();

        return ['income' => $income, 'user' => $params['params']['user']];
    }

    /**
     * @depends testUpdate
     */
    public function testDelete($params)
    {

        Auth::login($params['user']);
        $income = $params['income'];

        $count = Income::destroy($income->id);

        $this->assertEquals(1, $count);

        $this->assertDatabaseMissing('doc_income_header', [
            'id' => $income->id
        ]);

        $this->assertDatabaseMissing('doc_income_rows', [
            'doc_id' => $income->id
        ]);

        $this->assertDatabaseMissing('reg_money_trans', [
            'income_id' => $income->id
        ]);

        $this->assertDatabaseMissing('reg_incomes', [
            'income_id' => $income->id
        ]);

    }
}
