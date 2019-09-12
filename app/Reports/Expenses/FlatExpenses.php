<?php
/**
 * Created by PhpStorm.
 * User: zaich
 * Date: 06.09.2019
 * Time: 15:20
 */

namespace App\Reports\Expenses;

use Illuminate\Support\Collection;

class FlatExpenses
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