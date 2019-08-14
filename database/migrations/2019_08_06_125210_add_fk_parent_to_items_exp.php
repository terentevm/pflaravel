<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkParentToItemsExp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ref_items_expenditure', function (Blueprint $table) {
            $table->foreign('parent_id')
                ->references('id')->on('ref_items_expenditure')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ref_items_expenditure', function (Blueprint $table) {
            $table->dropForeign('ref_items_expenditure_parent_id_foreign');
        });
    }
}
