<?php
/**
 * Created by PhpStorm.
 * User: zaich
 * Date: 10.10.2019
 * Time: 17:36
 */

namespace Tests\Feature\Api\Reports;

use Tests\Feature\UserToken;
use Tests\TestCase;

class ReportExpensesIncomesByPeriodsTest extends TestCase
{
    use UserToken;

    public function testExpensesIncomesByPeriods()
    {
        $body = [
            'begin' => '2019-01-01',
            'end' => '2019-12-31'
        ];


        $response = $this->post('/api/reports/compare-expenses-incomes', $body, $this->getHeaders());

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'begin',
            'end',
            'reportCurrency',
            'data' => [
                '*' => [
                    'period',
                    'expense',
                    'income'
                ]
            ]
        ]);
    }
}
