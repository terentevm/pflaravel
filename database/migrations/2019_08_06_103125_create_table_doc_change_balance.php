<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDocChangeBalance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_change_balance', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->uuid('user_id')->index();
            $table->date('date');
            $table->uuid('wallet_id');

            $table->decimal('new_balance', 15, 2);
            $table->decimal('sum_expend', 15, 2);
            $table->decimal('sum_income', 15, 2);

            $table->timestamps();

            $table->index(['date','created_at']);

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('wallet_id')
                ->references('id')->on('ref_wallets')
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
        Schema::dropIfExists('doc_change_balance');
    }
}
