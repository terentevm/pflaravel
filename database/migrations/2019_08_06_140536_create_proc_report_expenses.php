<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcReportExpenses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE OR REPLACE FUNCTION public.report_expenses(IN user_id uuid,IN date_begin date,IN date_end date,IN currency_id_to uuid,IN period_mode integer DEFAULT 0)
    RETURNS TABLE(period date, item_id uuid, item_name character, has_convert_error boolean, sum_converted numeric)
    LANGUAGE \'plpgsql\'
    VOLATILE
    PARALLEL UNSAFE
    COST 100    ROWS 1000 
AS $BODY$BEGIN
  DROP TABLE IF EXISTS tmp_expenses;

  CREATE TEMP TABLE tmp_expenses AS
    select
           subq.period,
           subq.item,
           subq.currency_id as currency_from_id,
           currency_id_to as currency_to_id,
           subq.sum,
           rv.rate as rate_from,
           rv.mult as mult_from,
           rv_to.rate as rate_to,
           rv_to.mult as mult_to,
           CASE  WHEN rv.rate NOTNULL AND rv.mult NOTNULL AND rv_to.rate NOTNULL AND rv_to.mult NOTNULL THEN
               (subq.sum * rv.rate * rv_to.mult)/(rv_to.rate * rv.mult)
                 ELSE
               0
               END as converted_sum,
           CASE
             WHEN rv.rate NOTNULL AND rv.mult NOTNULL AND rv_to.rate NOTNULL AND rv_to.mult NOTNULL THEN
               false
             ELSE
               true
               END as has_convert_error
    from (select
                 date_trunc(\'day\', reg.date) as period,
                 reg.item_id as item,
                 reg.currency_id,
                 SUM(reg.sum) as sum
          FROM reg_expenses as reg
          where
              reg.user_id = $1 and reg.date >= date_begin AND reg.date <= date_end
          group by
                   date_trunc(\'day\', reg.date),
                   reg.item_id,
                   reg.currency_id
          order by
                   date_trunc(\'day\', reg.date)) as subq
           LEFT JOIN rates_validity as rv on subq.currency_id = rv.currency_id and rv.validity @> subq.period::date
           LEFT JOIN rates_validity as rv_to on rv_to.currency_id = currency_id_to and rv_to.validity @> subq.period::date;

  RETURN QUERY SELECT
    CASE
        WHEN period_mode = 0 THEN NOW()
        WHEN period_mode = 1 THEN t1.period::date
        WHEN period_mode = 2 THEN date_trunc(\'week\', t1.period::date)
        WHEN period_mode = 3 THEN date_trunc(\'month\', t1.period::date)
    END::date as period,
    t1.item as item_id,
    items.name as item_name,
    MAX(t1.has_convert_error::int)::boolean as has_convert_error,
    SUM(round(t1.converted_sum::numeric, 2)) as converted_sum
  FROM tmp_expenses as t1
  LEFT JOIN ref_items_expenditure as items on t1.item = items.id
  GROUP BY
  CASE
    WHEN period_mode = 0 THEN NOW()
    WHEN period_mode = 1 THEN t1.period::date
    WHEN period_mode = 2 THEN date_trunc(\'week\', t1.period::date)
    WHEN period_mode = 3 THEN date_trunc(\'month\', t1.period::date)
  END,
  t1.item,
  items.name;
  
  DROP TABLE tmp_expenses;
END;
$BODY$;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP FUNCTION report_expenses(user_id uuid,date_begin date,date_end date,currency_id_to uuid,period_mode integer)');
    }
}
