<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcBalanceByPeriodsByCurrency extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('create function balance_by_periods_by_currency(p_user_id uuid, date_begin date, date_end date, p_period character varying DEFAULT \'1 month\'::character varying)
  returns TABLE(period date, currency_id uuid, sum numeric)
language plpgsql
as $$
BEGIN


  RETURN QUERY

  Select
    sub1.period as period,
    sub1.currency_id as currency_id,
    SUM(sub1.cumsum) as sum
    from
        (WITH periods as (SELECT generate_series(date_begin::date, date_end::date , p_period::interval)::date as period)
               Select
                  periods.period,
                  wallets.id as wallet_id,
                  ref_currencies.id as currency_id,
                  COALESCE(reg.sum, 0.0)::NUMERIC(19,2) AS cumsum
               from periods
                  CROSS JOIN (Select w.id, w.currency_id from ref_wallets as w where w.user_id = p_user_id) as wallets
                  LEFT JOIN LATERAL (
                   SELECT
                          reg_mt.wallet_id,
                          SUM(reg_mt.sum) AS sum
                   FROM public.reg_money_trans as reg_mt
                   WHERE reg_mt.user_id = p_user_id and reg_mt.date < periods.period
                   GROUP BY wallet_id
                   ) as reg on wallets.id = reg.wallet_id
                      left join ref_currencies
                        on wallets.currency_id = ref_currencies.id
               order by periods.period
        ) as sub1

    where
      sub1.cumsum <> 0
    group by
      sub1.period,
      sub1.currency_id
    order by
      sub1.period;
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
        DB::statement('DROP FUNCTION balance_by_periods_by_currency(uuid, date, date, varchar)');
    }
}
