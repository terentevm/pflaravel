<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDocTransfers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_transfers', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->uuid('user_id')->index();
            $table->date('date');
            $table->uuid('wallet_id_from');
            $table->uuid('wallet_id_to');

            $table->decimal('sum_from', 15, 2);
            $table->decimal('sum_to', 15, 2);

            $table->string('comment', 150)->nullable()->default('');

            $table->timestamps();

            $table->index(['date','created_at']);

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('wallet_id_from')
                ->references('id')->on('ref_wallets')
                ->onDelete('restrict');

            $table->foreign('wallet_id_to')
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
        Schema::dropIfExists('doc_transfers');
    }
}
