<?php
/**
 * Created by PhpStorm.
 *
 * Date: 06.09.2019
 * Time: 16:22
 */

namespace App\Reports\Expenses;

use Illuminate\Support\Collection;

class ExpensesByPeriod
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