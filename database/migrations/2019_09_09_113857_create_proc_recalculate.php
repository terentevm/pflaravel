<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcRecalculate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('create function recalculate(sum numeric, current_rate numeric, current_mult integer, new_rate numeric, new_mult integer)
  returns numeric
language plpgsql
as $$
BEGIN
  if current_rate = 0 or current_mult = 0 or new_rate = 0 or new_mult = 0 then
    return 0;
  end if;

  return round((sum * current_rate / new_mult) / (new_rate * current_mult),2);
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
        DB::statement('DROP FUNCTION recalculate(numeric, numeric, integer, numeric, integer)');
    }
}
