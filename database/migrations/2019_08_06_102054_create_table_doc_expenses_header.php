<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDocExpensesHeader extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_expenses_header', function (Blueprint $table) {
            $table->uuid('id')->unique()->index();
            $table->uuid('user_id')->index();
            $table->uuid('wallet_id');
            $table->date('date');
            $table->string('comment', 150);
            $table->decimal('sum', 15, 2);
            $table->timestamps();

            $table->index(['date', 'user_id'], 'idx_exp_h_date_user');
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
        Schema::dropIfExists('doc_expenses_header');
    }
}
