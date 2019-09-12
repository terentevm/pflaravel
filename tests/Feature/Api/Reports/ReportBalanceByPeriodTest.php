<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReportBalanceByPeriodTest extends TestCase
{
    use UserToken;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testReportBalanceByPeriod()
    {
        $body = [
            'begin' => '2019-01-01',
            'end' => '2019-12-31',
            'periodicity' => 'month'
        ];

        $response = $this->post('/api/reports/balance-by-periods', $body, $this->getHeaders());

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'begin',
            'end',
            'periodicity',
            'reportCurrency',
            'data' => [
                '*' => [
                    'period',
                    'sum'
                ]

            ]
        ]);
    }
}
