<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcEndOfDay extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE OR REPLACE FUNCTION public.end_of_day(in_date date)
    RETURNS timestamp without time zone
    LANGUAGE \'plpgsql\'
    VOLATILE
    PARALLEL UNSAFE
    COST 100
    AS $BODY$
    BEGIN
      RETURN date_trunc(\'second\',date_trunc(\'day\', in_date) + interval \'86399 seconds\');
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
        DB::statement('DROP FUNCTION end_of_day(in_date date)');
    }
}
