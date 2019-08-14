<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRegIncomes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reg_incomes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('user_id');
            $table->date('date');
            $table->date('month');
            $table->uuid('item_id');
            $table->uuid('wallet_id');
            $table->uuid('currency_id');
            $table->uuid('income_id');
            $table->decimal('sum', 15, 2);

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('income_id')
                ->references('id')->on('doc_income_header')
                ->onDelete('cascade');


            $table->foreign('wallet_id')
                ->references('id')->on('ref_wallets')
                ->onDelete('restrict');

            $table->foreign('currency_id')
                ->references('id')->on('ref_currencies')
                ->onDelete('restrict');

            $table->foreign('item_id')
                ->references('id')->on('ref_items_income')
                ->onDelete('restrict');

            $table->index('income_id');
            $table->index(['user_id', 'month']);
            $table->index(['user_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reg_incomes');
    }
}
