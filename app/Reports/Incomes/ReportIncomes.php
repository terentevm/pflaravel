<?php
/**
 * Created by PhpStorm.
 *
 * Date: 08.09.2019
 * Time: 17:54
 */

namespace App\Reports\Incomes;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Currency;
use App\Reports\ReportAbstract;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ReportIncomesRepository as Repo;

class ReportIncomes extends ReportAbstract
{
    private $reportCurrency = null;

    private $dateBegin = null;

    private $dateEnd = null;

    private $period = 0;

    private $byPeriod = false;

    private $details = true;

    public function __construct(Request $request)
    {
        $this->loadParams($request);
    }

    public function execute()
    {
        $dbResult = Repo::getIncomes(
            Auth::user()->id,
            $this->dateBegin->format('Y-m-d'),
            $this->dateEnd->format('Y-m-d'),
            $this->reportCurrency->id,
            $this->period
        );

        $data = $this->byPeriod === true
            ? (new IncomesByPeriod($this->details))->execute($dbResult)
            : (new FlatIncomes($this->details))->execute($dbResult);

        $reportData = [
            'begin' => $this->dateBegin->format('Y-m-d'),
            'end' => $this->dateEnd->format('Y-m-d'),
            'reportCurrency' => $this->reportCurrency,
            'data' => $data
        ];

        return $reportData;
    }

    private function loadParams(Request $request)
    {
        //1. Set report currency
        if ($request->has('currency')) {
            $this->reportCurrency = Currency::find($request->input('currency'));
        }

        if (is_null($this->reportCurrency)) {
            $this->reportCurrency = $this->getReportCurrency();
        }

        //2 Set balance date

        $this->dateBegin = $request->has('begin')
            ? Carbon::parse($request->input('begin'))
            : Carbon::now()->startOfMonth();

        $this->dateEnd = $request->has('end')
            ? Carbon::parse($request->input('end'))
            : Carbon::now()->endOfMonth();

        if ($request->has('period')) {
            $this->period = intval($request->input('period'));
        }

        if ($request->has('byPeriod')) {
            $this->byPeriod = $request->input('byPeriod');
        }
        if ($request->has('details')) {
            $this->details = $request->input('details');
        }

    }
}