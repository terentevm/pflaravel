<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTableDocIncomeHeader extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doc_income_header', function (Blueprint $table) {
            $table->uuid('wallet_id');
            $table->foreign('wallet_id', 'doc_income_header_fk_wallet_id')
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
        Schema::table('doc_income_header', function (Blueprint $table) {
            //
        });
    }
}
