<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDocExpensesRows extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_expenses_rows', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('doc_id')->index('idx_exp_rows_doc_id');
            $table->uuid('user_id');
            $table->uuid('item_id');
            $table->decimal('sum', 15, 2);
            $table->string('comment')->nullable()->default('');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('doc_id')
                ->references('id')->on('doc_expenses_header')
                ->onDelete('cascade');

            $table->foreign('item_id')
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
        Schema::dropIfExists('doc_expenses_rows');
    }
}
