<?php
/**
 * Created by PhpStorm.
 * User: zaich
 * Date: 29.08.2019
 * Time: 14:55
 */

namespace App\Reports;

use App\Currency;
use App\Rates;
use App\Services\Converter;
use App\Settings;
use App\Repositories\BalanceRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ReportBalanceTotal extends ReportAbstract
{

    private $reportCurrency = null;

    private $balanceDate = null;

    private $walletFilter = null;

    private $byWallets = false;

    /**
     * ReportBalanceTotal constructor.
     */
    public function __construct(Request $request)
    {
        $this->loadParams($request);
    }

    public function execute()
    {
        $data = (new BalanceRepository())->balance($this->balanceDate->format('Y-m-d'),
            $this->walletFilter);

        $converter = new Converter($this->reportCurrency);

        $convertedData = $converter->convert(
            $data,
            $this->balanceDate,
            'currency_id',
            'balance',
            'reportBalance');

        $reportData = [
            'reportDate' => $this->balanceDate->format('Y-m-d'),
            'reportCurrency' => $this->reportCurrency
        ];

        $total = $convertedData->sum('reportBalance');

        if ($this->byWallets) {

            $reportData['data'] = [
                'total' => round($total, 2),
                'byWallets' => $convertedData
            ];

        } else {

            $reportData['data'] = ['balance' => round($total, 2)];
        }

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

        $this->balanceDate = $request->has('date')
            ? Carbon::parse($request->input('date'))
            : Carbon::now();

        if ($request->has('walletFilter')) {
            $this->walletFilter = $request->input('walletFilter');
        }

        if ($request->has('byWallets')) {
            $this->byWallets = $request->input('byWallets');
        }
    }


}