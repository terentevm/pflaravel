<?php

namespace Tests\Feature\Api\Reports;

use Tests\Feature\UserToken;
use Tests\TestCase;

class ReportBalanceTest extends TestCase
{
    use UserToken;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testBalanceTotal()
    {
        $data = [
            'date' => '2019-08-31',
            'byWallets' => false
        ];

        $response = $this->post('/api/reports/balance', $data, $this->getHeaders());

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'reportDate',
            'reportCurrency',
            'data' => [
                'balance'
            ]
        ]);
    }

    public function testBalanceByWalletsAll()
    {
        $data = [
            'date' => '2019-08-31',
            'byWallets' => true
        ];

        $response = $this->post('/api/reports/balance', $data, $this->getHeaders());

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'reportDate',
            'reportCurrency',
            'data' => [
                'total',
                'byWallets' => [
                    '*' => [
                        'wallet_id',
                        'wallet_name',
                        'currency_id',
                        'currency_char_code',
                        'balance',
                        'reportBalance'
                    ]
                ]


            ]
        ]);
    }
}
