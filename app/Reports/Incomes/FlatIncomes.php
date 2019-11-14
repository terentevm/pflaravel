<?php
/**
 * Created by PhpStorm.
 *
 * Date: 08.09.2019
 * Time: 17:56
 */

namespace App\Reports\Incomes;

use Illuminate\Support\Collection;

class FlatIncomes
{
    private $details = true;

    public function __construct($details = true)
    {
        $this->details = $details;
    }

    public function execute(Collection $sourceData)
    {
        $total = round($sourceData->sum('sum_converted'), 2);

        $res = [
            'total' => $total
        ];

        if ($this->details == true) {
            $res['rows'] = $sourceData;
        }

        return $res;
    }
}