<?php
/**
 * Created by PhpStorm.
 * User: zaich
 * Date: 08.09.2019
 * Time: 17:56
 */

namespace App\Reports\Incomes;

use Illuminate\Support\Collection;

class IncomesByPeriod
{
    private $details = true;

    public function __construct($details = true)
    {
        $this->details = $details;
    }

    public function execute(Collection $sourceData)
    {
        $total = round($sourceData->sum('sum_converted'), 2);

        $subData = [];

        $dataByDate = $sourceData->groupBy('period');

        $dataByDate->map(function ($item, $key) use (&$subData) {

            $sybDataItem = [
                'period' => $key,
                'total' => round($item->sum('sum_converted'), 2)
            ];

            if ($this->details === true) {
                $sybDataItem['rows'] = $item;
            }

            array_push($subData, $sybDataItem);

        });

        return [
            'total' => $total,
            'dataByPeriod' => $subData
        ];
    }
}