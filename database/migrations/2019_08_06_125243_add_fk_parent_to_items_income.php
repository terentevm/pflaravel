<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkParentToItemsIncome extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ref_items_income', function (Blueprint $table) {
            $table->foreign('parent_id')
                ->references('id')->on('ref_items_income')
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
        Schema::table('ref_items_income', function (Blueprint $table) {
            $table->dropForeign('ref_items_income_parent_id_foreign');
        });
    }
}
