<?php
/**
 * Created by PhpStorm.
 * User: zaich
 * Date: 05.09.2019
 * Time: 11:21
 */

namespace App\Reports;

use App\Settings;
use Illuminate\Http\Request;

abstract class ReportAbstract
{
    protected function getReportCurrency()
    {
        $settings = Settings::with('currency')->with('wallet')->with('reportcurrency')->first();

        if ($settings->reportcurrency) {
            return $settings->reportcurrency;
        } elseif ($settings->currency) {
            return $settings->currency;
        } else {
            throw new \Exception("System error. System currency is not defined!");
        }
    }

}