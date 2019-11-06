<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddProcAllTableForControl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('create function get_all_tables_for_control()
          returns TABLE(t_name text)
        language plpgsql
        as $BODY$
        BEGIN
        
          RETURN QUERY
          SELECT tables.table_name::text as t_name
          FROM information_schema.tables as tables
                 inner join information_schema.columns c on c.table_name = tables.table_name
                                                              and c.table_schema = tables.table_schema
          where c.column_name = \'user_id\'
            and tables.table_name NOT LIKE \'oauth%\'
            and tables.table_schema not in (\'information_schema\', \'pg_catalog\')
            and tables.table_type = \'BASE TABLE\';
        END;
        $BODY$');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP FUNCTION get_all_tables_for_control()');
    }
}
