<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRegExpenses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reg_expenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('user_id');
            $table->date('date');
            $table->date('month');
            $table->uuid('item_id');
            $table->uuid('wallet_id');
            $table->uuid('currency_id');
            $table->uuid('expend_id');
            $table->decimal('sum', 15, 2);

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('expend_id')
                ->references('id')->on('doc_expenses_header')
                ->onDelete('cascade');


            $table->foreign('wallet_id')
                ->references('id')->on('ref_wallets')
                ->onDelete('restrict');

            $table->foreign('currency_id')
                ->references('id')->on('ref_currencies')
                ->onDelete('restrict');

            $table->foreign('item_id')
                ->references('id')->on('ref_items_expenditure')
                ->onDelete('restrict');

            $table->index('expend_id');
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
        Schema::dropIfExists('reg_expenses');
    }
}
