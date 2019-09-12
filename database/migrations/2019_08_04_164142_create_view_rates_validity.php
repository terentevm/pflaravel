<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewRatesValidity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE VIEW rates_validity AS
         SELECT r.currency_id,
            r.user_id,
            c.name,
            daterange(r.date, lead(r.date) OVER (PARTITION BY r.user_id, r.currency_id ORDER BY r.date), '[)'::text) AS validity,
            r.rate,
            r.mult
           FROM rates r
             LEFT JOIN ref_currencies c ON r.currency_id = c.id
          ORDER BY r.date;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS rates_validity");
    }
}
