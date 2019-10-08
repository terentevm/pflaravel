<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProcEndOfMonth extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE OR REPLACE FUNCTION end_of_month(in_date date)
    RETURNS timestamp without time zone
    LANGUAGE \'plpgsql\'
    VOLATILE
    PARALLEL UNSAFE
    COST 100
AS $BODY$    BEGIN
      RETURN (date_trunc(\'MONTH\', in_date) + INTERVAL \'1 MONTH - 1 day\')::DATE;
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
        DB::statement('DROP FUNCTION end_of_month(date)');
    }
}
