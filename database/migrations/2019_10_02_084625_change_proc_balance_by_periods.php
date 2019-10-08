<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeProcBalanceByPeriods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('DROP FUNCTION balance_by_periods(uuid, date, date, varchar)');
        DB::statement('create function balance_by_periods(p_user_id uuid, date_begin date, date_end date, p_currency_id uuid,p_period character varying DEFAULT \'1 month\'::character varying)
  returns TABLE(period date, sum numeric)
language plpgsql
as $$
BEGIN


  RETURN QUERY

  select
         sub.period as period,
         SUM(recalculate(sub.sum, sub.wc_rate, sub.wc_mult, sub.rep_rate, sub.rep_mult)) as sum_converted
  from	(
        select
               b_by_periods.period,
               b_by_periods.currency_id,
               b_by_periods.sum,
               COALESCE(wc_rates.rate, 1) as wc_rate, -- wallet currency rate
               COALESCE(wc_rates.mult, 1) as wc_mult, -- wallet currency mult
               COALESCE(rep_rates.rate, 1) as rep_rate, -- report currency rate
               COALESCE(rep_rates.mult, 1) as rep_mult -- report currency mult
        from public.balance_by_periods_by_currency(
               p_user_id,
               date_begin,
               date_end,
               p_period
                 ) as b_by_periods
               left join rates_validity as wc_rates
                 on wc_rates.user_id = p_user_id and b_by_periods.currency_id = wc_rates.currency_id and wc_rates.validity @> end_of_month(b_by_periods.period)::date
               left join rates_validity as rep_rates
                 on rep_rates.user_id = p_user_id and rep_rates.currency_id = p_currency_id and rep_rates.validity @> end_of_month(b_by_periods.period)::date
        ) as sub
  group by
           sub.period
  order by
           sub.period;
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
        DB::statement('DROP FUNCTION balance_by_periods(uuid, date, date, uuid,varchar)');
        DB::statement('create function balance_by_periods(p_user_id uuid, date_begin date, date_end date, p_period character varying DEFAULT \'1 month\'::character varying)
  returns TABLE(period date, sum numeric)
language plpgsql
as $$
BEGIN


  RETURN QUERY

  select
         sub.period as period,
         SUM(recalculate(sub.sum, sub.wc_rate, sub.wc_mult, sub.rep_rate, sub.rep_mult)) as sum_converted
  from	(
        select
               b_by_periods.period,
               b_by_periods.currency_id,
               b_by_periods.sum,
               COALESCE(wc_rates.rate, 1) as wc_rate, -- wallet currency rate
               COALESCE(wc_rates.mult, 1) as wc_mult, -- wallet currency mult
               COALESCE(rep_rates.rate, 1) as rep_rate, -- report currency rate
               COALESCE(rep_rates.mult, 1) as rep_mult -- report currency mult
        from public.balance_by_periods_by_currency(
               p_user_id,
               date_begin,
               date_end,
               p_period
                 ) as b_by_periods
               left join rates_validity as wc_rates
                 on wc_rates.user_id = p_user_id and b_by_periods.currency_id = wc_rates.currency_id and wc_rates.validity @> b_by_periods.period
               left join rates_validity as rep_rates
                 on rep_rates.user_id = p_user_id and rep_rates.currency_id = \'cd693e00-7303-11dc-89ad-00195b6993ba\' and rep_rates.validity @> b_by_periods.period
        ) as sub
  group by
           sub.period
  order by
           sub.period;
END;
$$;');
    }
}
