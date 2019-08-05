<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_currencies', function (Blueprint $table) {
            $table->uuid('id')->unique()->index('idx_currency_id');
            $table->char('name', 150);
            $table->char('code', 3);
            $table->char('short_name', 3);
            $table->uuid('user_id')->index('idx_fk_currency_user_id');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ref_currencies');
    }
}
