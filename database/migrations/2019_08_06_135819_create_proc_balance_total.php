<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcBalanceTotal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE OR REPLACE FUNCTION public.balance_total(IN in_user_id uuid,IN in_date date DEFAULT CURRENT_DATE)
    RETURNS TABLE(wallet_id uuid, wallet character, currencyid uuid, currency character, currencycode character, currencycharcode character, balance numeric)
    LANGUAGE \'plpgsql\'
    VOLATILE
    PARALLEL UNSAFE
    COST 100    ROWS 1000 
AS $BODY$DECLARE
	param_date timestamp;

BEGIN
	param_date = public.end_of_day(in_date);
	RETURN QUERY select 
		temp.wallet_id,
		ref_wallets.name as wallet,
                ref_currency.id as fuck,
                ref_currency.name as currency_id,
                ref_currency.code as currency_code,
                ref_currency.short_name as currency_char_code,
                temp.balance as balance
                FROM (select
                        trans.wallet_id,
                        ROUND(SUM(trans.sum), 2) as balance
                from 
                        reg_money_trans as trans
                where user_id = in_user_id AND date <= param_date
                group by
                        trans.wallet_id) as temp
                left join ref_wallets on temp.wallet_id = ref_wallets.id
                left join ref_currency on wallets.currency_id = ref_currency.id
                where temp.balance <> 0;
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
        DB::statement('DROP FUNCTION balance_total(in_user_id uuid, in_date date)');
    }
}
