<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcAddToRegExpenses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE OR REPLACE FUNCTION public.add_to_reg_expenses(expend_id uuid)
    RETURNS integer
    LANGUAGE "plpgsql"
    VOLATILE
    PARALLEL UNSAFE
    COST 100
AS $BODY$DECLARE
  rows_affected INT;

BEGIN
	DELETE FROM public.reg_expenses WHERE reg_expenses.expend_id = $1;
  	INSERT INTO public.reg_expenses (date, month, expend_id, wallet_id, currency_id, item_id, user_id, sum) 
SELECT 
    doc.date as date,
    date_trunc("month", doc.date) AS month,
	doc.id as expend_id,
    doc.wallet_id as wallet_id,
    ref_wallets.currency_id as currency_id,
    docRows.item_id as item_id,    
	doc.user_id as user_id,
    SUM(docRows.sum) as sum
FROM 
	public.doc_expenses_header as doc
		left join ref_wallets on doc.wallet_id = ref_wallets.id
        inner join public.doc_expenses_rows as docRows on doc.id = docRows.doc_id
Where doc.id = $1
GROUP BY
	doc.date,
	doc.id,
    doc.wallet_id,
    doc.user_id,
    ref_wallets.id,
    ref_wallets.currency_id,
    docRows.item_id;
	
  RETURN rows_affected;
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
        DB::statement("DROP FUNCTION add_to_reg_expenses(expend_id uuid)");
    }
}
