<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('user_id');
            $table->uuid('currency_id');
            $table->dateTime('date');
            $table->decimal('rate', 15, 5);
            $table->integer('mult');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('currency_id')
                ->references('id')->on('ref_currencies')
                ->onDelete('restrict');

            $table->index('currency_id', 'idx_rates_currency');
            $table->index('user_id', 'idx_rates_user');
            $table->index(['currency_id', 'date'], 'idx_rates_currency_date');
            $table->index('date', 'idx_rates_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rates');
    }
}
