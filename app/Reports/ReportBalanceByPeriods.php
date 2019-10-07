<?php
/**
 * Created by PhpStorm.
 * User: zaich
 * Date: 09.09.2019
 * Time: 15:57
 */

namespace App\Reports;


use App\Repositories\BalanceByPeriodsRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportBalanceByPeriods extends ReportAbstract
{
    private $reportCurrency = null;

    private $dateBegin = null;

    private $dateEnd = null;

    private $periodicity = 'month';

    public function __construct(Request $request)
    {
        $this->loadParams($request);
    }

    private function loadParams(Request $request)
    {

        if ($request->has('currency')) {
            $this->reportCurrency = Currency::find($request->input('currency'));
        }

        if (is_null($this->reportCurrency)) {
            $this->reportCurrency = $this->getReportCurrency();
        }


        $this->dateBegin = $request->has('begin')
            ? Carbon::parse($request->input('begin'))
            : Carbon::now()->startOfYear();

        $this->dateEnd = $request->has('end')
            ? Carbon::parse($request->input('end'))
            : Carbon::now()->endOfYear();

        $this->periodicity = $request->has('periodicity')
            ? $request->input('periodicity')
            : 'month';

    }

    public function execute()
    {
        $dbSelection = (new BalanceByPeriodsRepository())->getBalanceByPeriods(
            Auth::user()->id,
            $this->dateBegin->format('Y-m-d'),
            $this->dateEnd->format('Y-m-d'),
            $this->reportCurrency->id,
            $this->periodicity
        );

        return [
            'begin' => $this->dateBegin->format('Y-m-d'),
            'end' => $this->dateEnd->format('Y-m-d'),
            'periodicity' => $this->periodicity,
            'reportCurrency' => $this->reportCurrency,
            'data' => $dbSelection
        ];
    }

}