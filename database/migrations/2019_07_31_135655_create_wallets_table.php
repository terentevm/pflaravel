<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_wallets', function (Blueprint $table) {
            $table->uuid('id')->unique()->index('idx_wallets_id');
            $table->char('name', 150);
            $table->boolean('is_creditcard');
            $table->integer('grace_period');
            $table->decimal('credit_limit', 15, 2);
            $table->uuid('user_id')->index('idx_wallets_fk_user_id');
            $table->uuid('currency_id')->index('idx_wallets_fk_currency_id');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('currency_id')
                ->references('id')->on('ref_currencies')
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
        Schema::dropIfExists('ref_wallets');
    }
}
