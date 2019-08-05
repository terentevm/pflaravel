<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->uuid('user_id')->index('idx_settings_user_id');
            $table->uuid('currency_id')->nullable();
            $table->uuid('wallet_id')->nullable();
            $table->uuid('report_currency')->nullable();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('currency_id')
                ->references('id')->on('ref_currencies')
                ->onDelete('restrict');

            $table->foreign('report_currency')
                ->references('id')->on('ref_currencies')
                ->onDelete('restrict');

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
        Schema::dropIfExists('settings');
    }
}
