<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProcComparisonExpensesIncomesByPeriods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('create function comparison_expenses_incomes_by_periods(p_user_id uuid, date_begin date, date_end date, p_currency_id uuid)
          returns TABLE(period date, expense numeric, income numeric)
        language plpgsql
        as $$
        BEGIN


      RETURN QUERY
      WITH periods as (SELECT generate_series(date_begin, date_end , \'1month\'::interval)::date as period)
      select
             periods.period as month,
             COALESCE(expenses.sum, 0.0)::NUMERIC(15,2) AS expense,
             COALESCE(incomes.sum, 0.0)::NUMERIC(15,2) AS income
      from periods
             left join(select
                              rep.period , SUM(rep.sum_converted) as sum
                       from report_expenses(p_user_id, date_begin, date_end, p_currency_id, 3) as rep
                       group by rep.period 
                       order by rep.period ) as expenses on periods.period = expenses.period
             left join(select
                              rep.period, SUM(rep.sum_converted) as sum
                       from report_incomes(p_user_id, date_begin, date_end, p_currency_id, 3) as rep
                       group by rep.period
                       order by rep.period) as incomes on periods.period = incomes.period;
    
    END;
    $$;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP FUNCTION comparison_expenses_incomes_by_periods(uuid, date, date, uuid)');
    }
}
