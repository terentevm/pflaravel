<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDocIncomeRows extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_income_rows', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('doc_id')->index('idx_income_rows_doc_id');
            $table->uuid('user_id');
            $table->uuid('item_id');
            $table->uuid('wallet_id');
            $table->decimal('sum', 15, 2);
            $table->string('comment')->default('');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('doc_id')
                ->references('id')->on('doc_income_header')
                ->onDelete('cascade');


            $table->foreign('wallet_id')
                ->references('id')->on('ref_wallets')
                ->onDelete('restrict');

            $table->foreign('item_id')
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
        Schema::dropIfExists('doc_income_rows');
    }
}
