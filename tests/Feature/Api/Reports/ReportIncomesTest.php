<?php

namespace Tests\Feature\Api\Reports;

use Tests\Feature\UserToken;
use Tests\TestCase;

class ReportIncomesTest extends TestCase
{
    use UserToken;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIncomesByPeriodWithDetails()
    {
        $body = [
            'begin' => '2019-06-01',
            'period' => 1,
            'byPeriod' => true,
            'details' => true
        ];


        $response = $this->post('/api/reports/incomes', $body, $this->getHeaders());

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'begin',
            'end',
            'reportCurrency',
            'data' => [
                'total',
                'dataByPeriod' => [
                    '*' => [
                        'period',
                        'total',
                        'rows' => [
                            '*' => [
                                'period',
                                'item_id',
                                'item_name',
                                'has_convert_error',
                                'sum_converted'
                            ]
                        ]
                    ]
                ]
            ]
        ]);
    }

    public function testIncomesByPeriodWithoutDetails()
    {
        $body = [
            'begin' => '2019-06-01',
            'period' => 2,
            'byPeriod' => true,
            'details' => false
        ];


        $response = $this->post('/api/reports/incomes', $body, $this->getHeaders());

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'begin',
            'end',
            'reportCurrency',
            'data' => [
                'total',
                'dataByPeriod' => [
                    '*' => [
                        'period',
                        'total'
                    ]
                ]
            ]
        ]);
    }

    public function testIncomesWithDetails()
    {
        $body = [
            'begin' => '2019-06-01',
            'period' => 2,
            'byPeriod' => false,
            'details' => true
        ];


        $response = $this->post('/api/reports/incomes', $body, $this->getHeaders());

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'begin',
            'end',
            'reportCurrency',
            'data' => [
                'total',
                'rows' => [
                    '*' => [
                        'period',
                        'item_id',
                        'item_name',
                        'has_convert_error',
                        'sum_converted'
                    ]
                ]
            ]
        ]);
    }

    public function testIncomesWithoutDetails()
    {
        $body = [
            'begin' => '2019-06-01',
            'period' => 2,
            'byPeriod' => false,
            'details' => true
        ];


        $response = $this->post('/api/reports/incomes', $body, $this->getHeaders());

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'begin',
            'end',
            'reportCurrency',
            'data' => [
                'total'
            ]
        ]);
    }
}
