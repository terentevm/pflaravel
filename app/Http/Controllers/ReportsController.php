<?php

namespace App\Http\Controllers;

use App\Reports\Incomes\ReportIncomes;
use App\Reports\ReportBalanceByPeriods;
use App\Reports\ReportBalanceTotal;
use App\Reports\Expenses\ReportExpenses;
use App\Reports\ReportCompareExpensesIncomesByPeriods;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function balance(Request $request)
    {
        $result = (new ReportBalanceTotal($request))->execute();

        return response()->json($result);
    }

    public function expenses(Request $request)
    {
        $result = (new ReportExpenses($request))->execute();

        return response()->json($result);
    }

    public function incomes(Request $request)
    {
        $result = (new ReportIncomes($request))->execute();

        return response()->json($result);
    }

    public function balanceByPeriods(Request $request)
    {
        return response()->json((new ReportBalanceByPeriods($request))->execute());
    }

    public function compareExpensesIncomesByPeriods(Request $request)
    {
        return response()->json((new ReportCompareExpensesIncomesByPeriods($request))->execute());
    }
}
