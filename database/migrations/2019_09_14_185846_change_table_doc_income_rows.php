<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTableDocIncomeRows extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doc_income_rows', function (Blueprint $table) {
            $table->dropForeign('doc_income_rows_wallet_id_foreign');
            $table->dropColumn('wallet_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doc_income_rows', function (Blueprint $table) {
            $table->uuid('wallet_id');
            $table->foreign('wallet_id')
                ->references('id')->on('ref_wallets')
                ->onDelete('restrict');
        });
    }
}
