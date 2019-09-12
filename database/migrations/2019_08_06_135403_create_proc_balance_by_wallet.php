<?php

use Illuminate\Database\Migrations\Migration;

class CreateProcBalanceByWallet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE OR REPLACE FUNCTION public.balance_by_wallet(IN in_wallet_id uuid,IN date_balance date DEFAULT CURRENT_DATE)
    RETURNS TABLE(wallet_id uuid, wallet character, balance numeric)
    LANGUAGE \'plpgsql\'
    VOLATILE
    PARALLEL UNSAFE
    COST 100    ROWS 1000 
AS $BODY$DECLARE
	temp_date timestamp;

BEGIN
	temp_date = public.end_of_day(date_balance);
	
	
	RETURN QUERY select 
		temp.wallet_id,
		ref_wallets.name as wallet,
		temp.balance
	FROM (select
		trans.wallet_id,
		ROUND(SUM(trans.sum), 2) as balance
	from 
		reg_money_trans as trans
	where trans.wallet_id = $1 AND trans.date <= $2
	group by
		trans.wallet_id) as temp
	left join ref_wallets on temp.wallet_id = ref_wallets.id
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
        DB::statement('DROP FUNCTION balance_by_wallet(in_wallet_id uuid,date_balance date)');
    }
}
