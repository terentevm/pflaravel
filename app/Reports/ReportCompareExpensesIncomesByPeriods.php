<?php
/**
 * Created by PhpStorm.
 * User: zaich
 * Date: 10.10.2019
 * Time: 17:46
 */

namespace App\Reports;


use App\Repositories\ReportCompareExpensesIncomesRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ReportCompareExpensesIncomesByPeriods extends ReportAbstract
{
    private $reportCurrency = null;

    private $dateBegin = null;

    private $dateEnd = null;

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

    }

    public function execute()
    {
        $dbSelection = (new ReportCompareExpensesIncomesRepository())->getData(
            Auth::user()->id,
            $this->dateBegin->format('Y-m-d'),
            $this->dateEnd->format('Y-m-d'),
            $this->reportCurrency->id
        );

        foreach ($dbSelection as $row) {
            $row->expense = floatval($row->expense);
            $row->income = floatval($row->income);
        }

        return [
            'begin' => $this->dateBegin->format('Y-m-d'),
            'end' => $this->dateEnd->format('Y-m-d'),
            'reportCurrency' => $this->reportCurrency,
            'data' => $dbSelection
        ];
    }
}