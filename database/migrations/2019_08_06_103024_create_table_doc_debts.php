<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDocDebts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_debts', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->uuid('user_id')->index();
            $table->date('date');
            $table->uuid('wallet_id');
            $table->uuid('contact_id')->index();
            $table->decimal('sum', 15, 2);

            $table->timestamps();

            $table->index(['date','created_at']);

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('wallet_id')
                ->references('id')->on('ref_wallets')
                ->onDelete('restrict');

            $table->foreign('contact_id')
                ->references('id')->on('ref_contacts')
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
        Schema::dropIfExists('doc_debts');
    }
}
