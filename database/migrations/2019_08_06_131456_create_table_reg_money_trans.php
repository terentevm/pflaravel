<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRegMoneyTrans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reg_money_trans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('user_id');
            $table->date('date');
            $table->uuid('wallet_id');

            $table->uuid('expend_id')->nullable();
            $table->uuid('income_id')->nullable();
            $table->uuid('transfer_id')->nullable();
            $table->uuid('cb_id')->nullable();
            $table->uuid('lend_id')->nullable();

            $table->decimal('sum', 15, 2);

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('wallet_id')
                ->references('id')->on('ref_wallets')
                ->onDelete('restrict');

            $table->foreign('expend_id')
                ->references('id')->on('doc_expenses_header')
                ->onDelete('cascade');

            $table->foreign('income_id')
                ->references('id')->on('doc_income_header')
                ->onDelete('cascade');

            $table->foreign('transfer_id')
                ->references('id')->on('doc_transfers')
                ->onDelete('cascade');

            $table->foreign('cb_id')
                ->references('id')->on('doc_change_balance')
                ->onDelete('cascade');

            $table->foreign('lend_id')
                ->references('id')->on('doc_debts')
                ->onDelete('cascade');

            $table->index(['user_id', 'date']);
            $table->index(['wallet_id', 'date']);
            $table->index('wallet_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reg_money_trans');
    }
}
