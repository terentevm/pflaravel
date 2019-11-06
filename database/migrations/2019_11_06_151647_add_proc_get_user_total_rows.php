<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddProcGetUserTotalRows extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE OR REPLACE FUNCTION get_user_total_rows(userId uuid)
          RETURNS integer AS $$
        DECLARE
          counter INTEGER;
          rec RECORD;
          rec2 RECORD;
          query text;
          query2 text;
        BEGIN
          counter := 0;
          query := \'select t.t_name from get_all_tables_for_control() as t\';
        
          FOR rec IN EXECUTE query
          LOOP
            query2 := \'select count(*) as count from \' || rec.t_name || \' where user_id=$1\';
        
            FOR rec2 IN EXECUTE query2 USING userId
              LOOP
              counter := counter + rec2.count;
              END LOOP;
        
          END LOOP;
        
          return counter;
        
        END;
        $$ LANGUAGE plpgsql;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP FUNCTION get_user_total_rows(uuid)');
    }
}
