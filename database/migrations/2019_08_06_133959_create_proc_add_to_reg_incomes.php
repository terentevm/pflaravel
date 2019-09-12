<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcAddToRegIncomes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE OR REPLACE FUNCTION public.add_to_reg_incomes(income_id uuid)
    RETURNS integer
    LANGUAGE 'plpgsql'
    VOLATILE
    PARALLEL UNSAFE
    COST 100
AS \$BODY\$DECLARE
  rows_affected INT;

BEGIN
  DELETE FROM public.reg_incomes WHERE reg_incomes.income_id = $1;
  INSERT INTO public.reg_incomes (date, month, income_id, wallet_id, currency_id, item_id, user_id, sum)
  SELECT
         doc.date as date,
         date_trunc('month', doc.date) AS month,
         doc.id as expend_id,
         docRows.wallet_id as wallet_id,
         ref_wallets.currency_id as currency_id,
         docRows.item_id as item_id,
         doc.user_id as user_id,
         SUM(docRows.sum) as sum
  FROM
       public.doc_income_header as doc
         inner join public.doc_income_rows as docRows on doc.id = docRows.doc_id
         left join ref_wallets on docRows.wallet_id = ref_wallets.id

  Where doc.id = $1
  GROUP BY
           doc.date,
           doc.id,
           docRows.wallet_id,
           doc.user_id,
           ref_wallets.id,
           ref_wallets.currency_id,
           docRows.item_id;

  RETURN rows_affected;
END;
\$BODY\$;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP FUNCTION add_to_reg_incomes(income_id uuid)");
    }
}
